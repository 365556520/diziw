



{{--剪切头像模态框--}}

<div class="modal inmodal" id="headimgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">头像剪切</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <img id="image" src="{{asset('/backend/images/xiaolongnv.jpg')}}"  >
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <img src="">
                    </div>
                </div>
                <div class="btn btn-group">
                    <button class="btn btn-danger" id="btnimg">裁剪</button>
                </div>
            </div>
            <div class="modal-footer">
                <p>角落</p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<script src="{{ asset('/backend/js/home/headimg.js')}}"></script>



