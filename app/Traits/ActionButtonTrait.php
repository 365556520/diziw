<?php
namespace App\Traits;

/*这是一trait*/
trait ActionButtonTrait{
    /*公共的查看按钮*/
    public function getShowActionButtont(){
        return '<a href="'.url('admin/'.$this->action.'/'.$this->id).'"  data-toggle="modal" data-target="#showModal"><i class="fa fa-search"></i> 查看 </a>&nbsp ';
    }
    /*公共的修改按钮*/
    public function getEditActionButtont(){
        return '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/edit').'"  data-toggle="modal" data-target="#eidtModal"><i class="fa fa-edit"></i> 修改 </a>&nbsp ';
    }
    /*公共的删除按钮*/
    public function getDestroyActionButtont(){
        return '<a class="destroy_item" href="javascript:;"><i class="fa fa-trash"></i> 删除
                    <form action="'.url('admin/'.$this->action.'/'.$this->id).'" method="POST" style="display:none">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                    </form>
                </a> &nbsp';
    }
    //config('admin.permissions.menu.delete'))
    public function getActionButtont($showPermission = null,$editPermission = null ,$destroyPermission = null){
        $thml = '';
        if ($showPermission == null){
            $thml .= '';
        }else{
            /*有编写权限才加入编写按钮*/
            if(auth()->user()->can($showPermission)){
                $thml .= $this->getShowActionButtont();
            }
        }
        if($editPermission == null){
            $thml .= '';
        }else{
            /*有编写权限才加入编写按钮*/
            if(auth()->user()->can($editPermission)){
                $thml .= $this->getEditActionButtont();
            }
        }
        if($destroyPermission == null){
            $thml .= '';
        }else{
            /*有删除全选才加入删除按钮*/
            if(auth()->user()->can($destroyPermission)){
                $thml .= $this->getDestroyActionButtont();
            }
        }

        return $thml;
    }
}