<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_chat_interaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chat_interaction_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->text('chat_text')->nullable();
            $table->bigInteger('reply_detail_chat_interaction_id')->unsigned();
            $table->boolean('status_read');
            $table->boolean('is_delete');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('chat_interaction_id')->references('id')->on('chat_interactions')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_chat_interaction');
    }
};
