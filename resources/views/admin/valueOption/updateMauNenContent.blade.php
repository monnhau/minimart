@extends('admin.templates.master')

@section('title')
Thay đổi màu
@stop

@section('css')
update_color.css
@stop

@section('selectColorContent')
active
@stop

@section('content')

<div class="content">
			<h1>Thay đổi màu nền khung nội dung</h1>
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
			

			<form method="post" action="{{route('admin.valueOption.updateMauNenContent')}}">	
				{{csrf_field()}}		
				<div class="item_data">
					<p>Chọn màu:</p>
					@if($MauNenContentProvider == null)
					<input style="width: 20%;height: 40px;" type="color" name="mau_nen_demo" class="txt_field_half">
					@else
					<input style="width: 20%;height: 40px;" type="color" value="{{$MauNenContentProvider->value_char}}" name="mau_nen_demo" class="txt_field_half">
					@endif
				</div>
		
				<input type="submit" name="submit" value="Chọn" class="button btn_submit">

			</form>	
		</div>
		<div class="clr"></div>
@stop