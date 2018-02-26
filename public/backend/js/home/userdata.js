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

        $("#imgBtn").change(function(e){
            var file = $("#imgBtn").get(0).files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function(e){
                alert('文件读取完成');
                $("#previewyulan").attr("src",e.target.result)
                var $img = $("#preview");
                $('#previewyulan').cropper({
                    aspectRatio: 16 / 9,
                    crop: function(data) {
                        //转换为base64
                        // var $imgData=$img.cropper('getCroppedCanvas')
                        //   var dataurl = $imgData.toDataURL('image/png');
                        //  $("#previewyulan").attr("src",dataurl)
                    }
                });
            }
        });

        function imgSubmit(){
            //获取裁剪后的canvas对象
            var result= $('#previewyulan').cropper("getCroppedCanvas");
            //将canvas对象转换为base64
            var dataurl =result.toDataURL('image/png');
            document.body.appendChild(result);
            //发起post请求
            var data = "img="+dataurl+"";
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function(event){
                if(xhr.readyState == 4){    //4:解析完毕
                    if(xhr.status == 200){    //200:正常返回
                        console.log(xhr)
                    }
                }
            };
            xhr.open('POST','imgCut',true);    //true为异步
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xhr.send(data);
        };
    };
    return {
        init : userdataInit
    }
}();