/**
 * Created by Administrator on 2018/1/30.
 */
var PermissionList = function() {
    var permissionInit = function(){
        $('#datatable-responsive').DataTable({
            "ajax":{
                //ajax请求
                'url' : '/admin/permission/ajaxIndex',
                //传递额外的参数
                "data" : function ( d ) {
                    d.name = '';
                }
            },
            //注意：这里列的数量必须和页面th标签数据量一致，否则会报错
           //orderable: 排序 默认为true 第一列不用设置默认是带有排序
            //render可以给这列的每个数据都添加一样的数据
            "columns":[
                {
                    "data" : "zhang",
                    "name" : "zhang",
                    render : function (data) {
                        return '前缀+'+data+'+后缀+render';
                    }
                },
                {
                    "data" : "li",
                    "name" : "l1",
                    "orderable" : false,
                },
                {
                    "data" : "wang",
                    "name" : "wang",
                    "orderable" : false,
                },
                {
                    "data" : "zhao",
                    "name" : "zhao",
                    "orderable" : true,
                },
                {
                    "data" : "age",
                    "name" : "age",
                    "orderable" : true,
                },

            ]
        });
    };
    return {
        init : permissionInit
    }
}();