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
            $table->unsignedBigInteger('to_user_id');
            $table->string('idea_name');
            $table->string('user_img')->nullable();
            $table->string('user_name');
            $table->integer('stars')->default(0);
            $table->text('comment');
            $table->timestamps();

            $table->foreign('post_idea_id')->references('id')->on('postideas')->onDelete('CASCADE');
            $table->foreign('post_user_id')->references('id')->on('users');
            $table->foreign('to_user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('idea_reviews', function (Blueprint $table) {
            $table->dropForeign('idea_reviews_post_idea_id_foreign');
            $table->dropColumn('post_idea_id');
            $table->dropForeign('idea_reviews_post_user_id_foreign');
            $table->dropColumn('post_user_id');
            $table->dropForeign('idea_reviews_to_user_id_foreign');
            $table->dropColumn('to_user_id');
        });
        Schema::dropIfExists('idea_reviews');
    }
}
