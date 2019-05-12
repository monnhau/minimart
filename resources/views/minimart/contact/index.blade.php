<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
     <h1>Liên hệ!</h1>

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

    <form action="{{route('minimart.contact.index')}}" method="post">
        {{csrf_field()}}
        Họ tên (*):<input type="text" name="fullname" value="{{ old('fullname') }}"><br><br>
        Số điện thoại hoặc email (*): <input type="text" name="username" value="{{old('username')}}"/><br><br>
        Nội dung muốn gửi (*): <textarea name="content" rows="3" class="txt_field area_field">{{old('content')}}</textarea> <br><br>

        <input type="submit" name="submit" value="Gửi" />
    </form>
</body>
</html>