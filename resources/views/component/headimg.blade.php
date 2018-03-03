
{{--剪切头像模态框--}}
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
<div class="modal inmodal" id="headimgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"  style="width: 800px;">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">头像剪切</h4>
            </div>
            <div class="modal-body">
            {{--剪切图片核心--}}
                <div class="row">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <img id="image" src="{{Auth::user()->getUserData->headimg}}"  >
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <p>预览效果:</p>
                        <div class="docs-preview clearfix">
                            <div class="img-preview  preview-xs layui-circle"></div>
                        </div> <br>
                       <div >
                            <p>裁剪结果:</p>
                            <img class="layui-circle" src="{{asset('/backend/images/img.jpg')}}" id="result">
                        </div>
                        <br>
                        <div class="row">
                            <P>x:<small id="imgdatax"></small></P>
                            <P>y:<small id="imgdatay"></small></P>
                           <P>宽度:<small id="imgdatawidth"></small>px</P>
                           <P>高度:<small id="imgdataheight"></small>px</P>
                        </div>
                    </div>
                </div>
                <div class="btn btn-group">
                    <button class="btn btn-danger" id="rotate-Left" ><i class="fa fa-rotate-left"></i>&nbsp;</button>
                    <button class="btn btn-danger" id="rotate-Right" ><span class="fa fa-rotate-right"></span>&nbsp;</button>
                    <label class="btn btn-danger pull-left" for="photoInput">
                        <input type="file" class="sr-only" id="photoInput" accept="image/*">
                        <span>打开图片</span>
                    </label>
                    <button class="btn btn-danger"  id="btnimg">保存裁剪</button>
                    <form id="submitForm" action="{{route('headimg')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="user_data_img" id="user_data_img" value="{{Auth::user()->id}}"/>
                        <input type="hidden" name="past_img" id="past_img" value="{{Auth::user()->getUserData->headimg}}"/>
                        <input type="hidden" name="icon" id="icon"/>
                        <input  class="btn btn-danger" type="submit" id="submitbtn" value="上传图像">
                    </form>
                </div>
                {{--剪切图片核心end--}}
            </div>
            <div class="modal-footer">
                <p>角落</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script src="{{ asset('/backend/js/home/headimg.js')}}"></script>




