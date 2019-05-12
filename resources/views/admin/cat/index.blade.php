@extends('admin.templates.master')

@section('title')
Quản lí danh mục
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('cat')
active
@stop

@section('content')

<div class="content">
    <h1>Quản lí danh mục</h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.cat.add')}}">Thêm danh mục</a>
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

    @if($quantity > 0)
    <div class="header_table">
        Danh sách danh mục:{{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hiển thị ra trang chủ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_Cat as $objItem_Cat)
            @php
            $id = $objItem_Cat->id;
            $name = $objItem_Cat->name;
            $active = $objItem_Cat->active;
            @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{{$name}}</td>

                <td>
                @if( !($id == 1) )
                    <div class="active{{$id}}">
                    @if($active == 1)
                        <img onclick="return ajaxToggoActiveStatus(1, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                    @else
                        <img onclick="return ajaxToggoActiveStatus(0, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/off.png"/>
                    @endif
                    </div>
                @endif
                </td>

                <td>
                @if( !($id == 1) )
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn muốn xóa danh mục này không?', 'OK', 'Hủy', '{{route('admin.cat.del', ['id'=>$id])}}' ) ;" >Xóa</a>
                    <a class="btn_action btn_sua" href="{{route('admin.cat.edit', ['id'=>$id])}}">Sửa</a>
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p class="empty_list_p">Danh sách trống</p>
    @endif

    @if($quantity > $AdminRowCount)
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
            {{$objItems_Cat->links()}}
        </div>
    @endif
    
</div>
<div class="clr"></div>

<script type="text/javascript">
    function ajaxToggoActiveStatus(presentStatus, id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route('admin.cat.ajaxToggoActiveStatus')}}',
            type: 'post',
            cache: false,
            data: {presentStatus:presentStatus, id:id},
            success: function(data){
                $('.active'+id).html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
        return false;
    }
</script>
@stop