@extends('admin.templates.master')

@section('title')
Thay đổi kích cỡ cắt ảnh
@stop

@section('updateCropSize')
active
@stop

@section('content')
<div class="content">
			<h1>Thay đổi kích cỡ cắt ảnh</h1>

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
                <a style="margin:0px 20px;" class="button" href="{{route('admin.valueOption.updateCropSizeSlide')}}">Ảnh Slide</a>
                <a style="margin:0px 20px;" class="button" href="{{route('admin.valueOption.updateCropSizeLogo')}}">Ảnh logo</a>
                <a style="margin:0px 20px;" class="button" href="{{route('admin.valueOption.updateCropSizeProduct')}}">Ảnh sản pẩm</a>
            </div>
           
		</div>
		<div class="clr"></div>
@stop