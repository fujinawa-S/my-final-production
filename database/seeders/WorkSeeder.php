<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    public function run(): void
    {
        $works = [
            [
                'title' => '呪術廻戦',
                'author' => '芥見下々',
                'genre' => 'ダークファンタジー',
                'publisher' => '集英社',
                'serialization_start' => '2018-03-05',
                'serialization_end' => null,
                'status' => 'ongoing',
                'summary' => '呪霊と呪術師の戦いを描くダークファンタジー。',
                'image' => 'https://cdn.myanimelist.net/images/manga/3/191783.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => '鬼滅の刃',
                'author' => '吾峠呼世晴',
                'genre' => 'ダークファンタジー',
                'publisher' => '集英社',
                'serialization_start' => '2016-02-15',
                'serialization_end' => '2020-05-18',
                'status' => 'completed',
                'summary' => '鬼に家族を奪われた炭治郎が妹を救うために戦う物語。',
                'image' => 'https://cdn.myanimelist.net/images/manga/2/220100.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => '進撃の巨人',
                'author' => '諫山創',
                'genre' => 'ダークファンタジー',
                'publisher' => '講談社',
                'serialization_start' => '2009-09-09',
                'serialization_end' => '2021-04-09',
                'status' => 'completed',
                'summary' => '巨人に支配された世界で自由を求める人類の戦い。',
                'image' => 'https://cdn.myanimelist.net/images/manga/2/37846.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => 'SPY×FAMILY',
                'author' => '遠藤達哉',
                'genre' => 'コメディ',
                'publisher' => '集英社',
                'serialization_start' => '2019-03-25',
                'serialization_end' => null,
                'status' => 'ongoing',
                'summary' => '仮初め家族が秘密を抱えながら任務と日常を両立する。',
                'image' => 'https://cdn.myanimelist.net/images/manga/2/222765.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => '僕のヒーローアカデミア',
                'author' => '堀越耕平',
                'genre' => 'アクション',
                'publisher' => '集英社',
                'serialization_start' => '2014-07-07',
                'serialization_end' => null,
                'status' => 'ongoing',
                'summary' => '無個性だった少年がヒーローを目指す成長譚。',
                'image' => 'https://cdn.myanimelist.net/images/manga/3/242220.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => 'ハイキュー!!',
                'author' => '古舘春一',
                'genre' => 'スポーツ',
                'publisher' => '集英社',
                'serialization_start' => '2012-02-20',
                'serialization_end' => '2020-07-20',
                'status' => 'completed',
                'summary' => '高校バレー部を舞台にした青春スポーツドラマ。',
                'image' => 'https://cdn.myanimelist.net/images/manga/2/161796.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => 'チェンソーマン',
                'author' => '藤本タツキ',
                'genre' => 'ダークファンタジー',
                'publisher' => '集英社',
                'serialization_start' => '2018-12-03',
                'serialization_end' => null,
                'status' => 'ongoing',
                'summary' => '悪魔と契約した少年が過酷な任務に挑む。',
                'image' => 'https://cdn.myanimelist.net/images/manga/2/191496.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => 'ONE PIECE',
                'author' => '尾田栄一郎',
                'genre' => 'アドベンチャー',
                'publisher' => '集英社',
                'serialization_start' => '1997-07-22',
                'serialization_end' => null,
                'status' => 'ongoing',
                'summary' => '海賊王を目指す麦わらの一味の冒険譚。',
                'image' => 'https://cdn.myanimelist.net/images/manga/3/55539.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => 'BLEACH',
                'author' => '久保帯人',
                'genre' => 'ダークファンタジー',
                'publisher' => '集英社',
                'serialization_start' => '2001-08-07',
                'serialization_end' => '2016-08-22',
                'status' => 'completed',
                'summary' => '死神の力を得た黒崎一護の戦いを描く。',
                'image' => 'https://cdn.myanimelist.net/images/manga/2/176913.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => 'ブルーロック',
                'author' => '金城宗幸／ノ村優介',
                'genre' => 'スポーツ',
                'publisher' => '講談社',
                'serialization_start' => '2018-08-01',
                'serialization_end' => null,
                'status' => 'ongoing',
                'summary' => '日本最強のストライカー育成プロジェクトに挑む。',
                'image' => 'https://cdn.myanimelist.net/images/manga/3/201598.jpg',
                'is_anime_adapted' => true,
            ],
            [
                'title' => '約束のネバーランド',
                'author' => '白井カイウ／出水ぽすか',
                'genre' => 'サスペンス',
                'publisher' => '集英社',
                'serialization_start' => '2016-08-01',
                'serialization_end' => '2020-06-15',
                'status' => 'completed',
                'summary' => '孤児院の真実を知った子ども達の脱獄計画。',
                'image' => 'https://cdn.myanimelist.net/images/manga/3/188054.jpg',
                'is_anime_adapted' => true,
            ],
        ];

        foreach ($works as $work) {
            $authorId = $this->idFor('authors', $work['author']);
            $genreId = $this->idFor('genres', $work['genre']);
            $publisherId = $this->idFor('publishers', $work['publisher']);

            DB::table('works')->updateOrInsert(
                ['title' => $work['title']],
                [
                    'author_id' => $authorId,
                    'genre_id' => $genreId,
                    'publisher_id' => $publisherId,
                    'serialization_start_date' => $work['serialization_start'],
                    'serialization_end_date' => $work['serialization_end'],
                    'serialization_status' => $work['status'],
                    'summary' => $work['summary'],
                    'image' => $work['image'],
                    'is_anime_adapted' => $work['is_anime_adapted'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }

    private function idFor(string $table, string $name): int
    {
        $id = DB::table($table)->where('name', $name)->value('id');

        if ($id) {
            return $id;
        }

        return DB::table($table)->insertGetId([
            'name' => $name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
