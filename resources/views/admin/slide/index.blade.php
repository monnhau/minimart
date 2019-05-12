@extends('admin.templates.master')

@section('title')
Quản lí slide
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('slide')
active
@stop

@section('content')
<div class="content">
    <h1>Quản lí slide</h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.slide.add')}}">Thêm ảnh slide</a>
        <a style="margin-left:20px;" class="button" href="{{route('admin.slide.showStorageSlide')}}">Quản lí kho slide</a>
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
        Danh sách ảnh:{{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mô tả</th>
                <th>Chi tiết</th>
                <th>Active</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_Slide as $objItem)
            @php
                $picture = $objItem->picture;
                $id = $objItem->id;
                $desc_text = $objItem->desc_text;
                $detail_text = $objItem->detail_text;
                $active = $objItem->active;
            @endphp
            <tr>
                <td>{{$id}}</td>
                <td>{{$desc_text}}</td>
                <td>{{$detail_text}}</td>
                <td>
                    <div class="active{{$id}}">
                    @if($active == 1)
                        <img onclick="return ajaxToggoActiveStatus(1, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                    @else
                        <img onclick="return ajaxToggoActiveStatus(0, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/off.png"/>
                    @endif
                    </div>
                </td>
                <td>
                    <a href="{{route('admin.slide.editPicture', ['id'=>$id])}}"><img class="img_td" src="{{$SlideUrl}}{{$picture}}" title="Nhấn để thay đổi ảnh" alt="Nhấn để thay đổi ảnh" /></a>
                </td>
                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn không?', 'OK', 'Hủy', '{{route('admin.slide.del', ['id'=>$id])}}' ) ;" >Xóa</a>
                    <a class="btn_action btn_sua" href="{{route('admin.slide.edit', ['id'=>$id])}}" >Sửa</a>
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
        {{$objItems_Slide->links()}}
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
        url: '{{route('admin.slide.ajaxToggoActiveStatus')}}',
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