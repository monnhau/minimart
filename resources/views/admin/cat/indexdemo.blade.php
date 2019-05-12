@extends('admin.templates.master')

@section('title')
Quản lí sản phẩm
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
@stop

@section('cat')
active
@stop

@section('content')
<div class="content">
    <h1>Quản lí sản phẩm</h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.cat.add')}}">Thêm sản phẩm</a>
    
        <form class="search_form">
            <input type="text" placeholder="Nhập từ khóa" name="key_search" class="txt_key">
            <input type="submit" name="submit" class="button" value="Tìm kiếm">
        </form>

    </div>
    
    <hr />


    
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
   


    <div class="header_table">
        Danh sách sản phẩm
    </div>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_Product as $item)
        @php
        $name = $item->name;
        $id = $item->id;
            $urlDel = '';
            $urlEdit = '';
        @endphp
            <tr>
                <td>id</td>
                <td>name</td>
                <td>active</td>
                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn không?', 'OK', 'Hủy', 'http://google.com' ) ;" >Xóa</a>
                    <a class="btn_action btn_sua" href="{{ route('admin.product.edit', ['id'=>$id] ) }}">Sửa</a>
                    <a class="btn_action btn_menu" href="#">Xem các lô</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <div class="phan_trang">
    <style type="text/css" media="screen">
        .pagination li {
            display: inline;
            font-size: 20px;
            border: 1px solid #bdbdbd;
        }
        .pagination li a{
            padding: 1px 8px;
        }	
        .pagination li span{
            padding: 1px 8px;
        }	
    </style>
        {{$objItems_Product->links()}}
    </div>
    
    
</div>
<div class="clr"></div>
@stop