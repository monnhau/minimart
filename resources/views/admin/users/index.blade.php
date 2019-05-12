@extends('admin.templates.master')

@section('title')
Quản lí user
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
    <h1>Quản lí người dùng</h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.users.add')}}">Thêm người dùng</a>
    
        <form action="{{route('admin.users.search')}}" method="get" class="search_form">
            {{csrf_field()}}
            <select class="search_by" name="search_by" id="selectBox" onchange="changeFunc();">
                <option selected value="0">------Tất cả------</option>
                <option value="1">Tìm theo T.Khoản</option>
                <option value="2">Tìm theo Fullname</option>
                <option value="3">Tìm theo chức vụ</option>  
                <option value="4">Tìm theo ID</option>   
            </select>
            <input type="text" placeholder="Nhập từ khóa" name="key" id="key_search" class="txt_key">
            <script type="text/javascript">
                    function changeFunc() {
                        var selectBox = document.getElementById("selectBox");
                        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                        if(selectedValue == 0) {
                            document.getElementById('key_search').placeholder='Nhập từ khóa';
                        }else if(selectedValue == 1) {
                            document.getElementById('key_search').placeholder='Nhập tài khoản';
                        }else if(selectedValue == 2) {
                            document.getElementById('key_search').placeholder='Nhập họ tên';
                        }else if(selectedValue == 3) {
                            document.getElementById('key_search').placeholder='Nhập tên chức vụ';
                        }else{
                            document.getElementById('key_search').placeholder='Nhập ID';
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
        Danh sách người dùng:{{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tài khoản</th>
                <th>Chức vụ</th>
                <th>Fullname</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_User as $item)
        @php
        $username = $item->username;
        $id = $item->id;
        $fullname = $item->fullname;
        $name2 = $item->name2;
        @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{{$username}}</td>
                <td>{{$name2}}</td>
                <td>{{$fullname}}</td>
                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn không?', 'OK', 'Hủy', '{{route('admin.users.del', ['id'=>$id])}}' ) ;" >Xóa</a>
                    <a class="btn_action btn_sua" href="{{ route('admin.users.edit', ['id'=>$id] ) }}">Sửa</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <p>Danh sách trống</p>
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