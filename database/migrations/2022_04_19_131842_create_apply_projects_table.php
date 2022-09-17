<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('low_price')->nullable();
            $table->integer('high_price')->nullable();
            $table->string('content');
            $table->unsignedBigInteger('post_user_id');
            $table->unsignedBigInteger('apply_user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->foreign('post_user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('apply_user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('project_id')->references('id')->on('postProjects')->onDelete('CASCADE');
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
        Schema::table('apply_projects', function (Blueprint $table) {
            $table->dropForeign('apply_projects_post_user_id_foreign');
            $table->dropColumn('post_user_id');
            $table->dropForeign('apply_projects_apply_user_id_foreign');
            $table->dropColumn('apply_user_id');
            $table->dropForeign('apply_projects_category_id_foreign');
            $table->dropColumn('category_id');
            $table->dropForeign('apply_projects_project_id_foreign');
            $table->dropColumn('project_id');
        });
        Schema::dropIfExists('apply_projects');
    }
}
