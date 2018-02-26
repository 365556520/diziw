/**
 * Created by Administrator on 2018/2/26.
 */
var UserData = function () {
    var userdataInit = function () {
        //form提交
        layui.use('form', function(){
            var form = layui.form;
            //监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });
        });


        $("[data-toggle='tooltip']").tooltip();

        $('#image').cropper({
            aspectRatio: 16 / 9,
            crop: function(e) {
                // Output the result data for cropping image.
                console.log(e.x);
                console.log(e.y);
                console.log(e.width);
                console.log(e.height);
                console.log(e.rotate);
                console.log(e.scaleX);
                console.log(e.scaleY);
            }
        });

    };
    return {
        init : userdataInit
    }
}();