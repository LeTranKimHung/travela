<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_notifications', function (Blueprint $table) {
            $table->id('notifId');
            $table->unsignedBigInteger('userId');         // Người nhận (0 = tất cả)
            $table->string('type', 50);                  // 'booking_confirmed', 'booking_cancelled', 'new_post'
            $table->string('title', 255);                // Tiêu đề
            $table->text('message');                     // Nội dung
            $table->string('link', 500)->nullable();     // URL đích
            $table->boolean('is_read')->default(false);  // Đã đọc?
            $table->timestamps();

            $table->index(['userId', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_notifications');
    }
};
