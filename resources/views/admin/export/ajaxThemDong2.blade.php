@if($soDong > 0 && $soDong < 100)
    @for($i = 1; $i <= $soDong + 1; $i++)
        @php
            $id_batch = 'id_batch'.$i;
            $qty = 'qty'.$i;
            $msg='msg'.$i;
        @endphp
            <div class="mot_sp">
                <div id="{{$msg}}" class="msg_export"></div>

                <div class="div_ma">
                    <p class="label_input label_bold">Mã sản phẩm {{$i}}:</p>
                    <input onchange="searchProduct(this.value, {{$i}} )" class="txt_field_haft" type="number" name="{{$id_batch}}" required="true" /> 

                </div>
                
                <div class="div_soluong">
                    <p class="label_input">Số lượng:</p>
                    <input onchange="checkQty(this.value, {{$i}})" class="txt_field_haft" type="number" name="{{$qty}}" disabled="true"  required="true" />
                </div>

                <div id="search_result{{$i}}" class="search_result_class">
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

                </div>

                
            </div>
    @endfor
@else
    <div class="mot_sp">
        <div id="msg1" class="msg_export"></div>

        <div class="div_ma">
            <p class="label_input label_bold">Mã sản phẩm 1: </p>
            <input onchange="searchProduct(this.value, 1)" class="txt_field_haft" type="number" name="id_batch1" required="true" />
        </div>
    
        <div class="div_soluong">
            <p class="label_input">Số lượng:</p>
            <input onchange="checkQty(this.value, 1)" class="txt_field_haft" type="number" name="qty1" disabled="true"  required="true" />
        </div>

        <div id="search_result1" class="search_result_class">
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

        </div>

    </div>
@endif