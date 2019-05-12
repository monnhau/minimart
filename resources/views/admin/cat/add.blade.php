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
			<a href="{{route('admin.cat.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
			<h1>Thêm danh mục</h1>
			@if(Session::has('msg'))
			<p class="msg">{{Session::get('msg')}}</p>
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


			<form method="post" action="{{route('admin.cat.add')}}">
				{{csrf_field()}}
				<div class="item_data">
					<p>Tên danh mục:</p>
					<input type="text" name="name" class="txt_field">
				</div>
				
				<input type="submit" name="submit" value="Thêm" class="button btn_submit">
				<input type="reset" name="reset" value="Reset" class="button btn_reset">
				<a class="button btn_cancel" href="{{route('admin.cat.index')}}">Hủy</a>

			</form>	
		</div>
		<div class="clr"></div>
@stop