<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function rules(){
        $rules = [
            'name' => 'required|string|max:255',
            //这里是添加自定义字段规则
            'password' => 'required|string|min:6|confirmed',
        ];
        if (request('id','')) {
            //注意验证唯一unique:roles,name,中unique:后面的表名必须和数据库中的表名一样
            $rules['username'] = 'required|unique:users,username,'.$this->id;
            $rules['email'] = 'required|string|email|max:255|unique:users,email'.$this->id;
        }else{
            $rules['username'] = 'required|unique:users,username';
            $rules['email'] = 'required|unique:users,email';
        }
        return $rules;
    }

    public function messages()
    {
        return [
        'required'  => trans('validation.required'),
        'unique'    => trans('validation.unique'),
        'numeric'   => trans('validation.numeric'),
        'email'     => trans('validation.email'),
        ];
    }
/**
 * 字段名称
 * @author 晚黎
 * @date   2016-11-03T14:52:38+0800
 * @return [type]                   [description]
 */
public function attributes()
{
    return [
        'id'        => trans('admin/user.model.id'),
        'name'      => trans('admin/user.model.name'),
        'username'  => trans('admin/user.model.username'),
        'email'     => trans('admin/user.model.email'),
    ];
}
}
