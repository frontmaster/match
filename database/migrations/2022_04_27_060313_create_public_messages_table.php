<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msg');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('post_user_id');
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('post_user_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::table('public_messages', function (Blueprint $table) {
            $table->dropForeign('public_messages_sender_id_foreign');
            $table->dropColumn('sender_id');
            $table->dropForeign('public_messages_post_user_id_foreign');
            $table->dropColumn('post_user_id');
            $table->dropForeign('public_messages_project_id_foreign');
            $table->dropColumn('project_id');
        });
        Schema::dropIfExists('public_messages');
    }
}
