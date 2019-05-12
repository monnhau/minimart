@extends('admin.templates.master')

@section('title')
Thay đổi ảnh logo
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

@section('selectLogo')
active
@stop

@section('content')
<div class="content">
        <a href="{{route('admin.valueOption.indexLogo')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
        <h1>Thay đổi ảnh logo hiện tại</h1>
        
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
                <img style="height: 100px;border: 5px solid #bdbdbd;" src="{{$StoUrl}}logo/{{$objItem_Logo->value_char}}" />
            </div>

			<div style="margin-top: 20px;">	
                <div id='upload-demo'></div>

				<div style="display: initial;" class="item_data">
					<p>Tải ảnh lên:</p>
					<input style="width: 50%;"  type="file" id="image" name="hinhanh" class="txt_field" accept="image/*" >
				</div>
	
				<div style="display: inline-block;width: 40%;" class="item_data">
					<p style="display:inline">Hoặc chọn ảnh đã tải sẵn</p>
					<a href="{{route('admin.valueOption.selectLogoAvailable')}}">Tại đây</a>
				</div>
				
				<button style="display: block;" name="submit" class="button btn_submit btn-upload-image">Chọn</button>

			</div>	
		</div>
		<div class="clr"></div>
@php
$objWidthLogo = App\ValueOption::getItemByName('width_logo');
$objHeightLogo = App\ValueOption::getItemByName('height_logo');
$widthLogo = ($objWidthLogo != null)?$objWidthLogo->value_int:270;
$heightLogo = ($objHeightLogo != null)?$objHeightLogo->value_int:120;
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
            width: {{$widthLogo}},
            height: {{$heightLogo}},
            type: 'square' //square circle
        },
        boundary: {
            width: 650,
            height:400
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
        url: "{{route('admin.valueOption.updateLogo')}}",
        type: "POST",
        data: {"image":img},
        success: function (data) {
            if(data == 'true') window.location.href="{{route('admin.index.indexDemoLogo')}}";
            else window.location.href="{{route('admin.valueOption.updateLogo')}}";
        }
        });
    });
    });
    </script>
@stop