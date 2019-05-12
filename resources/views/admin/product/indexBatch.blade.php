@extends('admin.templates.master')

@section('title')
Quản lí lô
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/confirm.js"></script>
@stop

@section('product')
active
@stop

@section('content')
<div class="content">
    <a href="{{route('admin.product.index')}}"><img class="img_back" src="{{$AdminResUrl}}/images/img_back.png" /></a>
    <h1>Quản lí lô thuộc sản phẩm: {{$objItem_Product->name}} </h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.product.addBatch', ['id'=>$objItem_Product->id])}}">Thêm lô</a>
    
        <form class="search_form">
            <input type="text" placeholder="Nhập từ khóa" name="key_search" class="txt_key">
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
        Danh sách lô:{{$quantity}}
    </div>
    <table border="1">
        <thead>
            <tr>
                <th>Mã lô</th>
                <th>Ngày sản xuất</th>
                <th>Hạn sử dụng</th>
                <th>Số lượng</th>
                <th>Kích hoạt bán hàng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        
        @foreach($objItems_Batch as $objItem)
        @php
        $name = 'Lô mã'.' '.$objItem->id;
        $id = $objItem->id;
        $nsx = $objItem->nsx;
        $nsx = strtotime($nsx);
        $nsx = date("d/m/y", $nsx);

        $hsd = $objItem->hsd;
        $hsd = strtotime($hsd);
        $hsd = date("d/m/y", $hsd);
        $qty = $objItem->qty;
        $active = $objItem->active;
        @endphp
            <tr>
                <td>{{$name}}</td>
                <td>{{$nsx}}</td>
                <td>{{$hsd}}</td>
                <td>{{$qty}}</td>

                <td>
                    <div class="active{{$id}}">
                        @if($active == 1)
                        <img onclick="return Confirm('Xác nhận thay đổi?', 'Còn {{$qty}} sản phẩm trong lô<br><br> Bạn chắc chắn muốn ngừng bán lô này?', 'OK', 'Hủy', '{{ route('admin.product.toggoActiveStatusBatch', ['presentStatus'=>$active, 'id'=>$id, 'sid'=>$objItem_Product->id] ) }}')" class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                        <img onclick="return Confirm('Xác nhận thay đổi?', 'Hãy chắc chắn bạn đã dán nhãn Mã lô trên các sản phẩm của lô này<br> và đưa số hàng này ra quấy để sẵn sàng bán!!<br><br> Nếu chưa sẵn sàng, hãy nhấn Hủy', 'OK', 'Hủy', '{{ route('admin.product.toggoActiveStatusBatch', ['presentStatus'=>$active, 'id'=>$id, 'sid'=>$objItem_Product->id] ) }}')" class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>

                <td>
                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Hiện có {{$qty}} sản phẩm `{{$objItem_Product->name}}` tồn tại trong lô này. Bạn chắc chắn muốn xóa lô này không?', 'OK', 'Hủy', '{{route('admin.product.delBatch', ['id'=>$objItem_Product->id, 'sid'=>$id])}}' ) ;" >Xóa</a>
                    <a class="btn_action btn_sua" href="{{route('admin.product.editBatch', ['id'=>$objItem_Product->id, 'sid'=>$id])}}">Sửa</a>
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
        {{$objItems_Batch->links()}}    
    </div>
    @endif
    
</div>
<div class="clr"></div>

@stop