<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'mail_log';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('employee_id')->comment('ID сотрудника');
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->unsignedBigInteger('mail_template_id')->comment('ID шаблона письма');
            $table->foreign('mail_template_id')->references('id')->on('mail_templates');

            $table->boolean('is_send_success')->comment('Статус успешности отправки');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->dropForeign(['mail_template_id']);
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists($this->tableName);
    }
};
