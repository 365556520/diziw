<?php

namespace App\Http\Controllers\Api\Articles;


use App\Repositories\Eloquent\Admin\Articles\CategorysRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\CommonController;


class CategorysController extends CommonController
{
    /**
     * 文章分类API
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //文章分类仓库
    private $categorys;
    function __construct(CategorysRepository $categorys)
    {
        $this->categorys = $categorys;

    }
    public  function getCategorys(){
        $categorys = $this->categorys->getCategorysList();
        return $this->response($categorys,'文章分类获取成功','200');
    }
}
