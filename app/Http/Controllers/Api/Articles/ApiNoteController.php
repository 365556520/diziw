<?php

namespace App\Http\Controllers\Api\Articles;

use App\Repositories\Eloquent\Admin\Articles\NoteRepository;
use App\Http\Controllers\Api\CommonController;


class ApiNoteController extends CommonController
{
    /**
     * 备忘录
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //获取某月所有备忘录
    private $note;
    function __construct(NoteRepository $note)
    {
        $this->note = $note;

    }
    public  function getNote($year,$month){
        $data = $this->note->getMonthNote($year,$month);
        return $this->response($data,'获取成功','200');
    }
}
