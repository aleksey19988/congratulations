<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::factory()->createMany([
            ['name' => 'Оператор'],
            ['name' => 'Супервайзер'],
            ['name' => 'Руководитель группы'],
            ['name' => 'Руководитель направления'],
            ['name' => 'Помощник менеджера'],
            ['name' => 'Менеджер'],
        ]);
    }
}
