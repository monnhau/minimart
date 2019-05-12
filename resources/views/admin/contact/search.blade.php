@extends('admin.templates.master')

@section('title')
Quản lí liên hệ
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
@stop

@section('contact')
active
@stop

@section('content')
@php
    $search_by_name = '';
    if($search_by == 0) $search_by_name = 'Tất cả';
    else if($search_by == 1) $search_by_name = 'Họ tên';
    else if($search_by == 2) $search_by_name = 'Sđt/Email';
    else if($search_by == 3) $search_by_name = 'Nội dung LH';
    else $search_by_name = 'Ngày liên hệ';
@endphp
<div class="content">
    <a href="{{route('admin.contact.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
    <h1>Tìm kiếm liên hệ với từ khóa:"{{$key}}" theo {{$search_by_name}} </h1> 
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
        Danh sách tìm kiếm liên hê:{{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người liên hệ</th>
                <th>Số phone/email</th>
                <th>Nội dung liên hệ</th>
                <th>Ngày liên hệ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_Contact as $item)
            @php
                $fullname = $item->fullname;
                $id = $item->id;
                $username = $item->username;
                $content = $item->content;
                $date_at = $item->date_at;

                if($search_by == 0) {
                            $fullname = App\FreeFunction::highLight($key, $fullname);
                            $username = App\FreeFunction::highLight($key, $username);
                            $content = App\FreeFunction::highLight($key, $content);
                            $date_at = App\FreeFunction::highLight($key, $date_at);
                        }
                else if($search_by == 1) $fullname = App\FreeFunction::highLight($key, $fullname);
                else if($search_by == 2) $username = App\FreeFunction::highLight($key, $username);
                else if($search_by == 3) $content = App\FreeFunction::highLight($key, $content);
                else $date_at = App\FreeFunction::highLight($key, $date_at);
            @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{!!$fullname!!}</td>
                <td>{!!$username!!}</td>
                <td>{!!$content!!}</td>
                <td>{!!$date_at!!}</td>
                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn không?', 'OK', 'Hủy', '{{route('admin.contact.del', ['id'=>$id])}}' ) ;" >Xóa</a>
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
            {{$objItems_Contact->links()}}
    </div>
    @endif
    
</div>
<div class="clr"></div>
@stop