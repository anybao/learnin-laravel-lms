<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chapter_id');
            $table->foreign('chapter_id')->on('chapters')->references('id')->onDelete('CASCADE');
            $table->string('title');
            $table->text('body')->nullable();
            $table->string('slug')->nullable();
            $table->integer('minutes_length')->default(0);
            $table->string('video_url')->nullable();
            $table->boolean('is_free')->default(false);
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
        Schema::dropIfExists('lessons');
    }
}
