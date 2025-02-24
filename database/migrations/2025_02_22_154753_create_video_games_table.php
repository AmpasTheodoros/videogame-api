<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('video_games', function (Blueprint $table) {
            $table->id(); // BIGINT primary key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->date('release_date');
            $table->string('genre');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_games');
    }
};
