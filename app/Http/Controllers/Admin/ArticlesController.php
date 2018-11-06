<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Eloquent\Admin\Articles\ArticlesRepository;
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
    function __construct(ArticlesRepository $article)
    {

        //调用父累的构造方法
        parent::__construct('articles');
        $this->article = $article;

    }
    public function index()
    {
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
