@extends('admin.templates.master')

@section('title')
Chọn ảnh đã upload
@stop

@section('css')
style_anh.css
@stop

@section('content')
<div class="content">
<a href="{{route('admin.slide.editPicture, ['id'=>$objItem_Slide->id]')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
<h1>Thay đổi ảnh slide hiện tại</h1>
<div style="text-align:center;">
    <img style="height: 100px;border: 5px solid #bdbdbd;" src="{{$SlideUrl}}{{$objItem_Slide->picture}}" />
</div>
<p>Chọn ảnh từ kho:</p>
<div class="container_vitri">
    @foreach($files as $fileName)
    @php
        $fileName = basename($fileName);
    @endphp
    @if($fileName != $objItem_Slide->picture)
    <a onclick="return confirm('Bạn chắc chắn không?')" href="{{route('admin.slide.editPictureAvailable', ['id'=>$objItem_Slide->id, 'slug'=>$fileName] ) }}"><img src="{{$SlideUrl}}{{$fileName}}" /></a>
    @endif
    @endforeach

</div>



</div>


<div class="clr"></div>
@stop