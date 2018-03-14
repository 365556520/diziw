<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\UsersModel\User_Data;
class UsersTableSeeder extends Seeder
{   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        //查找出来管理员和user
        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();
        //创建用户
        $admin = factory('App\User')->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => '365556520@qq.com',
            'password' => bcrypt('123456')
        ])->each(function ($u) use ($adminRole){
            //这是个闭包函数 添加角色
            $u->attachRole($adminRole);
        });
        //创建普通用户
        $users = factory('App\User',50)->create([
            'name' => 'user',
            'password' => bcrypt('123456')
        ])->each(function ($u) use ($userRole){
            //关联用户数据
            $u->getUserData()->save( new User_Data(['user_id' => $u->id]));
            //添加角色和上面的一样都是添加角色上面是用对象，这里只能用id
            $u->roles()->attach($userRole->id);
        });
    }
}
