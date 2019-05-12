@extends('admin.templates.master')

@section('title')
Chọn ảnh đã uplaod
@stop

@section('product')
active
@stop

@section('css')
style_anh.css
@stop

@section('content')
<div class="content">
<a href="{{route('admin.product.editPicture', ['id'=>$objItem_Product->id])}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
<h1>Thay đổi ảnh sản phẩm "{{$objItem_Product->name}}"</h1>

<p>Chọn ảnh từ kho:</p>
<div class="container_vitri">
    @foreach($files as $fileName)
    @php
        $fileName = basename($fileName);
    @endphp
    <a onclick="return confirm('Bạn chắc chắn không?')" href="{{route('admin.product.editPictureAvailable', ['id'=>$objItem_Product->id, 'slug'=>$fileName])}}"><img src="{{$ProductUrl}}{{$fileName}}" /></a>
    @endforeach

</div>



</div>


<div class="clr"></div>
@stop