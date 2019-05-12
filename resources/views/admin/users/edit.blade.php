@extends('admin.templates.master')

@section('title')
Sửa người dùng
@stop

@section('css')
style_add.css
@stop

@section('users')
active
@stop

@section('content')
<div class="content">
            <a href="{{route('admin.users.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Sửa người dùng: "{{$objItem_User->username}}"</h1>

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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

			<form action="{{route('admin.users.edit', ['id'=>$objItem_User->id])}}" method="post">
                {{csrf_field()}}
                <div class="item_data">
					<p>Họ và tên (Tên hiển thị):</p>
					<input type="text" name="fullname" class="txt_field" value="{{ old('fullname', old('fullname') ? old('fullname') : $objItem_User->fullname) }}">
				</div>

				<div class="item_data">
					<p>Số điện thoại hoặc email:</p>
					<input type="text" name="username" class="txt_field" value="{{ old('username', old('username') ? old('username') : $objItem_User->username) }}">
				</div>

                <div class="item_data">
					<p>Mật khẩu cũ (* bắt buộc):</p>
					<input type="password" name="oldpassword" class="txt_field">
				</div>
			
				<div class="item_data">
					<p>Mật khẩu mới (* bắt buộc):</p>
					<input type="password" name="password" class="txt_field">
				</div>
                <div class="item_data">
					<p>Nhập lại Mật khẩu mới(* bắt buộc):</p>
					<input type="password" name="repassword" class="txt_field">
				</div>

                <div class="item_data">
					<p>Chức vụ (* bắt buộc):</p>
					<select class="txt_field" name="id_role">
                    @foreach($objItems_Role as $objItem)
                    @php
                    $name = $objItem->name;
                    $id = $objItem->id;
                    @endphp
                        @if(old('id_role', old('id_role') ? old('id_role') : $objItem_User->id_role) == $id)
						    <option value="{{$id}}" selected>{{$name}}</option>
                        @else
                            <option value="{{$id}}">{{$name}}</option>
                        @endif
                    @endforeach
					</select>
				</div>

                <input type="hidden" name="usernameOld" value="{{ $objItem_User->username }}">
		
				<input type="submit" name="submit" value="Sửa" class="button btn_submit">
                <input type="reset" name="reset" value="Reset" class="button btn_reset">
				<a class="button btn_cancel" href="{{route('admin.users.index')}}">Hủy</a>

			</form>	
		</div>
		<div class="clr"></div>
@stop