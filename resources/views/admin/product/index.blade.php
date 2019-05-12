@extends('admin.templates.master')

@section('title')
Quản lí sản phẩm
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

    <div class="popup_text">
    </div>

    <h1>Quản lí sản phẩm</h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.product.add')}}">Thêm sản phẩm</a>
    
        <form class="search_form" action="{{route('admin.product.search')}}" method="get"> 
            <select class="search_by" name="search_by" id="selectBox" onchange="changeFunc();" >
                <option selected value="0">------Tất cả------</option>
                <option value="1">Tìm theo tên S.Phẩm</option>
                <option value="2">Tìm theo tên D.Mục</option>
                <option value="3">Tìm theo Hiển thị?</option>  
                <option value="4">Tìm theo Khuyến mãi?</option>   
                <option value="5">Tìm theo ID S.Phẩm</option>   
            </select>

            <input type="text" placeholder="Nhập từ khóa" name="key" id="key_search" class="txt_key">

            <script type="text/javascript">
                    function changeFunc() {
                        var selectBox = document.getElementById("selectBox");
                        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                        if(selectedValue == 0) {
                            document.getElementById('key_search').placeholder='Nhập từ khóa';
                        }else if(selectedValue == 1) {
                            document.getElementById('key_search').placeholder='Nhập tên sản phẩm';
                        }else if(selectedValue == 2) {
                            document.getElementById('key_search').placeholder='Nhập tên danh mục';
                        }else if(selectedValue == 3) {
                            document.getElementById('key_search').placeholder='Nhập 0 hoặc 1';
                        }else if(selectedValue == 4){
                            document.getElementById('key_search').placeholder='Nhập 0 hoặc 1';
                        }else{
                            document.getElementById('key_search').placeholder='Nhập ID sản phẩm';
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
        Danh sách sản phẩm:{{$quantity}}
    </div>

    <div style="overflow-x:auto;">
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Thuộc danh mục</th>
                    <th>Hiển thị ra trang chủ</th>
                    <th>Có khuyến mãi?</th>
                    <th>Hình ảnh</th>
                    
                    <th>Đơn vị lẻ nhỏ nhất(ĐVLNN)</th>
                    <th>Giá lẻ / ĐVLNN</th>
                    <th>Kích hoạt bán sĩ?</th>
                    <th>Đơn vị sĩ nhỏ nhất(ĐVSNN)</th>
                    <th>Giá sĩ / ĐVSNN</th>
                    
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

                    $unit_le_char = $item->unit_le_char;
                    $price_si = $item->price_si;
                    $price_le = $item->price_le;
                    $active_ban_si = $item->active_ban_si;

                    $unit_si_int = ($item->unit_si_int != null)?$item->unit_si_int:'?';
                    $price_le_fm = ($price_le != null)?number_format($price_le,0):'?';
                    $price_si_fm = ($price_si != null)?number_format($price_si,0):'?';
                @endphp
                <tr >
                    <td>{{$id}}</td>
                    <td>{{$name}}</td>
                    <td>{{$name_cat}}</td>
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
                        <span class="unit_desc_span">{{$unit_le_char}}</span>
                    </td>

                    <td><span class="product_price">{{$price_le_fm}}</span> ({{$TienTe}}) / 1 {{$unit_le_char}}</td>

                    <td>
                        <div>
                            @if($active_ban_si == 1)
                                <img onclick="return ajaxShowPriceText(1, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                            @else
                                <img onclick="return ajaxShowPriceText(0, {{$id}})" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                            @endif
                        </div>
                    </td>
                    
                    <td>
                        <span class="unit_desc_span">{{$unit_si_int}} {{$unit_le_char}} </span>
                    </td>
                    
                    <td><span class="product_price">{{$price_si_fm}}</span> ({{$TienTe}}) / {{$unit_si_int}} {{$unit_le_char}}</td>
                    
                    <td>
                        <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn muốn xóa sản phẩm không?', 'OK', 'Hủy', '{{ route('admin.product.del', ['id'=>$id] ) }}' ) ;" >Xóa</a>
                        <a class="btn_action btn_sua" href="{{ route('admin.product.edit', ['id'=>$id] ) }}">Sửa</a>
                        <a class="btn_action btn_menu" href="{{ route('admin.product.indexBatch', ['id'=>$id] ) }}">Xem các lô</a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
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

    function ajaxShowPriceText(presentStatus, id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: '{{route('admin.product.ajaxShowPriceText')}}',
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