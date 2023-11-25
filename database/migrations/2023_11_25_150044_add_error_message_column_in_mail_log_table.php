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
        Schema::table('mail_log', function (Blueprint $table) {
            $table->addColumn('text', 'error_message')->after('is_send_success')->nullable()->comment('Текст ошибки');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mail_log', function (Blueprint $table) {
            $table->dropColumn('error_message');
        });
    }
};
