<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *评论表
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topic_id')->default(0)->comment('主题id');
            $table->string('topic_type')->default("")->comment('主题type');
            $table->text('content')->comment('内容');
            $table->integer('from_uid')->default(0)->comment('评论用户id');
            $table->integer('to_uid')->default(0)->comment('评论目标用户id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
