<?php

namespace Database\Seeders;

use App\Models\MailTemplate;
use Database\Factories\MailTemplateFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MailTemplate::factory(10)->create();
    }
}
