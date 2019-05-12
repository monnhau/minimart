@extends('admin.templates.master')

@section('title')
Đổi kích cỡ ảnh
@stop

@section('css')
style_export.css
@stop

@section('updateCropSize')
active
@stop

@section('content')

<div class="content">
    <a href="{{route('admin.valueOption.updateCropSize')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
    <h1>Đổi kích cỡ cắt ảnh sản phẩm</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

    <form action="{{route('admin.valueOption.updateCropSizeProduct')}}" method="post"> 
        {{csrf_field()}}
        <div class="mot_sp">
            <div class="div_ma">
                <p class="label_input">Chiều rộng:</p>
                <input type="number" name="width" class="txt_field_haft" value="{{old('width')}}" >
            </div>
        
            <div class="div_soluong">
                <p class="label_input">Chiều cao:</p>
                <input type="number" name="height" class="txt_field_haft" value="{{old('height')}}" >
            </div>

        </div>

        <input type="submit" name="submit" value="Cập nhật" class="button btn_submit">

    </form>


    
</div>


<div class="clr"></div>
@stop