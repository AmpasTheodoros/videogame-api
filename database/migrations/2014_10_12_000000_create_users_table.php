<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique(); // Unique constraint
            $table->string('password');
            $table->string('role')->default('user');
            $table->timestamps(); // 👈 Keep this since the model has `public $timestamps = false`
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
