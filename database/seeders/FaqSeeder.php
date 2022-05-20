<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;
use Faker\Factory;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            Faq::create([
                'question' => $faker->sentence,
                'answer' => $faker->sentence,
            ]);
        }
    }
}
