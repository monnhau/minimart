@extends('admin.templates.master')

@section('title')
Thêm sản phẩm
@stop

@section('css')
style_add.css
@stop

@section('css2')
<script type="text/javascript" src="{{$AdminResUrl}}lib/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="{{$AdminResUrl}}lib/ckfinder/ckfinder.js"></script>
@stop

@section('product')
active
@stop

@section('content')
<div class="content">
			<a href="{{route('admin.product.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Sửa sản phẩm</h1>

	
			@if(Session::has('msg'))
				@php
				$msg = Session::get('msg');
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

			<form action="{{route('admin.product.edit', ['id'=>$objItem_Product->id] )}}" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
				<div class="item_data">
					<p>Tên sản phẩm (bắt buộc):</p>
					<input type="text" name="name" class="txt_field" value="{{ old('name', old('name') ? old('name') : $objItem_Product->name) }}">
				</div>

                <div class="item_data">
					<p>Thuộc danh mục (bắt buộc):</p>
					<select class="txt_field" name="id_cat">
					@foreach($objItems_Cat as $objItem)
						@php
						$name = $objItem->name;
						$id = $objItem->id;
						@endphp

						@if(old('id_cat', old('id_cat') ? old('id_cat') : $objItem_Product->id_cat) == $id)
						<option value="{{$id}}" selected> {{$name}} </option>
						@else
						<option value="{{$id}}"> {{$name}} </option>
						@endif
					@endforeach
					</select>
				</div>

				<div class="item_data">
					<p>Đơn vị lẻ nhỏ nhất ĐVLNN (bắt buộc):</p>
					<input type="text" name="unit_le_char" class="txt_field" value="{{ old('unit_le_char', old('unit_le_char') ? old('unit_le_char') : $objItem_Product->unit_le_char) }}">
				</div>

				<div class="item_data">
					<p>Giá lẻ / ĐVLNN (bắt buộc):</p>
					<input type="number" name="price_le" class="txt_field" value="{{ old('price_le', old('price_le') ? old('price_le') : $objItem_Product->price_le) }}">
				</div>

				<br><br><hr style="border-color: #03A9F4;">

				<div class="item_data">
					<p>Đơn vị sĩ nhỏ nhất ĐVSNN:</p>
					<input type="number" name="unit_si_int" class="txt_field" value="{{ old('unit_si_int', old('unit_si_int') ? old('unit_si_int') : $objItem_Product->unit_si_int) }}">
				</div>

				

				<div class="item_data">
					<p>Giá sĩ / ĐVSNN:</p>
					<input type="number" name="price_si" class="txt_field" value="{{ old('price_si', old('price_si') ? old('price_si') : $objItem_Product->price_si) }}">
				</div>


				<div class="item_data">
					<p>Mô tả ngắn về sản phẩm:</p>
					<textarea name="desc_text" rows="3" class="txt_field area_field">{{ old('desc_text', old('desc_text') ? old('desc_text') : $objItem_Product->desc_text) }}</textarea> 
				</div>

				<div class="item_data">
					<p>Thông tin khuyến mãi về sản phẩm(nếu có):</p>
					<textarea name="km_text" rows="3" class="txt_field area_field">{{ old('km_text', old('km_text') ? old('km_text') : $objItem_Product->km_text) }}</textarea> 
				</div>


				<div class="item_data">
					<p>Thông tin chi tiết sản phẩm:</p>
					<textarea name="detail_text" id="detail_text" rows="3" class="ckeditor txt_field area_field">{{ old('detail_text', old('detail_text') ? old('detail_text') : $objItem_Product->detail_text) }}</textarea> 
				</div>
				<script type="text/javascript">
					CKEDITOR.replace( 'detail_text',
					{
						filebrowserBrowseUrl: '{{$AdminResUrl}}lib/ckfinder/ckfinder.html',
						filebrowserImageBrowseUrl: '{{$AdminResUrl}}lib/ckfinder/ckfinder.html?type=Images',
						filebrowserUploadUrl: '{{$AdminResUrl}}lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
						filebrowserImageUploadUrl: '{{$AdminResUrl}}lib/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
					});
				</script>

				<input type="hidden" name="nameOld" value="{{ $objItem_Product->name }}">

				<input type="submit" name="submit" value="Sửa" class="button btn_submit">
				<input type="reset" name="reset" value="Reset" class="button btn_reset">
				<a class="button btn_cancel" href="{{route('admin.product.index')}}">Hủy</a>

			</form>	
		</div>
		<div class="clr"></div>
@stop