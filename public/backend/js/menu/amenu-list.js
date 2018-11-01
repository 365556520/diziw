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
                // 清除修改按钮的数据
                $('#method').remove();
                $('input[name=id]').remove();
                // 修改表单action
                $('#menuForm').attr('action','/admin/menu');
                // 清空表单
                $('#menuForm input.form-control').val('');
                var _item = $(this);
                // 改变select2默认值 修改添加菜单父级别值为当前菜单
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
        /**
         * 删除菜单
         * @author 晚黎
         * @date   2016-08-22T06:51:25+0800
         * @param  {[type]}                 ) {	              		    } [description]
         * @return {[type]}                   [description]
         */
        $(document).on('click','.destoryMenu',function () {
            var _delete = $(this).attr('data-id');
            //询问框
            layer.confirm('确定要删除菜单？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $('form[name=delete_item'+_delete+']').submit();
            });
        });
        var menuFun = function() {
            var menuAttribute = function(menu,select2) {
                $('input[name=name]').val(menu.name);
                select2.val(menu.parent_id).trigger("change");
                $('input[name=icon]').val(menu.icon);
                $('input[name=url]').val(menu.url);
                $('input[name=heightlight_url] ').val(menu.heightlight_url);
                $('input[name=slug] ').val(menu.slug);
                $('input[name=sort]').val(menu.sort);
                $('#menuForm').attr('action',menu.update);
                var _method = $('#method');
                if (_method.length < 1) {
                    $('#menuForm').append('<input type="hidden" id="method" name="_method" value="PATCH">');
                }
                // 判断表单是否存在相关数据
                var _id = $('input[name=id]');
                if (_id.length > 0) {
                    _id.val(menu.id);
                }else{
                    $('#menuForm').append('<input type="hidden" name="id" value="'+menu.id+'">');
                }
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
