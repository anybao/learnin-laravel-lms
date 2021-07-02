<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->on('users')->references('id')->onDelete('CASCADE');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->on('courses')->references('id')->onDelete('CASCADE');
            $table->unsignedBigInteger('lesson_id');
            $table->foreign('lesson_id')->on('lessons')->references('id')->onDelete('CASCADE');
            $table->integer('minutes_learned')->default(0);
            $table->boolean('is_completed')->default(false);
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
        Schema::dropIfExists('learning_records');
    }
}
