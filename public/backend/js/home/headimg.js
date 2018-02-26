/**
 * Created by Administrator on 2018/2/26.
 */
var headimg = function () {
    var headimgInit = function () {
        var $image = $('#image');
        $image.cropper({
            aspectRatio: 16 / 9,
            crop: function(data) {
                //打印日志
                console.log(data.x);
                console.log(data.y);
                console.log(data.width);
                console.log(data.height);
                console.log(data.rotate);
                console.log(data.scaleX);
                console.log(data.scaleY);
            }

        });




    };
    return {
        init : headimgInit
    }
}();