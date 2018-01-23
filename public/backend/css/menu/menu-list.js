/**
 * Created by Administrator on 2018/1/23.
 */
var MenuList = function() {
    var menuInit = function(){
       // Select2
            var _select2 = $(".select2_single").select2({
                placeholder: "Select a state",
                allowClear: true
            });
           // nestable
            $('#nestable_list_3').nestable({
                "maxDepth":2
            });
           $(document).on('click','.createMenu',function () {
               var _item = $(this);
               _select2.val(_item.attr('data-pid')).trigger("change");
            });
    };
     return {
         init : menuInit
     }
}();
