
{{--错误提示用layer所以必须放到layerjs下面--}}
    @if (count($errors) > 0)
    <script>
        layer.msg('@foreach ($errors->all() as $error){{ $error }}<br> @endforeach', {icon: 5});
    </script>
    @endif

