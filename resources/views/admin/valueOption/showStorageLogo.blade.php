@extends('admin.templates.master')

@section('title')
Kho logo
@stop

@section('selectLogo')
active
@stop

@section('css')
storage_img.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
@stop

@section('content')
<div class="content">
            <a href="{{route('admin.valueOption.indexLogo')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
            <h1>Quản lí kho logo</h1>
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

            <p>Ảnh từ kho:</p>
            <div style="text-align:center;">
                @foreach($files as $fileName)
                @php
                    $fileName = basename($fileName);
                    $presentLogo = $objItem_Logo->value_char;
                @endphp
                @if($fileName != $presentLogo)
                <div class="khung1">
                    <div class="muc_phu1">
                        <img id="img_sp" src="{{$LogoUrl}}{{$fileName}}" />
                    </div>
                    <div class="muc_duoi1">
                        <img src="{{$AdminResUrl}}images/del_icon.png"><a href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa?', 'Bạn có chắc chắn?', 'OK', 'Hủy', '{{route('admin.valueOption.delLogo', ['slug'=>$fileName])}}' )" class="xoa" >Xóa</a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
</div>
<div class="clr"></div>
@stop