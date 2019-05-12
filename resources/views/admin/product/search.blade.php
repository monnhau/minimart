@extends('admin.templates.master')

@section('title')
Tìm kiếm sản phẩm
@stop

@section('css')
style_cat.css
@stop

@section('product')
active
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/popup_text.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')
<div class="content">
<a href="{{route('admin.product.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
    <div class="popup_text">
    </div>

    @php
        $search_by_name = '';
        if($search_by == 0) $search_by_name = 'Tất cả';
        else if($search_by == 1) $search_by_name = 'Tên sản phẩm';
        else if($search_by == 2) $search_by_name = 'Tên danh mục';
        else if($search_by == 3) $search_by_name = 'Hiển thị?';
        else if($search_by == 4) $search_by_name = 'Giảm giá?';
        else $search_by = 'ID sản phẩm';
    @endphp
    <h1>Tìm kiếm sản phẩm với từ khóa: "{{$key}}" theo {{$search_by_name}}</h1> 
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
        Danh sách sản phẩm:{{$quantity}}
    </div>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Thuộc danh mục</th>
                <th>Hiển thị ra trang chủ</th>
                <th>Có khuyến mãi?</th>
                <th>Hình ảnh</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($objItems_Product as $item)
            @php
                $name = $item->name;
                $id = $item->id;
                $picture = $item->picture;
                $active = $item->active;
                $active_km = $item->active_km;
                $km_text = $item->km_text;
                $name_cat = $item->name_cat;

                if($search_by == 0) {
                    $name = App\FreeFunction::highLight($key, $name);
                    $name_cat = App\FreeFunction::highLight($key, $name_cat);
                    $id = App\FreeFunction::highLight($key, $id);
                }
                if($search_by == 1) $name = App\FreeFunction::highLight($key, $name);
                else if($search_by == 2) $name_cat = App\FreeFunction::highLight($key, $name_cat);
                else if($search_by == 5) $id = App\FreeFunction::highLight($key, $id);
  
            @endphp
            <tr >
                <td>{!!$id!!}</td>
                <td>{!!$name!!}</td>
                <td>{!!$name_cat!!}</td>
                <td>
                    <div class="active{{$id}}">
                        @if($active == 1)
                        <img onclick="return ajaxToggoActiveStatus(1, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                        <img onclick="return ajaxToggoActiveStatus(0, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>
                <td>
                    <div>
                        @if($active_km == 1)
                            <img onclick="return ajaxShowKmText(1, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                            <img onclick="return ajaxShowKmText(0, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>

                <td>
                    <a href="{{route('admin.product.editPicture', ['id'=>$id])}}" title="Nhấn để thay đổi ảnh"><img class="img_td" src="{{$ProductUrl}}{{$picture}}" /></a>
                </td>
                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn muốn xóa sản phẩm không?', 'OK', 'Hủy', '{{ route('admin.product.del', ['id'=>$id] ) }}' ) ;" >Xóa</a>
                    <a class="btn_action btn_sua" href="{{ route('admin.product.edit', ['id'=>$id] ) }}">Sửa</a>
                    <a class="btn_action btn_menu" href="{{ route('admin.product.indexBatch', ['id'=>$id] ) }}">Xem các lô</a>
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
        {{$objItems_Product->links()}}
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
            url: '{{route('admin.product.ajaxToggoActiveStatus')}}',
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

    function ajaxShowKmText(presentStatus, id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: '{{route('admin.product.ajaxShowKmText')}}',
            type: 'post',
            cache: false,
            data: {presentStatus:presentStatus, id:id},
            success: function(data){
                $('.popup_text').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
        return false;
        
    }
</script>
@stop