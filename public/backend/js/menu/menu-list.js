/*添加菜单*/
var MenuList = function() {
    var menuInit = function(){
       //   得到添加菜单的父级菜单的选项
            var select2 = $(".select2_single").select2({
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
                select2.val($(this).attr('data-pid')).trigger("change");
            });
        // 修改菜单按钮事件
        $('.editMenu').on('click',function () {
            var _url = $(this).attr('data-href');
            $.ajax({
                url:_url,
                dataType:'json',
                beforeSend:function() {
                    // ajax发送请求前 loading
                    layer.load(2);
                },
                success:function(menu) {
                    // 成功关闭loading
                    layer.closeAll('loading');
                    if (menu.status) {
                        menuFun.initAttribute(menu,select2);
                    }
                    layer.msg(menu.msg);
                },
                error: function(xhr, status, error) {
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });
        var menuFun = function() {
            var menuAttribute = function(menu,select2) {
                $('input[name=name]').val(menu.name);
                select2.val(menu.parent_id).trigger("change");
                $('input[name=icon]').val(menu.icon);
                $('input[name=url]').val(menu.url);
                $('input[name=heightlight_url] ').val(menu.heightlight_url);
                $('input[name=sort]').val(menu.sort);
                $('#menuForm').attr('action',menu.update);
                $('#menuForm').append('<input type="hidden" name="_method" value="PATCH">');
                $('#menuForm').append('<input type="hidden" name="id" value="'+menu.id+'">');
            };
            return {
                initAttribute : menuAttribute
            }
        }();
    };
    return {
        init : menuInit
    }
}();
