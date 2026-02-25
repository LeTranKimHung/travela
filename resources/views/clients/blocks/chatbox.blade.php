<!-- Chatbox AI -->
<style>
    .chatbox-toggle {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #13357B, #1e90ff);
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(19, 53, 123, 0.4);
        z-index: 9998;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
    }
    .chatbox-toggle:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(19, 53, 123, 0.6);
    }
    .chatbox-toggle i {
        color: white;
        font-size: 24px;
    }
    .chatbox-toggle .chat-badge {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 18px;
        height: 18px;
        background: #ff4444;
        border-radius: 50%;
        border: 2px solid white;
        animation: pulse-badge 2s infinite;
        display: none;
    }
    @keyframes pulse-badge {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    .chatbox-container {
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 380px;
        height: 550px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        z-index: 9999;
        display: none;
        flex-direction: column;
        overflow: hidden;
        animation: chatbox-open 0.3s ease;
    }
    .chatbox-container.show {
        display: flex;
    }
    @keyframes chatbox-open {
        from { opacity: 0; transform: translateY(20px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .chatbox-header {
        background: linear-gradient(135deg, #13357B, #1e90ff);
        color: white;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .chatbox-header .chat-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .chatbox-header .chat-avatar {
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .chatbox-header .chat-name h6 {
        margin: 0;
        font-weight: 600;
        font-size: 14px;
    }
    .chatbox-header .chat-name small {
        opacity: 0.8;
        font-size: 11px;
    }
    .chatbox-header .chat-actions {
        display: flex;
        gap: 6px;
    }
    .chatbox-header .chat-actions button {
        background: rgba(255,255,255,0.2);
        border: none;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 12px;
    }
    .chatbox-header .chat-actions button:hover {
        background: rgba(255,255,255,0.3);
    }

    .chatbox-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }

    /* History Sidebar */
    .chat-history-sidebar {
        position: absolute;
        top: 0;
        left: -100%;
        width: 250px;
        height: 100%;
        background: #f8f9fa;
        border-right: 1px solid #eee;
        z-index: 10;
        transition: left 0.3s ease;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    }
    .chat-history-sidebar.show {
        left: 0;
    }
    .history-header {
        padding: 15px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
    }
    .history-list {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
    }
    .history-item {
        padding: 10px 12px;
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 5px;
        transition: background 0.2s;
        font-size: 13px;
        border: 1px solid transparent;
    }
    .history-item:hover {
        background: #e9ecef;
    }
    .history-item.active {
        background: #e7f0ff;
        border-color: #13357B;
        font-weight: 500;
    }
    .history-item .history-title {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }
    .history-item .history-date {
        font-size: 11px;
        color: #888;
        display: block;
    }

    .chatbox-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        background: #f0f2f5;
        scroll-behavior: smooth;
    }
    .chatbox-messages::-webkit-scrollbar {
        width: 5px;
    }
    .chatbox-messages::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }

    .chat-message {
        display: flex;
        margin-bottom: 12px;
        animation: msg-in 0.3s ease;
    }
    @keyframes msg-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .chat-message.user {
        justify-content: flex-end;
    }
    .chat-message .msg-bubble {
        max-width: 85%;
        padding: 10px 14px;
        border-radius: 16px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
        white-space: pre-wrap;
    }
    .chat-message.bot .msg-bubble {
        background: white;
        color: #333;
        border-bottom-left-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    .chat-message.user .msg-bubble {
        background: linear-gradient(135deg, #13357B, #1e90ff);
        color: white;
        border-bottom-right-radius: 4px;
    }
    .chat-message .msg-time {
        font-size: 10px;
        color: #999;
        margin-top: 4px;
    }
    .chat-message.user .msg-time { text-align: right; }
    .chat-message.bot .msg-time { text-align: left; }

    .typing-indicator {
        display: none;
        padding: 10px 16px;
        background: white;
        border-radius: 18px;
        border-bottom-left-radius: 4px;
        max-width: 80px;
        margin-bottom: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    .typing-indicator.show { display: flex; gap: 4px; align-items: center; }
    .typing-indicator span {
        width: 8px;
        height: 8px;
        background: #999;
        border-radius: 50%;
        animation: typing 1.4s infinite;
    }
    .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
    .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }
    @keyframes typing {
        0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
        30% { transform: translateY(-6px); opacity: 1; }
    }

    .chatbox-input {
        padding: 12px 16px;
        background: white;
        border-top: 1px solid #eee;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .chatbox-input input {
        flex: 1;
        border: 1px solid #e0e0e0;
        border-radius: 25px;
        padding: 10px 18px;
        font-size: 14px;
        outline: none;
    }
    .chatbox-input button {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #13357B, #1e90ff);
        border: none;
        border-radius: 50%;
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .chatbox-input button:disabled { opacity: 0.5; }

    @media (max-width: 480px) {
        .chatbox-container {
            width: 100%;
            height: 100%;
            bottom: 0;
            right: 0;
            border-radius: 0;
        }
    }
</style>

<!-- Toggle Button -->
<button class="chatbox-toggle" id="chatToggle" onclick="toggleChatbox()">
    <i class="fas fa-comments"></i>
    <div class="chat-badge" id="chatBadge"></div>
</button>

<!-- Chatbox -->
<div class="chatbox-container" id="chatbox">
    <div class="chatbox-header">
        <div class="chat-info">
            <div class="chat-avatar">✈️</div>
            <div class="chat-name">
                <h6>Travela Assistant</h6>
                <small><span id="chatStatus">🟢 Online</span></small>
            </div>
        </div>
        <div class="chat-actions">
            <button onclick="toggleHistory()" title="Lịch sử"><i class="fas fa-history"></i></button>
            <button onclick="startNewChat()" title="Chat mới"><i class="fas fa-plus"></i></button>
            <button onclick="toggleChatbox()" title="Đóng"><i class="fas fa-times"></i></button>
        </div>
    </div>

    <div class="chatbox-main">
        <!-- History Sidebar -->
        <div class="chat-history-sidebar" id="historySidebar">
            <div class="history-header">
                <strong>Lịch sử chat</strong>
                <button class="btn btn-sm" onclick="toggleHistory()"><i class="fas fa-times"></i></button>
            </div>
            <div class="history-list" id="historyList">
                <!-- Session list here -->
            </div>
        </div>

        <div class="chatbox-messages" id="chatMessages">
            <div class="typing-indicator" id="typingIndicator">
                <span></span><span></span><span></span>
            </div>
        </div>

        <div class="chatbox-input">
            <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." autocomplete="off" onkeypress="if(event.key==='Enter') sendChat()">
            <button onclick="sendChat()" id="sendBtn"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<script>
(function() {
    const CHAT_URLS = {
        history: '{{ route("chat.history") }}',
        sessions: '{{ route("chat.sessions") }}',
        send: '{{ route("chat.send") }}',
        clear: '{{ route("chat.clear") }}'
    };

    // Mỗi lần load trang sẽ là một session mới (như user yêu cầu)
    let currentSessionId = generateSessionId();
    let isHistoryLoaded = false;
    const isLoggedIn = @json(session()->has('userId'));

    function generateSessionId() {
        return 'chat_' + Date.now() + '_' + Math.random().toString(36).substring(2, 9);
    }

    // Toggle chatbox
    window.toggleChatbox = function() {
        const chatbox = document.getElementById('chatbox');
        const badge = document.getElementById('chatBadge');
        chatbox.classList.toggle('show');
        if (chatbox.classList.contains('show')) {
            badge.style.display = 'none';
            document.getElementById('chatInput').focus();
            
            // Nếu chưa có tin nhắn nào trong session hiện tại, hiển thị lời chào
            const container = document.getElementById('chatMessages');
            if (container.children.length <= 1) {
                appendWelcomeMessage();
            }
        }
    };

    window.toggleHistory = function() {
        if (!isLoggedIn) {
            alert('Vui lòng đăng nhập để xem lịch sử chat!');
            return;
        }
        const sidebar = document.getElementById('historySidebar');
        sidebar.classList.toggle('show');
        if (sidebar.classList.contains('show')) {
            loadSessions();
        }
    };

    function appendWelcomeMessage() {
        appendMessage('bot', 'Xin chào! 👋 Tôi là trợ lý AI của Travela.\n\nMỗi khi bạn tải lại trang, một cuộc trò chuyện mới sẽ bắt đầu để đảm bảo tốc độ. Bạn có thể nhấn vào biểu tượng đồng hồ ở trên để xem lại các cuộc trò chuyện cũ nhé! 😊', null, false);
    }

    // Load list of sessions
    function loadSessions() {
        const listContainer = document.getElementById('historyList');
        listContainer.innerHTML = '<div class="text-center p-3"><small>Đang tải...</small></div>';

        fetch(CHAT_URLS.sessions)
            .then(r => r.json())
            .then(data => {
                listContainer.innerHTML = '';
                if (data.success && data.sessions.length > 0) {
                    data.sessions.forEach(session => {
                        const item = document.createElement('div');
                        item.className = 'history-item' + (session.sessionId === currentSessionId ? ' active' : '');
                        item.onclick = () => switchSession(session.sessionId);
                        
                        const date = new Date(session.last_msg).toLocaleDateString('vi-VN');
                        item.innerHTML = `
                            <span class="history-title">${escapeHtml(session.title)}</span>
                            <span class="history-date">${date}</span>
                        `;
                        listContainer.appendChild(item);
                    });
                } else {
                    listContainer.innerHTML = '<div class="text-center p-3"><small>Chưa có lịch sử</small></div>';
                }
            });
    }

    window.switchSession = function(sessionId) {
        currentSessionId = sessionId;
        document.getElementById('historySidebar').classList.remove('show');
        
        // Clear messages and load history for this session
        const container = document.getElementById('chatMessages');
        const typing = document.getElementById('typingIndicator');
        container.innerHTML = '';
        container.appendChild(typing);

        fetch(CHAT_URLS.history + '?sessionId=' + sessionId)
            .then(r => r.json())
            .then(data => {
                if (data.success && data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        appendMessage(msg.sender, msg.message, msg.created_at, false);
                    });
                    scrollToBottom();
                }
            });
    };

    window.startNewChat = function() {
        currentSessionId = generateSessionId();
        const container = document.getElementById('chatMessages');
        const typing = document.getElementById('typingIndicator');
        container.innerHTML = '';
        container.appendChild(typing);
        appendWelcomeMessage();
        document.getElementById('historySidebar').classList.remove('show');
    };

    // Send message
    window.sendChat = function() {
        const input = document.getElementById('chatInput');
        const message = input.value.trim();
        if (!message) return;

        input.value = '';
        appendMessage('user', message);
        showTyping(true);

        fetch(CHAT_URLS.send, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                message: message,
                sessionId: currentSessionId
            })
        })
        .then(r => r.json())
        .then(data => {
            showTyping(false);
            if (data.success) {
                appendMessage('bot', data.reply);
            } else {
                appendMessage('bot', 'Lỗi: ' + (data.message || 'Không thể lấy phản hồi từ AI. Hãy kiểm tra API Key trong .env!'));
            }
        })
        .catch(err => {
            showTyping(false);
            appendMessage('bot', 'Lỗi kết nối server. Vui lòng kiểm tra lại cấu hình! 🔄');
        });
    };

    // Append message to chat
    function appendMessage(sender, message, time, animate = true) {
        const container = document.getElementById('chatMessages');
        const typing = document.getElementById('typingIndicator');

        const div = document.createElement('div');
        div.className = 'chat-message ' + sender;
        if (!animate) div.style.animation = 'none';

        const timeStr = time ? new Date(time).toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'})
                             : new Date().toLocaleTimeString('vi-VN', {hour: '2-digit', minute: '2-digit'});

        div.innerHTML = `
            <div>
                <div class="msg-bubble">${escapeHtml(message)}</div>
                <div class="msg-time">${timeStr}</div>
            </div>
        `;

        container.insertBefore(div, typing);
        scrollToBottom();
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML.replace(/\n/g, '<br>');
    }

    function showTyping(show) {
        document.getElementById('typingIndicator').classList.toggle('show', show);
        document.getElementById('sendBtn').disabled = show;
        if (show) scrollToBottom();
    }

    function scrollToBottom() {
        const container = document.getElementById('chatMessages');
        setTimeout(() => { container.scrollTop = container.scrollHeight; }, 50);
    }
})();
</script>
