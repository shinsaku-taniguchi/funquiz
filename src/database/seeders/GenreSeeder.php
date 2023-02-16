<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::factory()->create([
            'name' => 'ファンク',
        ]);
        Genre::factory()->create([
            'name' => 'ソウル',
        ]);
        Genre::factory()->create([
            'name' => 'アフロビート',
        ]);
    }
}
