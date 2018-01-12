<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *创建权限
     * @return void
     */
    public function run()
    {
        $permission = new Permission();
        $permission->name = 'create users';
        $permission->display_name = '创建用户';
        $permission->description = '创建用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'edit users';
        $permission->display_name = '修改用户';
        $permission->description = '修改用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'destroy users';
        $permission->display_name = '删除用户';
        $permission->description = '删除用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'ban users';
        $permission->display_name = '禁用用户';
        $permission->description = '禁用用户';
        $permission->save();

        $permission = new Permission();
        $permission->name = 'login users';
        $permission->display_name = '登录用户';
        $permission->description = '登录用户';
        $permission->save();
    }
}
