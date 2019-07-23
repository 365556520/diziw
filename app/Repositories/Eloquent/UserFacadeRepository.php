<?php
namespace App\Repositories\Eloquent;
/**
 * 门面模式
 * User: admin
 * Date: 2018/1/14
 * Time: 9:43
 */
use App\Models\Role;
use App\User;
use App\Repositories\Contracts\UserInterface;
use Illuminate\Support\Facades\Auth;
class UserFacadeRepository implements UserInterface {
    /*根据用户id查找用户信息
    */
    public function findBy($id){
        return User::find($id);
    }
    /*
     * 用户名认证并签发token
     * */
    public function userLogin($username,$password){
        $content = array();
        //判断用户存在不
        if(Auth::attempt(['username' => $username, 'password' =>$password]))
        {
            $user = Auth::user();
            $content['token'] =  $user->createToken('Pi App')->accessToken; //创建令牌
            $content['message'] =  '登录成功';
            $content['code'] = 200;
        } else {
            $content['error'] = "未授权";
            $content['code'] = 401;
        }
        return $content;
    }
    /*
     * 判断用户是否存在
     * */
    public function isUser($lname,$data){
       return User::where($lname, $data)->exists();
    }
}