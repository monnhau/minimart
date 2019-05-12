<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background: #00BCD4;">
    <h1 style="color:white">Trang chu Public</h1>

    @if(Auth::check())
    <div id="command_auth" style="float:right">
        <a class="hello">Xin chào</a>
        <a class="hello">{{Auth::user()->fullname}}</a>
        <a href="{{route('auth.auth.logout')}}" class="hello">Đăng xuất</a>
        @php
            $objItem_Role = App\Role::getItemByUserId(Auth::user()->id);
        @endphp

        @if($objItem_Role != null)
            @if($objItem_Role->phanSuAdmin == 1)
            <a href="{{route('admin.index.index')}}" class="hello">Vào quản trị</a>
            @endif
        @endif

    </div>
    @else
    <div id="command_auth" style="float:right">
        <a href="{{route('auth.auth.login')}}" class="hello">Đăng nhập</a>
        <a href="{{route('auth.auth.register')}}" class="hello">Đăng kí</a>
    </div>
    @endif

    <div>
     <h2 style="color:white">Welcome to my website! Good time for you!</h2>
    </div>

    <hr />

    <div>
     <a href="{{route('minimart.contact.index')}}">Liên hệ!</a>
    </div>

</body>
</html>