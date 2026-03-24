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
        Schema::table('login_logs', function (Blueprint $table) {
            // Add email field if not exists
            if (!Schema::hasColumn('login_logs', 'email_address')) {
                $table->string('email_address')->nullable()->after('user_id');
            }
            
            // Add microseconds field if not exists
            if (!Schema::hasColumn('login_logs', 'logged_at_microseconds')) {
                $table->string('logged_at_microseconds')->nullable()->comment('Microsecond precision timestamp')->after('logged_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('login_logs', function (Blueprint $table) {
            if (Schema::hasColumn('login_logs', 'email_address')) {
                $table->dropColumn('email_address');
            }
            if (Schema::hasColumn('login_logs', 'logged_at_microseconds')) {
                $table->dropColumn('logged_at_microseconds');
            }
        });
    }
};
