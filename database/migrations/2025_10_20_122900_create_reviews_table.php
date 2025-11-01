<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            //誰の投稿か
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            //どの作品への投稿か
            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');

            //どの話か
            $table->foreignId('episode_id')
                ->nullable()
                ->constrained('episodes')
                ->onDelete('cascade');

            $table->text('title');
            $table->text('body');

            //ネタバレ
            $table->boolean('is_spoiler')->default(false);
            $table->boolean('is_published')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
