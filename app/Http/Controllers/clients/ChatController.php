<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct()
    {
        // Tự động tạo bảng lưu trữ hội thoại nếu chưa có
        if (!Schema::hasTable('tbl_chats')) {
            DB::statement("CREATE TABLE tbl_chats (
                chatId INT AUTO_INCREMENT PRIMARY KEY,
                sessionId VARCHAR(100) NOT NULL,
                userId INT DEFAULT NULL,
                sender ENUM('user', 'bot') NOT NULL,
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_session (sessionId),
                INDEX idx_user (userId)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
        }
    }

    // Lấy lịch sử chat của một phiên (Session)
    public function getHistory(Request $request)
    {
        $sessionId = $request->input('sessionId');
        if (!$sessionId) return response()->json(['success' => false, 'message' => 'Session ID is required']);

        $messages = DB::table('tbl_chats')
            ->where('sessionId', $sessionId)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json(['success' => true, 'messages' => $messages]);
    }

    // Lấy danh sách các cuộc trò chuyện cũ (dành cho User đã đăng nhập)
    public function getSessions()
    {
        $userId = session('userId');
        if (!$userId) return response()->json(['success' => true, 'sessions' => []]);

        $sessions = DB::table('tbl_chats')
            ->select('sessionId', DB::raw('MIN(created_at) as first_msg'), DB::raw('MAX(created_at) as last_msg'))
            ->where('userId', $userId)
            ->groupBy('sessionId')
            ->orderBy('last_msg', 'desc')
            ->get();

        foreach ($sessions as $session) {
            $firstMessage = DB::table('tbl_chats')
                ->where('sessionId', $session->sessionId)
                ->where('sender', 'user')
                ->first();
            $session->title = $firstMessage ? mb_strimwidth($firstMessage->message, 0, 30, "...") : "Cuộc trò chuyện mới";
        }

        return response()->json(['success' => true, 'sessions' => $sessions]);
    }

    // Xử lý gửi tin nhắn và nhận phản hồi từ Gemini
    public function sendMessage(Request $request)
    {
        try {
            $request->validate(['message' => 'required|string', 'sessionId' => 'required']);
            $sessionId = $request->input('sessionId');
            $userMessage = trim($request->input('message'));
            $userId = session('userId', null);

            // Lưu tin nhắn của khách vào DB
            DB::table('tbl_chats')->insert([
                'sessionId' => $sessionId, 'userId' => $userId,
                'sender' => 'user', 'message' => $userMessage, 'created_at' => now(),
            ]);

            // Gọi hàm xử lý AI
            $botResponse = $this->generateAIResponse($userMessage, $sessionId);

            // Lưu phản hồi của Bot vào DB
            DB::table('tbl_chats')->insert([
                'sessionId' => $sessionId, 'userId' => $userId,
                'sender' => 'bot', 'message' => $botResponse, 'created_at' => now(),
            ]);

            return response()->json(['success' => true, 'reply' => $botResponse]);
        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Lỗi hệ thống.'], 500);
        }
    }

    private function callGeminiAPI($contents, $systemInstruction, $apiKey)
    {
        $maxRetries = 3;
        for ($attempt = 1; $attempt <= $maxRetries; $attempt++) {
            $response = Http::timeout(30)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                    'contents'           => $contents,
                    'system_instruction' => ['parts' => [['text' => $systemInstruction]]],
                    'generationConfig'   => ['temperature' => 0.7, 'maxOutputTokens' => 800]
                ]);

            if ($response->successful()) {
                return $response;
            }

            $statusCode = $response->status();
            Log::warning("Gemini attempt {$attempt}/{$maxRetries} failed [{$statusCode}]: " . substr($response->body(), 0, 300));

            // Nếu lỗi 429 (quota), thử lại sau vài giây
            if ($statusCode === 429 && $attempt < $maxRetries) {
                sleep(3); // Chờ 3 giây trước khi thử lại
                continue;
            }

            // Các lỗi khác thì dừng luôn
            return $response;
        }
        return $response;
    }

    private function generateAIResponse($message, $sessionId)
    {
        $apiKey = env('GEMINI_API_KEY');
        
        // Nếu không có Key trong .env, dùng bộ quy tắc cũ (Fallback)
        if (empty($apiKey)) {
            Log::warning('Gemini API Key is not set in .env');
            return $this->generateRuleBasedResponse($message);
        }

        try {
            // 1. Lấy dữ liệu tour từ Database để cung cấp ngữ cảnh cho AI
            $tourContext = "Dữ liệu tour hiện có tại Travela:\n";
            if (Schema::hasTable('tbl_tours')) {
                $latest = DB::table('tbl_tours')->where('availability', 1)->orderBy('tourId', 'desc')->limit(3)->get();
                $cheap  = DB::table('tbl_tours')->where('availability', 1)->orderBy('priceAdult', 'asc')->limit(3)->get();
                
                $tourContext .= "[TOUR MỚI CẬP NHẬT]:\n";
                foreach ($latest as $t) $tourContext .= "- {$t->title}: Giá " . number_format($t->priceAdult) . "đ, Thời gian: {$t->time}\n";
                
                $tourContext .= "\n[TOUR GIÁ TỐT NHẤT]:\n";
                foreach ($cheap as $t) $tourContext .= "- {$t->title}: Giá " . number_format($t->priceAdult) . "đ\n";
            }

            // 2. Lấy lịch sử chat gần nhất (tối đa 6 tin - giảm để tiết kiệm token)
            $history = DB::table('tbl_chats')
                ->where('sessionId', $sessionId)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get()
                ->reverse()
                ->values();

            $contents = [];
            foreach ($history as $chat) {
                $contents[] = [
                    'role'  => ($chat->sender == 'user' ? 'user' : 'model'),
                    'parts' => [['text' => $chat->message]]
                ];
            }

            // Đảm bảo luôn có ít nhất 1 message
            if (empty($contents)) {
                $contents = [['role' => 'user', 'parts' => [['text' => $message]]]];
            }

            // Đảm bảo message cuối phải là 'user'
            $lastRole = end($contents)['role'] ?? 'model';
            if ($lastRole !== 'user') {
                $contents[] = ['role' => 'user', 'parts' => [['text' => $message]]];
            }

            // 3. System Instruction
            $systemInstruction = "Bạn là trợ lý AI của Travela - công ty du lịch. Trả lời ngắn gọn, thân thiện bằng Tiếng Việt.\n" .
                                 "Thông tin tour:\n" . $tourContext .
                                 "\nHotline: +84 123 456 789. Địa chỉ: 123 Street, TP.HCM.";

            // 4. Gọi Gemini với retry tự động khi bị 429
            $response = $this->callGeminiAPI($contents, $systemInstruction, $apiKey);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                if ($text) return $text;
                return "Xin lỗi, tôi không hiểu câu hỏi. Bạn có thể hỏi lại không?";
            }

            $statusCode = $response->status();
            if ($statusCode === 429) {
                Log::error("Gemini 429 after all retries");
                return "Hệ thống AI đang bận, bạn vui lòng thử lại sau 1 phút nhé! Hoặc gọi Hotline +84 123 456 789 để được hỗ trợ trực tiếp.";
            }

            return $this->generateRuleBasedResponse($message);

        } catch (\Exception $e) {
            Log::error('Gemini Exception: ' . $e->getMessage());
            return $this->generateRuleBasedResponse($message);
        }
    }

    private function generateRuleBasedResponse($message)
    {
        // Phản hồi dự phòng khi AI lỗi hoặc không có Key
        $cheap = DB::table('tbl_tours')->where('availability', 1)->orderBy('priceAdult', 'asc')->first();
        if ($cheap) {
            return "Chào bạn! Hiện tại tôi đang bảo trì hệ thống AI. Gợi ý cho bạn tour giá tốt nhất: **{$cheap->title}** (" . number_format($cheap->priceAdult) . "đ). Liên hệ Hotline +84 123 456 789 để đặt ngay nhé!";
        }
        return "Chào bạn! Rất tiếc hệ thống AI đang bận. Vui lòng quay lại sau hoặc gọi hotline của Travela nhé!";
    }

    public function clearHistory(Request $request)
    {
        DB::table('tbl_chats')->where('sessionId', $request->input('sessionId'))->delete();
        return response()->json(['success' => true]);
    }
}