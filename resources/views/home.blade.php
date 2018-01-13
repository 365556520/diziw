@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}

                        </div>
                    @endif
                        You are logged in!
                        @role('admin')
                        <p>我是管理员 Gets translated to
                            \Entrust::role('admin')</p>
                        @endrole

                        @permission('create users')
                        <p>我是普通用户</p>
                        @endpermission

                        @ability('admin,user','edit users,create users')
                        <p>判断角色能力
                            \Entrust::ability(('admin,user','edit users,create users')</p>
                        @endability

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
