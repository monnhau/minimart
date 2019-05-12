@extends('admin.templates.master')
@section('title')
Trang quản trị
@stop

@section('css')
style_index.css
@stop

@section('home')
active
@stop

@section('content')
<div class="content">
    <h1>Một số thông báo</h1>

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
@stop
