<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('essay_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_result_id');
            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('module_id');
            $table->text('question');
            $table->text('user_answer')->nullable();
            $table->integer('score')->nullable();
            $table->unsignedBigInteger('graded_by')->nullable();
            $table->timestamp('graded_at')->nullable();
            $table->timestamps();

            $table->foreign('quiz_result_id')->references('id')->on('quiz_results')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('user_id')->references('id_users')->on('users')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('graded_by')->references('id_users')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('essay_answers');
    }
};

