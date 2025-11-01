<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PharIo\Manifest\Author;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();

            //作者
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');

            //ジャンル
            $table->foreignId('genre_id')->constrained('genres')->onDelete('cascade');

            //出版社
            $table->foreignId('publisher_id')->constrained('publishers')->onDelete('cascade');

            //基本情報
            $table->string('title');
            $table->text('summary')->nullable();
            $table->string('image')->nullable();

            //連載情報
            $table->date('serialization_start_date')->nullable();
            $table->date('serialization_end_date')->nullable();

            //連載中かどうか
            $table->enum('serialization_status', ['ongoing', 'completed', 'hiatus'])->nullable();

            //メディアタイプ
            $table->boolean('is_anime_adapted')->default(false);


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
