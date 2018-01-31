<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.permission.list');
    }
//权限表DataTables
    public function ajaxIndex(){
        $draw = request('draw',1);
        $permissions=[];
        for($i=0;$i < 20; $i++){
            $permissions[$i]['zhang'] = 'zhang'.rand(0,9);
            $permissions[$i]['li'] = 'li'.rand(0,9);
            $permissions[$i]['wang'] = 'wang'.rand(0,9);
            $permissions[$i]['zhao'] = 'zhao'.rand(0,9);
            $permissions[$i]['age'] = rand(0,9);
        }
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => 20,
            'recordsFiltered' => 20,
            'data' => $permissions,
        ]);
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
