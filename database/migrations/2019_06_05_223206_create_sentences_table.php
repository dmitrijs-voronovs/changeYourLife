<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentences', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('author_id')->unsigned();
                $table->foreign('author_id')->references('id')->on('users');
            $table->integer('prev_sentence_id')->unsigned()->nullable();
                $table->foreign('prev_sentence_id')->references('id')->on('sentences');
            $table->integer('story_id')->unsigned();
                $table->foreign('story_id')->references('id')->on('story');
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
        Schema::dropIfExists('sentences');
    }
}
