{{--查看模态框--}}
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        &times;
    </button>
    <h3 class="modal-title " id="myModalLabel">车辆详细信息
    </h3>
</div>
<div class="modal-body ">
    <div class="row">
        <div class="col-md-4 col-sm-12 col-xs-12 " >
            车牌号:{{$buses->buses_name}}
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12 " >
            车型:{{$buses->buses_type}}
        </div>
        <div class="col-md-4 col-sm-12 col-xs-12 " >
            核载:{{$buses->buses_sit}}人
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 " >
            车主:{{$buses->buses_boss}}
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 " >
            车主电话:{{$buses->buses_phone}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 " >
            发车时间:{{$buses->buses_start_date}}
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 " >
            返回时间:{{$buses->buses_end_date}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 " >
            车辆审验时间:{{$buses->buses_approve_date}}
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12 " >
            保险期限:{{$buses->buses_insurance_date}}
        </div>
    </div>
    <hr class="layui-bg-red">
    <h2 style="text-align: center">驾驶员信息</h2>
    <hr class="layui-bg-red">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 " >名字:{{$buses->driver->driver_name}}
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 " >年龄:{{$buses->driver->driver_age}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 " >性别:{{$buses->driver->driver_sex}}
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12 " >联系电话:{{$buses->driver->driver_phone}}
                </div>
            </div>
            <hr class="layui-bg-blue">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >驾驶证号:{{$buses->driver->driver_card}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >驾驶证档案号:{{$buses->driver->driver_archive_number}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >准驾车型:{{$buses->driver->driver_permit}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >初领日期:{{$buses->driver->driver_card_firstdata}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 " >驾驶证审验有效时间:{{$buses->driver->driver_card_date}}
                </div>
            </div>
        </div>
        <div  class="col-md-4 col-sm-12 col-xs-12">
            <div class="xiangkuang"
                 @if(empty($buses->driver->driver_photo))
                 style ="background:  url({{url('/backend/images/default/default_zhaopian.jpg')}});background-size:100% 100%;"
                 @else
                 style ="background: url({{url($buses->driver->driver_photo)}});background-size:100% 100%;"
                    @endif >
            </div>
        </div>
    </div>
    <hr class="layui-bg-orange">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 " >从业资格证号:{{$buses->driver->driver_qualification}}
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 " >资格证审验有效时间:{{$buses->driver->driver_qualification_date}}
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
