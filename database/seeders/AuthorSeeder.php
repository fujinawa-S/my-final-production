<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use League\Flysystem\UnableToCreateDirectory;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'name' => '芥見下々',
                'introduction' => '代表作「呪術廻戦」',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
