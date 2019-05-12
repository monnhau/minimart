@extends('admin.templates.master')

@section('title')
Vị trí hàng hóa
@stop

@section('css')
style_position_product.css
@stop

@section('position')
active
@stop

@section('content')
<div class="content">
<h1>Vị trí hàng hóa trong quầy</h1>
<div class="them_and_tk">
    <a class="button btn_them" href="#">Thêm vị trí</a>

    <form class="search_form">
        <input type="text" placeholder="Nhập loại hàng" name="key_search" class="txt_key">
        <input type="submit" name="submit" class="button" value="Tìm vị trí hàng">
    </form>

</div>

<hr />


<div class="msg">
    <p class="active">Thêm thành công!</p>
</div>

<div class="container_vitri">

    <div class="khung1">
        <div class="muc_chinh1">
            <span>→ Vị trí: Gian hàng A1</span>
        </div>
        <div class="muc_phu1">
            <ul>
                <li ><a>Bột giặt </a></li>
                <li class="active1"><a>Mì ăn liền</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>

            </ul>
        </div>
        <div class="muc_duoi1">
        <img src="/templates/admin/images/del_icon.png"><a class="xoa" href="#">Xóa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="sua" href="#">Sửa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="chitiet" href="#">Chi tiết</a>
        </div>
    </div>

    <div class="khung1">
        <div class="muc_chinh1">
            <span>→ Vị trí: Gian hàng A1</span>
        </div>
        <div class="muc_phu1">
            <ul>
                <li ><a>Bột giặt </a></li>
                <li class="active1"><a>Mì ăn liền</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>
                <li><a>Nước ngọt</a></li>
                <li><a>Gia vị nấu ăn</a></li>
            </ul>
        </div>
        <div class="muc_duoi1">
            <!-- <span>→ Vị trí: A1</span> -->
            <img src="/templates/admin/images/del_icon.png"><a class="xoa" href="#">Xóa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="sua" href="#">Sửa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="chitiet" href="#">Chi tiết</a>
        </div>
    </div>

    <div class="khung1">
        <div class="muc_chinh1">
            <span>→ Vị trí: Gian hàng A1</span>
        </div>
        <div class="muc_phu1">
            <ul>
                <li ><a>Bột giặt </a></li>
                <li class="active1"><a>Mì ăn liền</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>
                <li><a>Nước ngọt</a></li>
                <li><a>Gia vị nấu ăn</a></li>
            </ul>
        </div>
        <div class="muc_duoi1">
        <img src="/templates/admin/images/del_icon.png"><a class="xoa" href="#">Xóa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="sua" href="#">Sửa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="chitiet" href="#">Chi tiết</a>
        </div>
    </div>

    <div class="khung1">
        <div class="muc_chinh1">
            <span>→ Vị trí: Gian hàng A1</span>
        </div>
        <div class="muc_phu1">
            <ul>
                <li ><a>Bột giặt </a></li>
                <li class="active1"><a>Mì ăn liền</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>
                <li><a>Nước ngọt</a></li>
                <li><a>Gia vị nấu ăn</a></li>
            </ul>
        </div>
        <div class="muc_duoi1">
        <img src="/templates/admin/images/del_icon.png"><a class="xoa" href="#">Xóa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="sua" href="#">Sửa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="chitiet" href="#">Chi tiết</a>
        </div>
    </div>

    <div class="khung1">
        <div class="muc_chinh1">
            <span>→ Vị trí: Gian hàng A1</span>
        </div>
        <div class="muc_phu1">
            <ul>
                <li ><a>Bột giặt </a></li>
                <li class="active1"><a>Mì ăn liền</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>
                <li><a>Nước ngọt</a></li>
                <li><a>Gia vị nấu ăn</a></li>
            </ul>
        </div>
        <div class="muc_duoi1">
        <img src="/templates/admin/images/del_icon.png"><a class="xoa" href="#">Xóa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="sua" href="#">Sửa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="chitiet" href="#">Chi tiết</a>
        </div>
    </div>

    <div class="khung1">
        <div class="muc_chinh1">
            <span>→ Vị trí: Gian hàng A1</span>
        </div>
        <div class="muc_phu1">
            <ul>
                <li ><a>Bột giặt </a></li>
                <li class="active1"><a>Mì ăn liền</a></li>
                <li><a>Kẹo dẻo, Kẹo Quế, Kẹo Quy, Kẹo Bông Lan</a></li>
                <li><a>Nước ngọt</a></li>
                <li><a>Gia vị nấu ăn</a></li>
            </ul>
        </div>
        <div class="muc_duoi1">
        <img src="/templates/admin/images/del_icon.png"><a class="xoa" href="#">Xóa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="sua" href="#">Sửa</a>
            <span class="span_kc">|</span>
            <img src="/templates/admin/images/edit_icon.png"><a class="chitiet" href="#">Chi tiết</a>
        </div>
    </div>


</div>



</div>


<div class="clr"></div>
@stop