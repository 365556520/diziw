<?php
namespace App\Traits;

/*这是一trait*/
trait ActionButtonTrait{
    /*用modal的按钮公共的查看按钮*/
    public function getShowActionButtont(){
        return '<a class="btn btn-primary btn-xs" href="'.url('admin/'.$this->action.'/'.$this->id).'"  data-toggle="modal" data-target="#showModal"><i class="fa fa-search"></i> 查看 </a>&nbsp ';
    }
    /*用modal的按钮公共的修改按钮*/
    public function getEditActionButtont(){
        return '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/edit').'" class="btn btn-info btn-xs" data-toggle="modal" data-target="#eidtModal"><i class="fa fa-edit"></i> 修改 </a>&nbsp ';
    }
    /*不用modal的按钮公共的修改按钮*/
    public function getNoModalEditActionButtont(){
        return '<a href="'.url('admin/'.$this->action.'/'.$this->id.'/edit').'" class="btn btn-info btn-xs" ><i class="fa fa-edit"></i> 修改 </a>&nbsp ';
    }
    /*公共的删除按钮*/
    public function getDestroyActionButtont(){
        /*删除按钮里面添加个隐藏表单*/
        return '<a class="destroy_item btn btn-danger btn-xs" href="javascript:;"><i class="fa fa-trash"></i> 删除
                    <form action="'.url('admin/'.$this->action.'/'.$this->id).'" method="POST" style="display:none">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" value="'.csrf_token().'">
                    </form>
                </a> &nbsp';
    }
    //得到三个按钮config('admin.permissions.menu.delete'))
    public function getActionButtont($showPermission = null,$editPermission = null ,$destroyPermission = null,$Modal = true){
        $thml = '<div class="btn-group btn-group-xs">';
        if ($showPermission == null){
            $thml .= '';
        }else{
            /*有查看权限才加入编写按钮*/
            if(auth()->user()->can($showPermission)){
                $thml .= $this->getShowActionButtont();
            }
        }
        if($editPermission == null){
            $thml .= '';
        }else{
            /*有编写权限才加入编写按钮*/
            if(auth()->user()->can($editPermission)){
                if ($this->is_Role_admin()){
                   $thml .= '<small class="text-danger">不可修改和';
                }else{
                    if ($Modal){
                        $thml .= $this->getEditActionButtont();
                    }else{
                        $thml .= $this->getNoModalEditActionButtont();
                    }
                }
            }
        }

        if($destroyPermission == null){
                $thml .= '';
        } else{
                /*有删除全选才加入删除按钮*/
            if(auth()->user()->can($destroyPermission)){
                 if ($this->is_Role_admin()){
                    $thml .= '删除</small>';
                 }else{
                    $thml .= $this->getDestroyActionButtont();
                 }
             }
        }
        $thml .= '</div>';
        return $thml;
    }
//    判断是否椒超级管理员角色
    public function is_Role_admin(){
        if($this->action=='role'){
            if($this->is_admin()){
                return true;
            }
        }
        return false;
    }
}