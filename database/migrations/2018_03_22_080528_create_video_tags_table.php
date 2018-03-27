<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //视频标签
        Schema::create('videotags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);//长度50
            $table->timestamps();
        });
        //视频类别
        Schema::create('videoclasss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->string('introduce')->comment('描述'); //描述
            $table->string('preview')->comment('预览图');  //预览图
            $table->tinyInteger('iscommend')->comment('推荐'); //推荐
            $table->tinyInteger('ishot')->comment('热门');  //热门
            $table->integer('click')->comment('点击数');   //点击数
            $table->timestamps();
        });
        //视频内容
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('videoclass_id')->unsigned();
            $table->string('name');
            $table->string('path');
            //外检约束更新和删除都绑定
            $table->foreign('videoclass_id')->references('id')->on('videoclasss') ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('videotags');
        Schema::dropIfExists('videoclasss');
        Schema::dropIfExists('videos');
    }
}
