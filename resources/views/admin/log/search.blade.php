@extends('admin.templates.master')

@section('title')
Quản lí nhật kí
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/popup_text.js"></script>
@stop

@section('log')
active
@stop

@section('content')
<div class="content">
    @php
        $search_by_name = '';
        if($search_by == 0) $search_by_name = 'Tất cả';
        else if($search_by == 1) $search_by_name = 'Hành động';
        else if($search_by == 2) $search_by_name = 'Tài khoản';
        else $search_by_name = 'Ngày thực hiện';
    @endphp

    <a href="{{route('admin.log.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
    <h1>Tìm kiếm hoạt động nhật kí với từ khóa:"{{$key}}" theo {{$search_by_name}} </h1>
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
        Danh sách tìm kiếm nhật kí:{{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hoạt động</th>
                <th>Username</th>
                <th>Thời điểm</th>
                <th>Chi tiết</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_Log as $item)
            @php
                $id = $item->id;
                $username = $item->username;
                $action = $item->action;
                $date_at = $item->date_at;
                $detail = $item->detail;
                if($detail == '') $detail = 'Nội dung trống';

                if($search_by == 0) {
                    $action = App\FreeFunction::highLight($key, $action);
                    $username = App\FreeFunction::highLight($key, $username);
                    $date_at = App\FreeFunction::highLight($key, $date_at);
                }
                else if($search_by == 1) $action = App\FreeFunction::highLight($key, $action);
                else if($search_by == 2) $username = App\FreeFunction::highLight($key, $username);
                else $date_at = App\FreeFunction::highLight($key, $date_at);
            @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{!!$action!!}</td>
                <td>{!!$username!!}</td>
                <td>{!!$date_at!!}</td>
                <td>
                    <a class="btn_action btn_sua" href="javascript:void(0)" onclick="return PopupText('Chi tiết nhật kí', '{{$detail}}', 'Đóng' ) ;" >Xem chi tiết</a>
                </td>
                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn không?', 'OK', 'Hủy', '{{route('admin.log.del', ['id'=>$id])}}' ) ;" >Xóa</a>
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
            {{$objItems_Log->links()}}
    </div>
    @endif
    
</div>
<div class="clr"></div>
@stop