@extends('admin.templates.master')

@section('title')
Thay đổi ảnh slide
@stop

@section('css')
update_logo.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/croppie.min.css">
<script type="text/javascript" src="{{$AdminResUrl}}js/croppie.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('slide')
active
@stop

@section('content')
<div class="content">
            <a href="{{route('admin.slide.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Thay đổi ảnh slide hiện tại</h1>

		
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
            <div style="text-align:center;">
                <img style="height: 100px;border: 5px solid #bdbdbd;" src="{{$SlideUrl}}{{$objItem_Slide->picture}}" />
            </div>
                        
			<div style="margin-top: 20px;">	
                <div id='upload-demo'></div>

				<div style="display: initial;" class="item_data">
					<p>Tải ảnh lên:</p>
					<input style="width: 50%;"  type="file" id="image" name="hinhanh" class="txt_field" accept="image/*">
				</div>
	
				<div style="display: inline-block;width: 40%;" class="item_data">
					<p style="display:inline">Hoặc chọn ảnh đã tải sẵn</p>
					<a href="{{route('admin.slide.selectPictureAvailable', ['id'=>$objItem_Slide->id])}}">Tại đây</a>
				</div>
				
				<button  name="submit" class="button btn_submit btn-upload-image">Chọn</button>
                <a style="background: red; margin-left:20px;" class="button" href="{{route('admin.slide.index')}}">Hủy</a>
			</div>	
		</div>
		<div class="clr"></div>
@php
$objWidthSlide = App\ValueOption::getItemByName('width_slide');
$objHeightSlide = App\ValueOption::getItemByName('height_slide');
$widthSlide = ($objWidthSlide != null)?$objWidthSlide->value_int:600;
$heightSlide = ($objHeightSlide != null)?$objHeightSlide->value_int:250;
@endphp
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    var resize = $('#upload-demo').croppie({
        enableExif: true,
        enableOrientation: true,    
        viewport: { // Default { width: 100, height: 100, type: 'square' } 
            width: {{$widthSlide}},
            height: {{$heightSlide}},
            type: 'square' //square circle
        },
        boundary: {
            width: 650,
            height: 400
        }
    });


    $('#image').on('change', function () { 
    var reader = new FileReader();
        reader.onload = function (e) {
        resize.croppie('bind',{
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
        }
        reader.readAsDataURL(this.files[0]);
    });

    $('.btn-upload-image').on('click', function (ev) {
    resize.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (img) {
        $.ajax({
        url: "{{route('admin.slide.editPicture', ['id'=>$objItem_Slide->id] )}}",
        type: "POST",
        data: {"image":img},
        success: function (data) {
            if(data == 'true') window.location.href="{{route('admin.slide.index', ['msg'=>'Sửa thành công'])}}";
            else window.location.href="{{route('admin.slide.editPicture',['id'=>$objItem_Slide->id] )}}";
        }
        });
    });
    });
    </script>
@stop