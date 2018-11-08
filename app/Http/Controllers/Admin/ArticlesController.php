<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\Admin\Articles\ArticlesRepository;
use App\Repositories\Eloquent\Admin\Articles\CategorysRepository;
use Illuminate\Http\Request;


class ArticlesController extends CommonController
{
    /**
     * 文章路由
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //文章分类仓库
    private $article;
    private $categorys;
    function __construct(ArticlesRepository $article,CategorysRepository $categorys)
    {

        //调用父累的构造方法
        parent::__construct('articles');
        $this->article = $article;
        $this->categorys = $categorys;

    }
    /*
 * 列表数据
 * */
    public function ajaxIndex(Request $request){
        $result = $this->article->ajaxIndex($request->all());
        return response()->json($result);
    }

    public function index()
    {
        //得到树列表
        dd($this->categorys->getTree());
        //显示
        return view("admin.articles.articles.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
