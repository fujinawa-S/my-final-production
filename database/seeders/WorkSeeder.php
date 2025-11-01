<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $author_akutami = DB::table('authors')->where('name', '芥見下々')->first();
        $genre_action = DB::table('genres')->where('name', 'アクション')->first();
        $publisher_shueisha = DB::table('publishers')->where('name', '集英社')->first();

        if (!$author_akutami || !$genre_action || !$publisher_shueisha) {
            $this->command->info('Warning: Required IDs not found. Skip WorkSeeder.');
            return;
        }
        DB::table('works')->insert([
            'author_id' => $author_akutami->id,
            'genre_id' => $genre_action->id,
            'publisher_id' => $publisher_shueisha->id,
            'title' => '呪術廻戦',
            'serialization_start_date' => '2018-03-05',
            'serialization_end_date' => null, // 連載中
            'serialization_status' => 'ongoing',
            'summary' => '高校生の虎杖悠仁が呪いと戦う物語。',
            'image' => 'jujutsu_kaisen.jpg',
            'is_anime_adapted' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
