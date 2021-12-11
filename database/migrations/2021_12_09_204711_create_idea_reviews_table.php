<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeaReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idea_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_idea_id');
            $table->unsignedBigInteger('post_user_id');
            $table->integer('stars')->default(0);
            $table->double('score', 1, 1);
            $table->text('comment');
            $table->timestamps();

            $table->foreign('post_idea_id')->references('id')->on('postideas');
            $table->foreign('post_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('idea_reviews');
    }
}
