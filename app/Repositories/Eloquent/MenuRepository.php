<?php
namespace App\Repositories\Eloquent;
/**
 * Created by
 * User: 小强
 * Date: 2018/1/19
 * Time: 15:55
 * 说明：
 */
use App\Models\Menu;
use App\Repositories\Eloquent\Repository;

class  MenuRepository extends Repository{
    public function model(){
        return Menu::class;
    }
}