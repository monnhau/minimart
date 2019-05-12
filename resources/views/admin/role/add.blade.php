@extends('admin.templates.master')

@section('title')
Thêm chức vụ
@stop

@section('css')
style_add.css
@stop

@section('role')
active
@stop

@section('content')
<div class="content">
            <a href="{{route('admin.role.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Thêm chức vụ</h1>

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

			<form action="{{route('admin.role.add')}}" method="post">
                {{csrf_field()}}
				<div class="item_data">
					<p>Tên chức vụ (viết liền không dấu):</p>
					<input type="text" name="name" class="txt_field" value="{{ old('name') }}">
				</div>

				<input type="submit" name="submit" value="Thêm" class="button btn_submit">

			</form>	
		</div>
		<div class="clr"></div>
@stop