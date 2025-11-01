<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publishers')->insert([
            [
                'name' => '集英社',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '講談社',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        //
    }
}
