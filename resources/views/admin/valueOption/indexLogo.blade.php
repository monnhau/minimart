@extends('admin.templates.master')

@section('title')
Quản lí logo
@stop

@section('selectLogo')
active
@stop

@section('content')
<div class="content">
			<h1>Quản lí logo</h1>

			@if(Session::has('msg'))
				@php
				$msg = Session::get('msg');
				$msgType = substr($msg, 0, 5);
				@endphp
				@if($msgType=='error'||$msgType=='Error')
				<p class="msg_err">{{Session::get('msg')}}</p>
				@else
			    <p class="msg">{{Session::get('msg')}}</p>
				@endif
            @endif
            <div style="text-align:center;">
                <a style="margin:0px 20px;" class="button" href="{{route('admin.valueOption.updateLogo')}}">Thay đổi logo hiện tại</a>
                <a style="margin:0px 20px;" class="button" href="{{route('admin.valueOption.showStorageLogo')}}">Quản lí kho logo</a>
            </div>
           
		</div>
		<div class="clr"></div>
@stop