<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postideas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('idea_name');
            $table->string('summary');
            $table->string('content');
            $table->integer('price');
            $table->unsignedBigInteger('post_user_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign(('category_id'))
            ->references('id')
            ->on('categories');

            $table->foreign('post_user_id')
            ->references('id')
            ->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postideas', function (Blueprint $table) {
            $table->dropForeign('postideas_post_user_id_foreign');
            $table->dropColumn('post_user_id');
            $table->dropForeign('postideas_category_id_foreign');
            $table->dropColumn('category_id');
        });
        
        Schema::dropIfExists('postideas');
    }
}
