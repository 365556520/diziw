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
    //获取文章列表
    public  function getArticles(Request $request){
        $data = $request->all();
        $data['limit']=(int)$data['limit'];
        $data['page']=(int)$data['page'];
        $result = $this->articles->getArticles($data);
        $result['data'] = $this->articles->getimgurl($result['data']);
        return $this->response($result,'backend/images/articleImages/','200');
    }
    //获取文章内容
    public function getArticlesContent($id){
        $content = $this->articles->getArticlesContent($id);
        return $this->response($content,'文章内容获取成功','200');
    }
}
