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
<div class="content">
    <h1>Quản lí liên hệ</h1>
    <div class="them_and_tk">
        <a class="button btn_null" href="#"></a>
    
        <form class="search_form" action="{{route('admin.contact.search')}}" method="get">
            <select class="search_by" name="search_by" id="selectBox" onchange="changeFunc();">
                <option selected value="0">------Tất cả------</option>
                <option value="1">Tìm theo Họ tên</option>
                <option value="2">Tìm theo Sđt/Mail</option>
                <option value="3">Tìm theo Nội dung</option>  
                <option value="4">Tìm theo Ngày LH</option>  
            </select>
            <input type="text" placeholder="Nhập từ khóa" name="key" id="key_search" class="txt_key">
            <script type="text/javascript">
                    function changeFunc() {
                        var selectBox = document.getElementById("selectBox");
                        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                        if(selectedValue == 0) {
                            document.getElementById('key_search').placeholder='Nhập từ khóa';
                        }else if(selectedValue == 1) {
                            document.getElementById('key_search').placeholder='Nhập họ tên';
                        }else if(selectedValue == 2) {
                            document.getElementById('key_search').placeholder='Nhập Sđt/Email';
                        }else if(selectedValue == 3) {
                            document.getElementById('key_search').placeholder='Nhập key nội dung';
                        }else{
                            document.getElementById('key_search').placeholder='Nhập ngày(2019-12-30)';
                        }
                    }
            </script>
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


    @if($quantity > 0)
    <div class="header_table">
        Danh sách liên hệ:{{$quantity}}
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
        @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{{$fullname}}</td>
                <td>{{$username}}</td>
                <td>{{$content}}</td>
                <td>{{$date_at}}</td>
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