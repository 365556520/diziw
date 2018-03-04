@extends('layouts.admin')
@section('title')
    <title>{{ trans('admin/menu.title')}}</title>
@endsection
@section('css')
    {{--剪切头像--}}
    <style>

        #image {
            max-width: 100%;
        }
        .img-preview{
            width: 150px;
            height: 150px;
            overflow: hidden;
        }
        button {
            margin-top:10px;
        }
        #result {
            width: 80px;
            height: 80px;
        }
    </style>

@endsection
@section('content')
    <div class="">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>修改图像</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @include('flash::message')
                                <div class="row">
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                       <label class="btn btn-danger pull-left" for="photoInput">
                                           <input type="file" class="sr-only" id="photoInput" accept="image/*">
                                           <span>打开图片</span>
                                       </label>
                                   </div>
                                </div>

                                {{--剪切图片核心--}}
                                <div class="row">
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <img id="image" src="{{Auth::user()->getUserData->headimg}}"  >
                                        <div class="btn btn-group">
                                            <button class="btn btn-danger" id="rotate-Left" ><i class="fa fa-rotate-left"></i>&nbsp;</button>
                                            <button class="btn btn-danger" id="rotate-Right" ><span class="fa fa-rotate-right"></span>&nbsp;</button>
                                            <button class="btn btn-danger"  id="btnimg">裁剪预览</button>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <p>预览效果:</p>
                                        {{--预览效果--}}
                                        <div class="docs-preview clearfix">
                                            <div class="img-preview  preview-xs layui-circle"></div>
                                        </div> <br>
                                        {{--预览效果end--}}
                                        <div >
                                            <p>裁剪结果:</p>
                                            <img class="layui-circle" src="{{Auth::user()->getUserData->headimg}}" id="result">
                                        </div>
                                        <br>
                                        <div class="row">
                                            <P>x:<small id="imgdatax"></small></P>
                                            <P>y:<small id="imgdatay"></small></P>
                                            <P>宽度:<small id="imgdatawidth"></small>px</P>
                                            <P>高度:<small id="imgdataheight"></small>px</P>
                                            <form id="submitForm" action="{{route('headimg')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="user_data_img" id="user_data_img" value="{{Auth::user()->id}}"/>
                                                <input type="hidden" name="past_img" id="past_img" value="{{Auth::user()->getUserData->headimg}}"/>
                                                <input type="hidden" name="icon" id="icon"/>
                                                <input  class="btn btn-danger" type="submit" id="submitbtn" value="上传图像">
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                {{--剪切图片核心end--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/backend/js/home/headimg.js')}}"></script>
    <script>
        //            开始加载
        $(function () {
            headimg.init("{{route('headimg')}}","{{csrf_token()}}");
        });
    </script>
@endsection








