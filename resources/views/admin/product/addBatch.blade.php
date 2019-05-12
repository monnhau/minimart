@extends('admin.templates.master')

@section('title')
Thêm lô
@stop

@section('css')
style_add.css
@stop

@section('css2')
<!-- <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script class="jsbin" type="text/javascript"  src="{{$AdminResUrl}}js/jquery-ui.min.js"></script>
@stop

@section('product')
active
@stop

@section('content')
<div class="content">
            <a href="{{route('admin.product.indexBatch', ['id'=>$objItem_Product->id])}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Thêm lô cho sản phẩm: {{$objItem_Product->name}}</h1>

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


			<form action="{{route('admin.product.addBatch', ['id'=>$objItem_Product->id])}}" method="post">
                {{csrf_field()}}
				<div class="item_data">
					<p>Ngày sản xuất:</p>
					<select class="time_select" name="nsx_d">
                        @for($i=1; $i<=31; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select class="time_select">

                    <select class="time_select" name="nsx_m">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{$i}}">Tháng {{$i}}</option>
                        @endfor
                    </select>

                    <select class="time_select" name="nsx_y">
                        @for($i=1990; $i<=2050; $i++)
                            <option value="{{$i}}">Năm {{$i}}</option>
                        @endfor
                    </select>
				</div>
			
				<div class="item_data">
					<p>Hạn sử dụng:</p>
					<select class="time_select" name="hsd_d">
                        @for($i=1; $i<=31; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select class="time_select">

                    <select class="time_select" name="hsd_m">
                        @for($i=1; $i<=12; $i++)
                            <option value="{{$i}}">Tháng {{$i}}</option>
                        @endfor
                    </select>

                    <select class="time_select" name="hsd_y">
                        @for($i=1990; $i<=2050; $i++)
                            <option value="{{$i}}">Năm {{$i}}</option>
                        @endfor
                    </select>
				</div>

		
                <div class="item_data">
					<p>Số lượng:</p>
					<input type="number" min="0" name="qty" class="txt_field" value="{{old('qty')}}">
				</div>
			
				<input type="submit" name="submit" value="Thêm" class="button btn_submit">

			</form>	
		</div>
		<div class="clr"></div>
@stop