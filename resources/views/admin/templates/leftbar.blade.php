@php
	$phanSuGiaoDien = 0;
	$phanSuUser = 0;
	$phanSuDanhMuc = 0;
	$phanSuProduct = 0;

	if(Auth::check()){
		$id_role = Auth::user()->id_role;
		$phanSuGiaoDien = App\Role::getItemStatic($id_role)->phanSuGiaoDien;
		$phanSuUser = App\Role::getItemStatic($id_role)->phanSuUser;
		$phanSuDanhMuc = App\Role::getItemStatic($id_role)->phanSuDanhMuc;
		$phanSuProduct = App\Role::getItemStatic($id_role)->phanSuProduct;
	}
@endphp
<div class="leftbar">
			<div class="khung">
				<div class="muc_chinh">
					<span>→ Quản trị đặc thù</span>
				</div>
				<div class="muc_phu">
					<ul>
						<li class="@yield('home')" ><a href="{{route('admin.index.index')}}">Trang chủ</a></li>	
						@if($phanSuProduct == 1)			
							<li class="@yield('product')"><a href="{{route('admin.product.index')}}">Quản lí sản phẩm</a></li>
						@endif
						<li><a>Quản lí nhập hàng</a></li>
						<li class="@yield('export')"><a href="{{route('admin.export.index')}}">Quản lí xuất hàng và hóa đơn</a></li>
						<li class="@yield('position')"><a href="{{route('admin.position.index')}}">Quản lí vị trí hàng</a></li>					
					</ul>
				</div>
			</div>

			<div class="khung">
				<div class="muc_chinh">
					<span>→ Quản trị chung</span>
				</div>
				<div class="muc_phu">
					<ul>
						@if($phanSuDanhMuc == 1)
							<li class="@yield('cat')"><a href="{{route('admin.cat.index')}}">Quản lí danh mục</a></li>
						@endif

							<li class="@yield('contact')"><a href="{{route('admin.contact.index')}}">Quản lí liên hệ</a></li>
							<li class="@yield('slide')"><a href="{{route('admin.slide.index')}}">Quản lí slide</a></li>

						@if($phanSuUser == 1)
							<li class="@yield('users')"><a href="{{route('admin.users.index')}}">Quản lí người dùng</a></li>
							<li class="@yield('role')"><a href="{{route('admin.role.index')}}">Quản lí chức vụ</a></li>
						@endif

							<li class="@yield('log')"><a href="{{route('admin.log.index')}}">Quản lí nhật kí</a></li>
					</ul>
				</div>
			</div>

			@if($phanSuGiaoDien == 1)
			<div class="khung">
				<div class="muc_chinh">
					<span>→ Tùy chỉnh giao diện</span>
				</div>
				<div class="muc_phu">
					<ul>
						<li class="@yield('selectLogo')"><a href="{{route('admin.valueOption.indexLogo')}}">Quản lí logo</a></li>
						<li class="@yield('selectColor')" ><a href="{{route('admin.valueOption.updateMauNen')}}">Đổi màu nền trang</a></li>
						<li class="@yield('selectColorContent')" ><a href="{{route('admin.valueOption.updateMauNenContent')}}">Đổi màu nền khung nội dung</a></li>
						<li><a>Đổi ảnh banner</a></li>
						<li class="@yield('updateCropSize')" ><a href="{{route('admin.valueOption.updateCropSize')}}">Đổi kích thước cắt ảnh</a></li>
					</ul>
				</div>
			</div>
			@endif
			
		</div>