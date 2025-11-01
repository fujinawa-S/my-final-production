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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('work_id')->constrained('works')->onDelete('cascade');

            //基本情報
            $table->string('title')->nullable();
            $table->text('summary')->nullable();

            $table->unsignedBigInteger('anime_episode_count')->nullable();
            $table->unsignedBigInteger('manga_volume_count')->nullable();

            $table->enum('media_type', ['anime', 'manga', 'both'])->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
