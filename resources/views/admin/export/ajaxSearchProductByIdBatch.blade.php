<script type="text/javascript">
    @if($err == 'false1')
        var html = '<p class="msg_err">'+'Mã sản phẩm '+{{$stt}}+' không tìm thấy!'+'<p>';             
        document.getElementsByName('qty'+{{$stt}})[0].disabled = true;
        document.getElementsByName('qty'+{{$stt}})[0].value = '';
        $('#msg'+{{$stt}}).html(html);
    @elseif($err == 'false2')
        var html = '<p class="msg_err">'+'Sản phẩm '+{{$stt}}+' không tìm thấy!'+'<p>';
        document.getElementsByName('qty'+{{$stt}})[0].disabled = true;
        document.getElementsByName('qty'+{{$stt}})[0].value = '';
        $('#msg'+{{$stt}}).html(html);
    @else
        $('#msg'+{{$stt}}).html('');
        document.getElementsByName('qty'+{{$stt}})[0].disabled = false;
        document.getElementsByName('qty'+{{$stt}})[0].value = '';
    @endif
</script>

@if( $err == 'false1' || $err == 'false2' )
<div style="overflow-x:auto;">
    <table border="1">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Có khuyến mãi?</th>
                <th>Hình ảnh</th>
                
                <th>Đơn vị lẻ nhỏ nhất(ĐVLNN)</th>
                <th>Giá lẻ / ĐVLNN</th>
                <th>Kích hoạt bán sĩ?</th>
                <th>Đơn vị sĩ nhỏ nhất(ĐVSNN)</th>
                <th>Giá sĩ / ĐVSNN</th>       
            </tr>
        </thead>
        <tbody>

            <tr class="one_tr_product">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<hr class="hr_margin">
@else
<div style="overflow-x:auto;">
    <table border="1">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Có khuyến mãi?</th>
                <th>Hình ảnh</th>
                
                <th>Đơn vị lẻ nhỏ nhất(ĐVLNN)</th>
                <th>Giá lẻ / ĐVLNN</th>
                <th>Kích hoạt bán sĩ?</th>
                <th>Đơn vị sĩ nhỏ nhất(ĐVSNN)</th>
                <th>Giá sĩ / ĐVSNN</th>
            
            </tr>
        </thead>
        <tbody>
        
            @php
                $name = $objItem_Product->name;
                $id = $objItem_Product->id;
                $picture = $objItem_Product->picture;
                $active = $objItem_Product->active;
                $active_km = $objItem_Product->active_km;
                $km_text = $objItem_Product->km_text;
                $name_cat = $objItem_Product->name_cat;

                $unit_le_char = $objItem_Product->unit_le_char;
                $price_si = $objItem_Product->price_si;
                $price_le = $objItem_Product->price_le;
                $active_ban_si = $objItem_Product->active_ban_si;

                $unit_si_int = ($objItem_Product->unit_si_int != null)?$objItem_Product->unit_si_int:'?';
                $price_le_fm = ($price_le != null)?number_format($price_le,0):'?';
                $price_si_fm = ($price_si != null)?number_format($price_si,0):'?';
            @endphp
            <tr >
                <td>{{$name}}</td>
                <td>
                    <div>
                        @if($active_km == 1)
                            <img class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                            <img class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>

                <td>
                    <a><img class="img_td" src="{{$ProductUrl}}{{$picture}}" /></a>
                </td>
                
                <td>
                    <span class="unit_desc_span">{{$unit_le_char}}</span>
                </td>

                <td><span class="product_price">{{$price_le_fm}}</span> ({{$TienTe}}) / 1 {{$unit_le_char}}</td>

                <td>
                    <div>
                        @if($active_ban_si == 1)
                            <img class="toggle_img" src="{{$AdminResUrl}}images/on.png" />
                        @else
                            <img class="toggle_img" src="{{$AdminResUrl}}images/off.png" />
                        @endif
                    </div>
                </td>
                
                <td>
                    <span class="unit_desc_span">{{$unit_si_int}} {{$unit_le_char}} </span>
                </td>
                
                <td><span class="product_price">{{$price_si_fm}}</span> ({{$TienTe}}) / {{$unit_si_int}} {{$unit_le_char}}</td>
                
            </tr>
    

        </tbody>
    </table>
</div>

<hr class="hr_margin">

@endif