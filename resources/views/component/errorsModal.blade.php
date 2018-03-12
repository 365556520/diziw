
    {{--@if (count($errors) > 0)--}}
        <!-- 模态框 -->
        <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            错误信息
                        </h4>
                    </div>

                    <!-- 模态框主体 -->
                    <div class="modal-body">

                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    <script>
        require(['bootstrap'],function ($) {
            $('#messageModal').modal('show');
        });
    </script>
    {{--@endif--}}


  