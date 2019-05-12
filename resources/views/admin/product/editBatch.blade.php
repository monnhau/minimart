@extends('admin.templates.master')

@section('title')
Sửa lô
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
            @php
            $nsxString = $objItem_Batch->nsx;
            $hsdString = $objItem_Batch->hsd;
            $arrNsx = explode('-', $nsxString);
            $arrHsd = explode('-', $hsdString);
            @endphp
            <a href="{{route('admin.product.indexBatch', ['id'=>$objItem_Product->id])}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Sửa lô {{$objItem_Batch->id}} cho sản phẩm: {{$objItem_Product->name}}</h1>

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


			<form action="{{route('admin.product.editBatch', ['id'=>$objItem_Product->id, 'sid'=>$objItem_Batch->id])}}" method="post">
                {{csrf_field()}}
				<div class="item_data">
					<p>Ngày sản xuất:</p>
					<select class="time_select" name="nsx_d">
                        @for($i=1; $i<=31; $i++)
                            @if($i == $arrNsx[2])
                            <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                            <option value="{{$i}}" >{{$i}}</option>
                            @endif      
                        @endfor
                    </select class="time_select">

                    <select class="time_select" name="nsx_m">
                        @for($i=1; $i<=12; $i++)
                            @if($i == $arrNsx[1])
                            <option value="{{$i}}" selected>Tháng {{$i}}</option>
                            @else
                            <option value="{{$i}}">Tháng {{$i}}</option>
                            @endif     
                        @endfor
                    </select>

                    <select class="time_select" name="nsx_y">
                        @for($i=1990; $i<=2050; $i++)
                            @if($i == $arrNsx[0])
                            <option value="{{$i}}" selected>Năm {{$i}}</option>
                            @else
                            <option value="{{$i}}">Năm {{$i}}</option>
                            @endif  
                        @endfor
                    </select>
				</div>
			
				<div class="item_data">
					<p>Hạn sử dụng:</p>
					<select class="time_select" name="hsd_d">
                        @for($i=1; $i<=31; $i++)
                            @if($i == $arrHsd[2])
                            <option value="{{$i}}" selected>{{$i}}</option>
                            @else
                            <option value="{{$i}}" >{{$i}}</option>
                            @endif 
                        @endfor
                    </select class="time_select">

                    <select class="time_select" name="hsd_m">
                        @for($i=1; $i<=12; $i++)
                            @if($i == $arrHsd[1])
                            <option value="{{$i}}" selected>Tháng {{$i}}</option>
                            @else
                            <option value="{{$i}}">Tháng {{$i}}</option>
                            @endif  
                        @endfor
                    </select>

                    <select class="time_select" name="hsd_y">
                        @for($i=1990; $i<=2050; $i++)
                            @if($i == $arrHsd[0])
                            <option value="{{$i}}" selected>Năm {{$i}}</option>
                            @else
                            <option value="{{$i}}">Năm {{$i}}</option>
                            @endif
                        @endfor
                    </select>
				</div>

		
                <div class="item_data">
					<p>Số lượng:</p>
					<input type="number" min="0" name="qty" class="txt_field" value="{{ old('qty', old('qty') ? old('qty') : $objItem_Batch->qty) }}">
				</div>
			
				<input type="submit" name="submit" value="Sửa" class="button btn_submit">

			</form>	
		</div>
		<div class="clr"></div>
@stop