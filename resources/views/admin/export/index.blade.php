@extends('admin.templates.master')

@section('title')
Quản lí xuất hàng
@stop

@section('css')
style_cat.css
@stop

@section('css2')
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<script type="text/javascript"  src="{{$AdminResUrl}}js/popup_text.js"></script>
@stop

@section('export')
active
@stop

@section('content')

<div class="content">
    <h1>Quản lí xuất hàng</h1>
    <div class="them_and_tk">
        <a class="button btn_them" href="{{route('admin.export.export')}}">Xuất hàng</a>
    
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
        Danh sách hóa đơn xuất:{{$quantity}}
    </div>

    <div style="overflow-x:auto;">
        <table border="1">
            <thead>
                <tr>
                    <!-- <th>ID Hóa đơn</th> -->
                    <th>Ngày bán</th>
                    <th>Tổng tiền hóa đơn</th>
                    <th>Thao tác</th>

                    <!-- <th>ID export</th> -->
                    <th>Tên sản phẩm</th>
                    <!-- <th>Thuộc mã lô</th> -->


                    <th>Số lượng</th>
                    <th>Thành tiền</th>

                    <th class="td_empty"></th>

                    <th>ĐVLNN</th>
                    <th>Giá lẻ</th>

                    <th>Được hưởng giá sĩ?</th>

                    <th>ĐVSNN</th>
                    <th>Giá sĩ</th>

                    <th>Xem thêm</th>
                    <!-- <th>Ngay san xuat</th>
                    <th>Han su dung</th>  -->
                </tr>
            </thead>

            <tbody>
            @foreach($objItems_Bill as $objItem)
                @php
                   
                    $id = $objItem->id;
                    $date_at = $objItem->date_at;
                    $total_money = $objItem->total_money;

                    $total_money_fm = ($total_money != null)?number_format($total_money,0):'?';

                    $objItems_Export = App\Export::getItemsByIdBill($id);
                    $objItems_Export_Count = count($objItems_Export);
                @endphp

                @if($objItems_Export_Count > 0)
                    @php
                        $count2 = 0;
                    @endphp
                    @foreach($objItems_Export as $objItem2)
                        @php
                            $id2 =  $objItem2->id;
                            $id_batch = $objItem2->id_batch;
                            $count2 = $count2 + 1;
                            $name_product = $objItem2->name_product;
                            $qty = $objItem2->qty;

                            $unit_le_char = $objItem2->unit_le_char;
                            $price_si = $objItem2->price_si;
                            $price_le = $objItem2->price_le;
                            $active_ban_si = $objItem2->active_ban_si;
                            $sub_money = $objItem2->sub_money;
                            $nsx = $objItem2->nsx;
                            $hsd = $objItem2->hsd;

                            $unit_si_int = ($objItem2->unit_si_int != null)?$objItem2->unit_si_int:'?';

                            $price_le_fm = ($price_le != null)?number_format($price_le,0):'?';
                            $price_si_fm = ($price_si != null)?number_format($price_si,0):'?';
                            $sub_money_fm = ($sub_money != null)?number_format($sub_money,0):'?';

                            $xemThem =  'Tên sản phẩm:'.$name_product.'<br>'
                                       .'ID export:'.$id2.'<br>'
                                       .'ID lô:'.$id_batch.'<br>'
                                       .'Ngày sản xuất:'.$nsx.'<br>'
                                       .'Hạn sử dụng:'.$hsd.'<br>';
                        @endphp

                        @if($count2 == 1)
                            <tr class="space_tr">
                                <!-- <td rowspan="{{$objItems_Export_Count}}">id</td> -->
                                <td rowspan="{{$objItems_Export_Count}}">{{$date_at}}</td>
                                <td rowspan="{{$objItems_Export_Count}}">{{$total_money_fm}} {{$TienTe}}</td>

                                <td rowspan="{{$objItems_Export_Count}}">
                                    <a class="btn_action btn_xoa" href="javascript:void(0)" onclick="return Confirm('Xác nhận xóa', 'Bạn chắc chắn muốn xóa sản phẩm không?', 'OK', 'Hủy', '#' ) ;" >Xóa</a>
                                </td>

                                <!-- <td>id2</td> -->
                                <td>{{$name_product}}</td>
                                <!-- <td>id_batch</td> -->

                                <td><span class="product_price">{{$qty}}</span> {{$unit_le_char}}</td>
                                <td><span class="product_price">{{$sub_money_fm}}</span> {{$TienTe}}</td>

                                <td class="td_empty"></td>
                
                                <td><span class="unit_desc_span">{{$unit_le_char}}</span></td>
                                <td><span class="product_price">{{$price_le_fm}}</span> {{$TienTe}} / {{$unit_le_char}}</td>

                                <td>
                                    <div>
                                        @if($active_ban_si == 1)
                                        <img class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                                        @else
                                        <img class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                                        @endif
                                    </div>
                                </td>

                                <td><span class="unit_desc_span">{{$unit_si_int}} {{$unit_le_char}}</span></td>
                                <td><span class="product_price">{{$price_si_fm}}</span> (đ) / {{$unit_si_int}} {{$unit_le_char}}</td>
                            
                                <td>
                                    <a class="btn_action btn_sua" href="javascript:void(0)" onclick="return PopupText('Xem chi tiết', '{{$xemThem}}', 'Đóng') ;" >Xem thêm</a>
                                </td>
                                <!-- <td>nsx</td> -->
                                <!-- <td>nsx</td> -->
                            </tr>

                        @endif

                        @if($count2 > 1)
                            <tr>
                                <!-- <td>id2</td> -->
                                <td>{{$name_product}}</td>
                                <!-- <td>id_batch</td> -->
                                
                                <td><span class="product_price">{{$qty}}</span> {{$unit_le_char}}</td>
                                <td><span class="product_price">{{$sub_money_fm}}</span> {{$TienTe}}</td>

                                <td class="td_empty"></td>
                
                                <td><span class="unit_desc_span">{{$unit_le_char}}</span></td>
                                <td><span class="product_price">{{$price_le_fm}}</span> {{$TienTe}} / {{$unit_le_char}}</td>

                                <td>
                                    <div>
                                        @if($active_ban_si == 1)
                                        <img class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                                        @else
                                        <img class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                                        @endif
                                    </div>
                                </td>

                                <td><span class="unit_desc_span">{{$unit_si_int}} {{$unit_le_char}}</span></td>
                                <td><span class="product_price">{{$price_si_fm}}</span> {{$TienTe}} / {{$unit_si_int}} {{$unit_le_char}}</td>

                                <td>
                                    <a class="btn_action btn_sua" href="javascript:void(0)" onclick="return PopupText('Xem chi tiết', '{{$xemThem}}', 'Đóng') ;" >Xem thêm</a>
                                </td>
                                <!-- <td>nsx</td> -->
                                <!-- <td>nsx</td> -->
                            </tr>
                        @endif
                    @endforeach
                @endif
                
            @endforeach
            
            </tbody>
        </table>
    </div>
    @else
        <p class="empty_list_p">Danh sách trống</p>
    @endif
    
    @if($quantity > $AdminRowCount)
    <div class="phan_trang">
        {{$objItems_Bill->links()}}
    </div>
    @endif
    
    
</div>
<div class="clr"></div>
@stop