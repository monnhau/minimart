@extends('admin.templates.master')

@section('title')
Thêm danh mục
@stop

@section('css')
style_add.css
@stop

@section('cat')
active
@stop

@section('content')
<div class="content">
			<h1>Thêm danh mục</h1>

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

			<form>
				<div class="item_data">
					<p>Tên sản phẩm:</p>
					<input type="text" name="tensp" class="txt_field">
				</div>
			
				<div class="item_data">
					<p>Mã sản phẩm:</p>
					<input type="text" name="masp" class="txt_field">
				</div>
		
				<div class="item_data">
					<p>Thuộc danh mục cha:</p>
					<select class="txt_field" name="catparent">
						<option>Điện thoại</option>
						<option>Máy tính bảng</option>
						<option>Laptop</option>
					</select>
				</div>

				<div class="item_data">
					<p>Hình ảnh</p>
					<input type="file" name="hinhanh" class="txt_field">
				</div>

				<div class="item_data">
					<p>Mô tả:</p>
					<textarea name="mota" rows="3" class="txt_field area_field">Đây là nội dung mô tả</textarea> 
				</div>

				<input type="submit" name="submit" value="Thêm" class="button btn_submit">

			</form>	
		</div>
		<div class="clr"></div>
@stop