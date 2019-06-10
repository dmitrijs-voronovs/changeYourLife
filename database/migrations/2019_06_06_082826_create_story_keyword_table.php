<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoryKeywordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_keyword', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('story_id')->unsigned();
                $table->foreign('story_id')->references('id')->on('stories');
            $table->integer('keyword_id')->unsigned();
                $table->foreign('keyword_id')->references('id')->on('keywords');
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
        Schema::dropIfExists('story_keyword');
    }
}
