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
            ],
            //中文设置
            language: {
                "sProcessing": "处理中...",
                "sLengthMenu": "显示 _MENU_ 项结果",
                "sZeroRecords": "没有匹配结果",
                "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                "sInfoPostFix": "",
                "sSearch": "搜索:",
                "sUrl": "",
                "sEmptyTable": "表中数据为空",
                "sLoadingRecords": "载入中...",
                "sInfoThousands": ",",
                "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "上页",
                    "sNext": "下页",
                    "sLast": "末页"
                },
                "oAria": {
                    "sSortAscending": ": 以升序排列此列",
                    "sSortDescending": ": 以降序排列此列"
                },
                buttons: {
                    copyTitle: '复制成功',
                    copySuccess: {
                        _: "成功复制 %d 条 信息"
                    },
                }
            },
            //按钮顺序
            dom: 'B<"clearfix"><"ln_solid"><lfrtip>',
            "buttons": [
                {
                    'extend': 'copy',
                    'text': '复制',
                    'exportOptions': {
                        'modifier': {
                            'page': 'current'
                        }
                    }
                },
                {
                    'extend': 'excel',
                    'text': '保存excel',//定义导出excel按钮的文字
                    'exportOptions': {
                        'modifier': {
                            'page': 'current'
                        }
                    }
                },
                {
                    'extend': 'csv',
                    'text': '保存csv',
                    'exportOptions': {
                        'modifier': {
                            'search': 'none'
                        }
                    }
                },
                {
                    extend: 'print',
                    text: '打印',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                }

            ],
        });
    };
    return {
        init : permissionInit
    }
}();