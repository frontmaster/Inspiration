<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoughtIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bought_ideas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idea_name');
            $table->string('summary');
            $table->string('content');
            $table->integer('price');
            $table->unsignedBigInteger('post_user_id');
            $table->unsignedBigInteger('buy_user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('idea_id');
            $table->timestamps();

            $table->foreign(('post_user_id'))->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign(('category_id'))->references('id')->on('categories');
            $table->foreign('buy_user_id')->references('id')->on('users');
            $table->foreign('idea_id')->references('id')->on('postideas');
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bought_ideas', function (Blueprint $table) {
            $table->dropForeign('bought_ideas_post_user_id_foreign');
            $table->dropColumn('post_user_id');
            $table->dropForeign('bought_ideas_buy_user_id_foreign');
            $table->dropColumn('buy_user_id');
            $table->dropForeign('bought_ideas_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropForeign('bought_ideas_idea_id_foreign');
            $table->dropColumn('idea_id');
        });

        Schema::dropIfExists('bought_ideas');
    }
}
