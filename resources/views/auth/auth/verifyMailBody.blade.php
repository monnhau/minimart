Xin chào {{$fullname}}, để xác thực email {{$username}} của bạn, vui lòng nhấn vào liên kết:
{{route('auth.auth.activateEmail', ['id'=>$id,'username'=>$username])}} 