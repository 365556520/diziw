<?php

use Illuminate\Database\Seeder;
use App\Models\UsersModel\User_Data;
class UserDataTableSeeder extends Seeder
{
    public function run(){
        User_Data::create([
            'user_id' =>1,
            'nickname' =>'小强昵称',
            'age' =>31,
            'sex' => 1,
            'ipone' =>'18937737625',
            'qq' =>'365556520',
            'headimg' =>'/backend/images/uploads/img.png',
            'address' => '中国河南省南阳市',
            'hobby' => '爱好、编程、玩游戏、听歌、吃',
            'Readme' => '相信未来是美好的，再牛逼的梦想也抵不过，傻逼一样的坚持。',
        ]);
    }

}
