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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_otp_verified')->default(false)->after('otp_expires_at');
            $table->unsignedTinyInteger('otp_resend_count')->default(0)->after('is_otp_verified');
            $table->timestamp('otp_resend_locked_until')->nullable()->after('otp_resend_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_otp_verified', 'otp_resend_count', 'otp_resend_locked_until']);
        });
    }
};
