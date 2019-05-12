@extends('admin.templates.master')

@section('title')
Tìm kiếm người dùng
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
@stop

@section('users')
active
@stop

@section('content')
<div class="content">
    <a href="{{route('admin.users.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
    @php
        $search_by_name = '';
        if($search_by == 0) $search_by_name = 'Tất cả';
        else if($search_by == 1) $search_by_name = 'Tài khoản';
        else if($search_by == 2) $search_by_name = 'Họ và tên';
        else if($search_by == 3) $search_by_name = 'Chức vụ';
        else $search_by = 'Mã ID';
    @endphp
    <h1>Tìm kiếm người dùng với từ khóa: "{{$key}}" theo {{$search_by_name}}</h1>    
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
        Danh sách tìm kiếm người dùng: {{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Chức vụ</th>
                <th>Fullname</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_User as $item)
        @php
            $username = $item->username;
            $id = $item->id;
            $fullname = $item->fullname;
            $name2 = $item->name2;

            if($search_by == 0) {
                $username = App\FreeFunction::highLight($key, $username);
                $fullname = App\FreeFunction::highLight($key, $fullname);
                $name2 = App\FreeFunction::highLight($key, $name2);
                $id = App\FreeFunction::highLight($key, $id);
            }
            if($search_by == 1) $username = App\FreeFunction::highLight($key, $username);
            else if($search_by == 2) $fullname = App\FreeFunction::highLight($key, $fullname);
            else if($search_by == 3) $name2 = App\FreeFunction::highLight($key, $name2);
            else $id = App\FreeFunction::highLight($key, $id);
        @endphp
            <tr>
                <td>{!!$id!!}</td>
                <td>{!!$username!!}</td>
                <td>{!!$name2!!}</td>
                <td>{!!$fullname!!}</td>
                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn không?', 'OK', 'Hủy', '{{route('admin.users.del', ['id'=>$id])}}' ) ;" >Xóa</a>
                    <a class="btn_action btn_sua" href="{{ route('admin.users.edit', ['id'=>$id] ) }}">Sửa</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p class="empty_list_p">Danh sách tìm kiếm trống</p>
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
            {{$objItems_User->links()}}
        </div>
    @endif
    
</div>
<div class="clr"></div>
@stop