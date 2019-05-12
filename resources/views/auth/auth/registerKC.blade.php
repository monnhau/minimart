<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RegisterKC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background: green;text-align:center"> 
    <h1>Đăng kí KC</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('msg'))
        @php
        $msg = Session::get('msg');
        $msg = trim($msg);
        $msgType = substr($msg, 0, 5);
        @endphp
        @if($msgType=='error' || $msgType=='Error')
        <p class="msg_err">{{Session::get('msg')}}</p>
        @else
            <p class="msg">{{Session::get('msg')}}</p>
        @endif
    @endif
    <form action="{{route('auth.auth.registerKC')}}" method="post">
        {{csrf_field()}}
        Số điện thoại hoặc email (*bắt buộc): <input type="text" name="username" value="{{old('username')}}"/><br><br>
        Tên đầy đủ của bạn:<input type="text" name="fullname" value="{{ old('fullname') }}"><br><br>
        Mật khẩu (*bắt buộc): <input type="password" name="password" /><br><br>
        Nhập lại mật khẩu: <input type="password" name="repassword" /><br><br>
		
        <input type="submit" name="submit" value="Đăng ký" />
        <input type="reset" name="reset" value="Reset" class="button btn_reset">
        <a class="button btn_cancel" href="{{route('minimart.index.index')}}">Hủy</a>
    </form>




</body>
</html>