<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // 既存の外部キーとカラムをまとめて削除（データは失われます）
            if (Schema::hasColumn('reviews', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });

        Schema::table('reviews', function (Blueprint $table) {
            // nullable で再作成（ユーザー削除時は NULL）
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
        });

        Schema::table('reviews', function (Blueprint $table) {
            // 非NULL で再作成（ユーザー削除時は CASCADE）
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->after('id');
        });
    }
};

