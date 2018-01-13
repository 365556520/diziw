<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *创建角色
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = '超级管理员';
        $admin->description = '超级管理员';
        $admin->save();

        $owner = new Role();
        $owner->name = 'user';
        $owner->display_name = '普通管理';
        $owner->description = '普通管理';
        $owner->save();
//        给角色绑定权限
//      第一种方法 管理员把所有权限的id查找出来
        $allPermission = array_column(Permission::all()->toArray(),'id');
        //给管理员的绑定权>perms()->sync($allPermission);限这种方法只能通过id和id数组绑定权限
        $admin->perms()->sync($allPermission);
        /*普通用户
        第二种方法 把创建用户权限给查找出来
        */
        $sreateUser = Permission::where('display_name','创建用户')->first();
        //然后通过attachPermissions()把角色绑定这个权限
        $owner->attachPermission($sreateUser);

    }
}
