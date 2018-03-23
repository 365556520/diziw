<?php
use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backend = Menu::create([
            'name' => '视频控制',
            'icon' => 'fa fa-cog',
            'parent_id' => '0',
            'slug' => 'system.login',
            'url' => 'admin/videotag',
            'heightlight_url' => 'admin/videotag*,admin/videos*',
        ]);
        Menu::create([
            'name' => '视频标签管理',
            'parent_id' => $backend->id,
            'slug' => 'videotag.list',
            'url' => 'admin/videotag',
            'heightlight_url' => 'admin/videotag*',
        ]);
        Menu::create([
            'name' => '视频管理',
            'parent_id' => $backend->id,
            'slug' => 'video.list',
            'url' => 'admin/video',
            'heightlight_url' => 'admin/videos*',
        ]);

        $system = Menu::create([
            'name' => '系统管理',
            'icon' => 'fa fa-home',
            'parent_id' => '0',
            'slug' => 'system.manage',
            'url' => 'admin/menu',
            'heightlight_url' => 'admin/menu*,admin/user*,admin/role*,admin/permission*',
        ]);

        Menu::create([
            'name' => '菜单管理',
            'parent_id' => $system->id,
            'slug' => 'menu.list',
            'url' => 'admin/menu',
            'heightlight_url' => 'admin/menu*',
        ]);

        Menu::create([
            'name' => '用户管理',
            'parent_id' => $system->id,
            'slug' => 'user.list',
            'url' => 'admin/user',
            'heightlight_url' => 'admin/user*',
        ]);

        Menu::create([
            'name' => '权限管理',
            'parent_id' => $system->id,
            'slug' => 'permission.list',
            'url' => 'admin/permission',
            'heightlight_url' => 'admin/permission*',
        ]);

        Menu::create([
            'name' => '角色管理',
            'parent_id' => $system->id,
            'slug' => 'role.list',
            'url' => 'admin/role',
            'heightlight_url' => 'admin/role*',
        ]);
    }
}
