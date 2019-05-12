<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/reset_css.css">
	<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/style.css">
	<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/@yield('css')">
	@yield('css2')
</head>
@php
$flag1 = false; $flag2 = false;
if($MauNenProvider != null) $flag1 = true;
if($MauNenContentProvider != null) $flag2 = true;
if($flag1){
	$isWhiteText = App\FreeFunction::isWhiteTextByBgColor($MauNenProvider->value_char);
}
@endphp

@if($flag1 == true && $flag2 == true )
<style>
	body{
		background: {{$MauNenProvider->value_char}} !important;
	}

	.muc_phu li:hover > a{
		@if($isWhiteText == 1)
			color: #ffffff !important;
		@endif
	}
	.muc_phu .active a{
		@if($isWhiteText == 1)
			color: #ffffff !important;
		@endif
	}

	.content{
		background: {{$MauNenContentProvider->value_char}} !important;
	}

	.khung{
		background: {{$MauNenContentProvider->value_char}} !important;
	}

	.btn_null{
		background: {{$MauNenContentProvider->value_char}} !important;
	}
</style>

@endif

<body>

	<div class="container2">
		<div class="header">
			@if($LogoProvider == null)
				<img src="{{$LogoUrl}}{{$DefaultImg}}" >
			@else
				@php
				$filePath = storage_path('app/files/logo/'.$LogoProvider->value_char);
				@endphp

				@if(file_exists($filePath))
				<img src="{{$LogoUrl}}{{$LogoProvider->value_char}}" >
				@else
				<img src="{{$LogoUrl}}{{$DefaultImg}}" >
				@endif
			
			@endif

			@if(Auth::check())
			@php
				$id_role = Auth::user()->id_role;
				$name_role = App\Role::getItemStatic($id_role)->name;
			@endphp
			<span><a href="{{route('auth.auth.logout')}}">Đăng xuất</a> | <a href="{{route('minimart.index.index')}}">Về trang chủ</a></span>
			<span>Chức vụ: {{$name_role}}</span>
			<span>Xin chào : {{Auth::user()->fullname}} </span>	
			@endif
			
			<div class="nav_bar" style="display:none">
				<p class="nav_bar_name">TRANG QUẢN TRỊ</p>
			</div>
		</div>

		<div class="clr"></div>

		<style>
			@if($MauNenProvider != null)
			.muc_phu .active {
				background: {{$MauNenProvider->value_char}} !important;			
			}
			.muc_phu li:hover{
				background: {{$MauNenProvider->value_char}} !important;
			}
			@endif

			
		</style>