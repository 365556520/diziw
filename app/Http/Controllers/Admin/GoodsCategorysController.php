<?php

namespace App\Http\Controllers\Admin;


use App\Repositories\Eloquent\Admin\Goods\GoodsCategorysRepository;
use Illuminate\Http\Request;


class GoodsCategorysController extends CommonController
{
    /**
     * 商品分类路由
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //商品分类仓库
    private $goodscategorys;
    function __construct(GoodsCategorysRepository $goodscategorys)
    {
        //调用父累的构造方法
        parent::__construct('goodscategorys');
        $this->goodscategorys = $goodscategorys;
    }

    public function index()
    {
        return view("admin.goods.goodscategorys.list");
    }
    /*
     * 列表数据
     * */
    public function ajaxIndex(Request $request){
        $result = $this->goodscategorys->ajaxIndex($request->all());
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *添加商品分类视图
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //得到所有商品分类
        $categorys= $this->goodscategorys->getGoodsCategorysList();
        return view("admin.goods.goodscategorys.add")->with(compact('categorys'));
    }
    /**
     * Store a newly created resource in storage.
     *添加商品商品分类
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result =  $this->goodscategorys->createGoodsCategorys($request->all());
        return redirect(url('admin/goodscategorys/create'));
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
     *修改商品分类视图
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorysEdit = $this->categorys->find($id);
        //得到所有商品分类
        $categorys = $this->categorys->getCategorysList();
        return view("admin.articles.categorys.edit")->with(compact('categorysEdit','categorys'));
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
        $this->categorys->updateCategorys($request->all(),$id);
        return redirect('admin/categorys/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categorys->destroyCategorys($id);
        return redirect(url('admin/categorys'));
    }

    /*
     * 批量删除
     * */
    public function destroys($data){
        //把json转换成数组然后用数组函数支取id列
        $id = array_column(json_decode($data),'id');
        $this->categorys->destroyCategorys($id);
        return redirect(url('admin/categorys'));
    }
}
