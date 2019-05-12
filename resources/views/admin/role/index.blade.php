@extends('admin.templates.master')

@section('title')
Quản lí chức vụ
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('role')
active
@stop

@section('content')
<div class="content">
    <h1>Quản lí chức vụ</h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.role.add')}}">Thêm chức vụ</a>
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
        Danh sách chức vụ:{{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên chức vụ</th>
                <th>Phận sự Admin</th>
                <th>Phận sự Danh mục</th>
                <th>Phận sự Sản phẩm</th>
                <th>Phận sự User</th>
                <th>Phận sự Giao diện</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_Role as $item)
        @php
        $name = $item->name;
        $id = $item->id;
        $phanSuAdmin = $item->phanSuAdmin;
        $phanSuDanhMuc = $item->phanSuDanhMuc;
        $phanSuProduct = $item->phanSuProduct;
        $phanSuUser = $item->phanSuUser;
        $phanSuGiaoDien = $item->phanSuGiaoDien;
        @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{{$name}}</td>
                <td>
                    <div class="activePSAM{{$id}}">
                        @if($phanSuAdmin == 1)
                        <img onclick="return ajaxToggoActiveStatusPS(1, {{$id}}, 'AM')" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                        <img onclick="return ajaxToggoActiveStatusPS(0, {{$id}}, 'AM')" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>

                <td>
                    <div class="activePSDM{{$id}}">
                        @if($phanSuDanhMuc == 1)
                        <img onclick="return ajaxToggoActiveStatusPS(1, {{$id}}, 'DM')" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                        <img onclick="return ajaxToggoActiveStatusPS(0, {{$id}}, 'DM')" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>

                <td>
                    <div class="activePSPD{{$id}}">
                        @if($phanSuProduct == 1)
                        <img onclick="return ajaxToggoActiveStatusPS(1, {{$id}}, 'PD')" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                        <img onclick="return ajaxToggoActiveStatusPS(0, {{$id}}, 'PD')" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>

                <td>
                    <div class="activePSUS{{$id}}">
                        @if($phanSuUser == 1)
                        <img onclick="return ajaxToggoActiveStatusPS(1, {{$id}}, 'US')" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                        <img onclick="return ajaxToggoActiveStatusPS(0, {{$id}}, 'US')" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>

                <td>
                    <div class="activePSGD{{$id}}">
                        @if($phanSuGiaoDien == 1)
                        <img onclick="return ajaxToggoActiveStatusPS(1, {{$id}}, 'GD')" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                        <img onclick="return ajaxToggoActiveStatusPS(0, {{$id}}, 'GD')" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>
                
                <td>
                    @if( !($name == 'admin' || $name == 'user') )
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn không?', 'OK', 'Hủy', '{{route('admin.role.del', ['id'=>$id])}}' ) ;" >Xóa</a>
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
        {{$objItems_Role->links()}}
    </div>
    @endif
    
</div>
<div class="clr"></div>
<script type="text/javascript">
function ajaxToggoActiveStatusPS(presentStatus, id, level){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '{{route('admin.role.ajaxToggoActiveStatusPS')}}',
        type: 'post',
        cache: false,
        data: {presentStatus:presentStatus, id:id, level:level},
        success: function(data){
            $('.activePS'+level+id).html(data);
        },
        error: function (){
            alert('Dinh menh');
        }
    });
    return false;

}
</script>
@stop