<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            [
                'name' => 'ファンタジー',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ラブコメ',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'SF',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ホラー',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'アクション',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
        //
    }
}
