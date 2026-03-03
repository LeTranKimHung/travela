<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tbl_booking', function (Blueprint $table) {
            $table->string('couponCode', 50)->nullable();
            $table->decimal('discountAmount', 15, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_booking', function (Blueprint $table) {
            $table->dropColumn(['couponCode', 'discountAmount']);
        });
    }
};
