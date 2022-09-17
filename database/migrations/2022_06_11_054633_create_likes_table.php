<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('postProjects')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function(Blueprint $table){
            $table->dropForeign('likes_project_id_foreign');
            $table->dropColumn('project_id');
            $table->dropForeign('likes_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('likes');
    }
}
