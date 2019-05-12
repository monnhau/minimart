<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reset Mật khẩu - Minimart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background: #DF9FDF;text-align:center"> 
    <h1>Reset mật khẩu cho tài khoản: {{$username}}</h1>
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
        <p class="msg_err">{!!Session::get('msg')!!}</p>
        @else
            <p class="msg">{!!Session::get('msg')!!}</p>
        @endif
    @endif


    <form action="{{route('auth.auth.resetPassword', ['username'=>$username, 'code'=>$code])}}" method="post">
        {{csrf_field()}}
        Mật khẩu mới(*bắt buộc): <input type="password" name="password" /><br><br>
        Nhập lại mật khẩu: <input type="password" name="repassword" /><br><br>

        <input type="submit" name="submit" value="Xác nhận" />
        <input type="reset" name="reset" value="Reset" class="button btn_reset">
        <a class="button btn_cancel" href="{{route('minimart.index.index')}}">Hủy</a>
    </form>
</body>
</html>