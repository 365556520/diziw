{{--查看模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h3 class="modal-title " id="myModalLabel">驾驶员详细信息
    </h3>
</div>
<div class="modal-body ">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 " >名字:{{$driver->driver_name}}
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 " >年龄:{{$driver->driver_age}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 " >性别:{{$driver->driver_sex}}
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 " >联系电话:{{$driver->driver_phone}}
                </div>
            </div>
            <hr class="layui-bg-blue">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >驾驶证号:{{$driver->driver_card}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >驾驶证档案号:{{$driver->driver_archive_number}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >准驾车型:{{$driver->driver_permit}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >初领日期:{{$driver->driver_card_firstdata}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >驾驶证审验有效时间:{{$driver->driver_card_date}}
                </div>
            </div>
        </div>
        <div  class="col-md-4 col-sm-12 col-xs-12">
            <div class="xiangkuang"
                 @if(empty($driver->driver_photo))
                     style ="background:  url({{url('/backend/images/default/default_zhaopian.jpg')}});background-size:100% 100%;"
                 @else
                     style ="background: url({{url($driver->driver_photo)}});background-size:100% 100%;"
                 @endif >
            </div>
        </div>
    </div>
    <hr class="layui-bg-orange">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 " >从业资格证号:{{$driver->driver_qualification}}
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 " >资格证审验有效时间:{{$driver->driver_qualification_date}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 " >
            <hr class="layui-bg-green">
            <h3 style="text-align: center">驾驶信息</h3>
            {{$driver->driver_info}}
        </div>
    </div>
</div>
<style>
    .xiangkuang{
        min-width: 130px;
        min-height: 150px;
        max-width: 130px;
        max-height: 150px;
        border:1px solid #000000;
        padding: 1px;
    }

</style>
