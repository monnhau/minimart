@extends('admin.templates.master')

@section('title')
Chọn ảnh đã uplaod
@stop

@section('css')
style_anh.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
@stop

@section('content')
<div class="content">
    <a href="{{route('admin.valueOption.updateLogo')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
    <h1>Thay đổi ảnh logo</h1>

    <p>Chọn ảnh từ kho:</p>
    <div class="container_vitri">
        @foreach($files as $fileName)
        @php
            $fileName = basename($fileName);
            $presentLogo = $objItem_Logo->value_char;
        @endphp
        @if($fileName != $presentLogo)
        <a onclick="return Confirm('Xác nhận', 'Bạn chắc chắn không?', 'OK', 'Hủy', '{{route('admin.valueOption.updateLogoAvailable', ['slug'=>$fileName])}}' ) ;" ><img src="{{$LogoUrl}}{{$fileName}}" /></a>
        @endif
        @endforeach

    </div>



</div>


<div class="clr"></div>
@stop