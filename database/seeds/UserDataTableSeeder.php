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
            'sex' =>'男',
            'ipone' =>'18937737625',
            'qq' =>'365556520',
            'headimg' =>'222',
        ]);
    }

}
