<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamagochisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamagochis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name')->default('Mi Tamagochi');
            $table->enum('status', ['happy', 'normal', 'sad', 'tired', 'sick', 'sleeping'])->default('normal');
            $table->integer('energy')->default(100); // 0-100
            $table->integer('hunger')->default(50);  // 0-100
            $table->integer('happiness')->default(75); // 0-100
            $table->integer('health')->default(100); // 0-100
            $table->timestamp('last_fed')->nullable();
            $table->timestamp('last_played')->nullable();
            $table->integer('times_played')->default(0);
            $table->integer('level')->default(1);
            $table->integer('experience')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tamagochis');
    }
}
