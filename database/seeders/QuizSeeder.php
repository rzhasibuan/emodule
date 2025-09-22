<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::create([
            'module_id' => 1,
            'question' => 'What is the capital of Indonesia?',
            'option_a' => 'Jakarta',
            'option_b' => 'Bandung',
            'option_c' => 'Surabaya',
            'option_d' => 'Medan',
            'correct_answer' => 'a',
            'type' => 'multiple_choice',
        ]);

        Quiz::create([
            'module_id' => 1,
            'question' => 'What is the main purpose of a web server?',
            'option_a' => 'To store files',
            'option_b' => 'To serve web pages to clients',
            'option_c' => 'To run applications',
            'option_d' => 'To send emails',
            'correct_answer' => 'b',
            'type' => 'multiple_choice',
        ]);

        Quiz::create([
            'module_id' => 1,
            'question' => 'Explain the difference between HTTP and HTTPS.',
            'answer_key' => 'HTTPS is the secure version of HTTP. It uses SSL/TLS to encrypt the data transmitted between the client and the server.',
            'type' => 'essay',
        ]);
    }
}
