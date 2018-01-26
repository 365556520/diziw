@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level == 'error')
# Whoops!
@else
# 测试!
@endif
@endif
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach
{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
            $color = 'green';
            break;
        case 'error':
            $color = 'red';
            break;
        default:
            $color = 'blue';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset
{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}
@endforeach
{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Regards,<br>{{ config('app.name') }}
@endif
{{-- Subcopy --}}
@isset($actionText)
@component('mail::subcopy')
如果想修改密码点 "{{ $actionText }}" 这个按钮, 或者拷贝下面这个 URL进行修改密码: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endisset
@endcomponent
