@extends('admin.templates.master')

@section('title')
Sửa ảnh slide
@stop

@section('css')
style_add.css
@stop

@section('slide')
active
@stop

@section('content')
<div class="content">
            <a href="{{route('admin.slide.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Sửa ảnh cho slide</h1>

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

			<form action="{{route('admin.slide.edit', ['id'=>$objItem_Slide->id])}}" method="post">
                {{csrf_field()}}
				<div class="item_data">
					<p>Lời mô tả ảnh:</p>
					<input type="text" name="desc_text" class="txt_field" value="{{ old('desc_text', old('desc_text') ? old('desc_text') : $objItem_Slide->desc_text) }}">
				</div>
			
				<div class="item_data">
					<p>Lời chi tiết ảnh:</p>
					<textarea name="detail_text" rows="3" class="txt_field area_field">{{ old('detail_text', old('detail_text') ? old('detail_text') : $objItem_Slide->detail_text) }}</textarea> 
				</div>
		
				<input type="submit" name="submit" value="Sửa" class="button btn_submit">

			</form>	
		</div>
		<div class="clr"></div>
@stop