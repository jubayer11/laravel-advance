<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<ul style="background-color: darkred">
    <li style="color: white">
        {{--        {{__('header.hello')}}--}}
        @lang('header.hello',['name'=>'jubayer'])
    </li>
    <li style="color: white">
        {{--        {{__('header.everyone')}}--}}
        @lang('header.everyone')
    </li>
    <li style="color: white">
        {{--        {{__('header.love')}}--}}
        @lang('header.love')

    </li>
    <li style="color: white">
        {{--        {{__('header.item')}}--}}
{{--        @lang('header.item')--}}
        {{trans_choice('header.item',1)}}

    </li>
</ul>


</body>
</html>
