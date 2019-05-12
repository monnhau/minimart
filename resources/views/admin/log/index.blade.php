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
    <h1>Quản lí nhật kí</h1>
    <div class="them_and_tk">

        <a class="button btn_null" href="#"></a>
    
        <form class="search_form" action="{{route('admin.log.search')}}" method="get">
            <select class="search_by" name="search_by" id="selectBox" onchange="changeFunc();">
                <option selected value="0">------Tất cả------</option>
                <option value="1">Tìm theo H.Động </option>
                <option value="2">Tìm theo T.Khoản</option>
                <option value="3">Tìm theo Th.Điểm</option>  
            </select>
            <input type="text" placeholder="Nhập từ khóa" name="key" id="key_search" class="txt_key">

            <script type="text/javascript">
                    function changeFunc() {
                        var selectBox = document.getElementById("selectBox");
                        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                        if(selectedValue == 0) {
                            document.getElementById('key_search').placeholder='Nhập từ khóa';
                        }else if(selectedValue == 1) {
                            document.getElementById('key_search').placeholder='Nhập tên hành động';
                        }else if(selectedValue == 2) {
                            document.getElementById('key_search').placeholder='Nhập tên tài khoản';
                        }else{
                            document.getElementById('key_search').placeholder='Nhập ngày (2019-12-29)';
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
        Danh sách nhật kí:{{$quantity}}
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
        @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{{$action}}</td>
                <td>{{$username}}</td>
                <td>{{$date_at}}</td>
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
            {{$objItems_Log->links()}}
    </div>
    @endif
    
</div>
<div class="clr"></div>
@stop