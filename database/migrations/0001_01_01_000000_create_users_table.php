<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table): void {
            $table->id();
            $table->string('uuid', 191)->index();
            $table->string('nickname', 32)->nullable();
            $table->string('password')->nullable();
            $table->unsignedSmallInteger('role');
            $table->unsignedSmallInteger('grade');
            $table->float('experience');
            $table->json('responsibilities');
            $table->json('permissions')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
