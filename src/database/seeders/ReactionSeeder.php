<?php

namespace Database\Seeders;

use App\Models\Reaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reaction::factory()->create([
            'name' => 'Good',
        ]);
        Reaction::factory()->create([
            'name' => 'Normal',
        ]);
        Reaction::factory()->create([
            'name' => 'Bad',
        ]);
    }
}
