<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Demo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/reset_css.css">
	<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/style.css">
	<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/style_index.css">
</head>
@php
$mauNen = App\ValueOption::getItemByName("mau_nen");
$mauNenContentDemo = App\ValueOption::getItemByName("mau_nen_content_demo");
@endphp

<style>
	.content{
		@if($mauNenContentDemo != null)
		background: {{$mauNenContentDemo->value_char}} !important;
		@endif
	}

	.khung{
		@if($mauNenContentDemo != null)
		background: {{$mauNenContentDemo->value_char}} !important;
		@endif
	}
</style>

@if($mauNen == null)
<body >
@else
<body style="background: {{$mauNen->value_char}} !important">
@endif

    <div class="verify_color" style="height: 53px;background: #333;color: #fff;margin-bottom: 10px;text-align: center;line-height: 50px;">
		 <span>Bạn muốn hoàn thành việc chọn màu?</span>
		 <a style="background: green;padding: 5px 15px;margin-right: 5px;" href="{{route('admin.valueOption.updateMauNenContentReal')}}">OK</a>
		 <a style="background: red;padding: 5px 15px;margin-right: 5px;" href="{{route('admin.valueOption.updateMauNenContent')}}">Hủy</a>
    </div>
	<div class="container">
		<div class="header">
			<img src="{{$AdminResUrl}}images/logo_admin.png" >
			<span>Xin chào | Admin</span>	
			<div class="nav_bar">
				<p class="nav_bar_name">TRANG QUẢN TRỊ</p>
			</div>
		</div>

		<div class="clr"></div>

		<div class="leftbar">
			<div class="khung">
				<div class="muc_chinh">
					<span>→ Quản trị</span>
				</div>
				<div class="muc_phu">
					<ul>
						<li ><a>Quản lí sản phẩm </a></li>
						<li class="active"><a>Quản lí danh mục</a></li>
						<li><a>Quản lí liên hệ</a></li>
						<li><a>Quản lí slide</a></li>
						<li><a>Quản lí user</a></li>
					</ul>
				</div>
			</div>

			<div class="khung">
				<div class="muc_chinh">
					<span>→ Tùy chỉnh giao diện</span>
				</div>
				<div class="muc_phu">
					<ul>
						<li  class="active"><a>Đổi logo</a></li>
						<li><a>Đổi màu nền trang</a></li>
						<li><a>Đổi màu khung trái</a></li>
						<li><a>Đổi màu khung giữa</a></li>
						<li><a>Đổi màu khung nar-bar</a></li>
						<li><a>Đổi màu khung trên cùng bên phải</a></li>
						<li><a>Đổi màu khung dưới cùng</a></li>
						<li><a>Đổi màu header khung</a></li>
					</ul>
				</div>
			</div>
			
		</div>



		<div class="content" >

			<h1>Một số thông báo</h1>
			<div class="item_thongbao">
				<p class="ten_thongbao">Thông báo dừng Server để bảo trì</p>
				<p class="tac_gia">By quantri, 1 month ago</p>
				<div class="content_thongbao">
					<p>Gửi tất các Users!!<br>
						Ngày 8/12 - 9/12 sẽ tạm ngừng server để bảo trì hệ thống nên mong các bạn thông cảm. <br>Ngày 10/12 sẽ hoạt động lại bình thường. <br>
					Trân trọng</p>
					<a href="">Đọc thêm</a>
				</div>
				<div class="mota_thongbao">
					<p>By quantri, 1 month ago, 0 comment(s)</p>
				</div>
			</div>

			<div class="item_thongbao">
				<p class="ten_thongbao">Thông báo dừng Server để bảo trì 2</p>
				<p class="tac_gia">By quantri, 1 month ago</p>
				<div class="content_thongbao">
					<p>Gửi tất các Users!!<br>
						Ngày 8/12 - 9/12 sẽ tạm ngừng server để bảo trì hệ thống nên mong các bạn thông cảm. <br>Ngày 10/12 sẽ hoạt động lại bình thường.<br>
					Trân trọng</p>
					<a href="">Đọc thêm</a>
				</div>
				<div class="mota_thongbao">
					<p>By quantri, 1 month ago, 0 comment(s)</p>
				</div>
			</div>


		</div>


		<div class="clr"></div>

		<div class="footer">
			<p style="background: ghostwhite !important">MiniMark - Code by Bay Nguyen 2018<br>
				University of Science and Technology - University of Danang<br>
				Server time: 16/01/2019 00:17:15 (UTC+7)<br>
			</p>
		</div>


	</div>

</body>
</html>