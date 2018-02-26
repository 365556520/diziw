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



    };
    return {
        init : userdataInit
    }
}();