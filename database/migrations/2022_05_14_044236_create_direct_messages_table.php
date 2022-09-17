<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msg');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('post_user_id');
            $table->unsignedBigInteger('apply_user_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('post_user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('apply_user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('postProjects')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('direct_messages', function(Blueprint $table){
            $table->dropForeign('direct_messages_sender_id_foreign');
            $table->dropColumn('sender_id');
            $table->dropForeign('direct_messages_post_user_id_foreign');
            $table->dropColumn('post_user_id');
            $table->dropForeign('direct_messages_apply_user_id_foreign');
            $table->dropColumn('apply_user_id');
            $table->dropForeign('direct_messages_project_id_foreign');
            $table->dropColumn('project_id');
        });
        Schema::dropIfExists('direct_messages');
    }
}
