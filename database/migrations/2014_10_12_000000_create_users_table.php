<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration{
    /**
 * Run the migrations.
 *
 * @return void
 */
    public function up(){
        //用户表
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        //用户信息表
        Schema::create('user_data', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique();
            $table->string('nickname')->nullable();
            $table->integer('age')->nullable();
            $table->integer('sex')->nullable();
            $table->string('ipone')->nullable();
            $table->string('qq')->nullable();
            $table->string('headimg')->nullable();
            $table->string('address')->nullable(); /*家庭住址*/
            $table->string('hobby')->nullable();//   个人爱好
            $table->string('Readme')->nullable();//     自述
            //外检约束更新和删除都绑定
            $table->foreign('user_id')->references('id')->on('users') ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_data');
    }
}
