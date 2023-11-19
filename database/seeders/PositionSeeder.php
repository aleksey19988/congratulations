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
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Position::factory()->create([
            'name' => 'Оператор',
        ]);

        Position::factory()->create([
            'name' => 'Супервайзер',
        ]);

        Position::factory()->create([
            'name' => 'Руководитель группы',
        ]);

        Position::factory()->create([
            'name' => 'Руководитель направления',
        ]);

        Position::factory()->create([
            'name' => 'Помощник менеджера',
        ]);

        Position::factory()->create([
            'name' => 'Менеджер',
        ]);
    }
}
