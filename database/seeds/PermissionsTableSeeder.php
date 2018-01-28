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
        Permission::create([
            'name' => 'system.login',
            'display_name' => '登录后台',
            'description' => '登录后台',
        ]);
        /**
         * 菜单权限
         */
        Permission::create([
            'name' => 'menu.list',
            'display_name' => '菜单列表',
            'description' => '菜单列表',
        ]);
        Permission::create([
            'name' => 'menu.add',
            'display_name' => '添加菜单',
            'description' => '添加菜单',
        ]);
        Permission::create([
            'name' => 'menu.edit',
            'display_name' => '修改菜单',
            'description' => '修改菜单',
        ]);
        Permission::create([
            'name' => 'menu.delete',
            'display_name' => '删除菜单',
            'description' => '删除菜单',
        ]);

    }
}
