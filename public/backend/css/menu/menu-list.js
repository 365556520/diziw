/*添加菜单*/
var MenuList = function() {
    var menuInit = function(){
       //   得到添加菜单的父级菜单的选项
            var _select2 = $(".select2_single").select2({
                placeholder: "Select a state",
                allowClear: true
            });
           // 控制菜单只有2层层级关系
            $('#nestable_list_3').nestable({
                "maxDepth":2
            });
            //添加按钮事件
           $('.createMenu').on('click',function () {
               //修改添加菜单父级别值为当前菜单
               _select2.val($(this).attr('data-pid')).trigger("change");
            });
    };
     return {
         init : menuInit
     }
}();
