
{{--剪切头像模态框--}}
<style>
    .row{
        margin-bottom: 5px;
    }
    #photo {
        max-width: 100%;
    }
    .img-preview {
        width: 100px;
        height: 100px;
        overflow: hidden;
    }
    button {
        margin-top:10px;
    }
    #result {
        width: 150px;
        height: 150px;
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

                <div class="row">
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <img id="image" src="{{asset('/backend/images/img.jpg')}}"  >
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">

                            <div class="img-preview-box hidden">
                                <hr>
                                <span>150*150:</span>
                                <div class="img-preview img-preview-lg">
                                </div>
                            </div>

                        <br><br><div>
                            <p>结果：</p>
                            <img src="{{asset('/backend/images/img.jpg')}}" id="result">  </div>
                        <br>
                        <div class="row">
                            <P>x:<small id="imgdatax"></small></P>
                            <P>y:<small id="imgdatay"></small></P>
                           <P>宽度:<small id="imgdatawidth"></small>px</P>
                           <P>高度:<small id="imgdataheight"></small>px</P>
                           <P>测试:<small id="ceshi1"></small>px</P>
                        </div>
                    </div>
                </div>
                <div class="btn btn-group">
                    <label class="btn btn-danger pull-left" for="photoInput">
                        <input type="file" class="sr-only" id="photoInput" accept="image/*">
                        <span>打开图片</span>
                    </label>
                    <button class="btn btn-danger"  id="btnimg">裁剪</button>
                </div>
            </div>
            <div class="modal-footer">
                <p>角落</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script src="{{ asset('/backend/js/home/headimg.js')}}"></script>




