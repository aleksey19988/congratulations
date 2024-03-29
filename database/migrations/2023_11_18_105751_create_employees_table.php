<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private string $tableName = 'employees';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('Имя');
            $table->string('last_name')->comment('Фамилия');
            $table->string('patronymic')->nullable()->comment('Отчество');
            $table->dateTime('birthday')->comment('Дата рождения');
            $table->string('email')->comment('Электропочта');

            $table->unsignedBigInteger('position_id')->comment('Id должности');
            $table->foreign('position_id')->references('id')->on('positions');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->tableName, function (Blueprint $table) {
            $table->dropForeign(['position_id']);
        });
        Schema::dropIfExists($this->tableName);
    }
};
