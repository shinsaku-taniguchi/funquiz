<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artist::factory()->create([
            'name' => 'James Brown',
        ]);
        Artist::factory()->create([
            'name' => 'Funkadelic',
        ]);
        Artist::factory()->create([
            'name' => 'じゃがたら',
        ]);
    }
}
