<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postProjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('low_price')->nullable();
            $table->integer('high_price')->nullable();
            $table->string('content');
            $table->unsignedBigInteger('post_user_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('post_user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postProjects', function (Blueprint $table) {
            $table->dropForeign('postProjects_post_user_id_foreign');
            $table->dropColumn('post_user_id');
            $table->dropForeign('postProjects_category_id_foreign');
            $table->dropColumn('category_id');
        });
        Schema::dropIfExists('postProject');
    }
}
