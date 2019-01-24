<?php

namespace App\Http\Controllers\Api\Articles;

use App\Repositories\Eloquent\Admin\Articles\ArticlesRepository;
use App\Http\Controllers\Api\CommonController;
use Illuminate\Http\Request;


class ApiArticlesController extends CommonController
{
    /**
     * 文章API
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //文章仓库
    private $articles;
    function __construct(ArticlesRepository $Articles)
    {
        $this->articles = $Articles;

    }
    public  function getArticles(Request $request){
        $result = $this->articles->ajaxIndex($request->all());
        return $this->response($result,'文章分类获取成功','200');
    }
}
