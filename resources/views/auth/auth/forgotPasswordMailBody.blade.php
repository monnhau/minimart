Xin chào {{$fullname}}, để thiết lập lại mật khẩu cho tài khoản {{$username}} của bạn, vui lòng nhấn vào liên kết:
{{route('auth.auth.resetPassword', ['username'=>$username, 'code'=>$code])}} 