<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *文章表
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->default("")->comment('标题');
            $table->string('tag',100)->default("")->comment('关键词');
            $table->string('description',150)->default("")->comment('描述');
            $table->string('thumb')->default("")->comment('缩略图');
            $table->string('view')->default("")->comment('查看次数');
            $table->integer('category_id')->default("")->comment('分类id');
            $table->integer('user_id')->default("")->comment('作者id');
            $table->text('content')->comment('内容');
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
        Schema::dropIfExists('articles');
    }
}
