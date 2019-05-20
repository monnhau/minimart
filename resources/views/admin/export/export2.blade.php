@extends('admin.templates.master')

@section('title')
Xuất hàng
@stop

@section('css')
style_export.css
@stop

@section('export')
active
@stop

@section('css2')
<link rel="stylesheet" type="text/css" href="{{$AdminResUrl}}css/style_cat.css">
<script type="text/javascript"  src="{{$AdminResUrl}}js/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('content')

<div class="content">
    <h1>Xuất hàng(sản phẩm)</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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

    <button onclick="return ajaxThemDong()" class="btn_add_export">+</button>
    <button onclick="return ajaxXoaDong()" class="btn_sub_export">-</button>
    <hr style="display: inline-block;">


    <form action="{{route('admin.export.export')}}" method="post">
        {{csrf_field()}}
        <div id="nhieu_sp">
            <div class="mot_sp">
                <div id="msg1" class="msg_export"></div>

                <div class="div_ma">
                    <p class="label_input label_bold">Mã sản phẩm 1:</p>
                    <input  onchange="searchProduct(this.value, 1)" type="number" name="id_batch1" class="txt_field_haft" min="0" required />

                </div>
                
                <div class="div_soluong">
                    <p class="label_input">Số lượng:</p>
                    <input onchange="checkQty(this.value, 1)" type="number" name="qty1" class="txt_field_haft" min="0" required disabled="true"/>
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

        </div>

        <div id="soDongDiv">
            <input type="hidden" name="soDong" id="soDong" value="1">
        </div>

        <script type="text/javascript">
            function searchProduct(idBatch, stt){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            
                $.ajax({
                    url: '{{route('admin.export.ajaxSearchProductByIdBatch')}}',
                    type: 'post',
                    cache: false,
                    data: {idBatch:idBatch, stt:stt},
                    success: function(data){
                            $('#search_result'+stt).html(data);
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                });
                return false;
            }

            function checkQty(qty, stt){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var inputName = 'id_batch'+stt;
                var idBatch = document.getElementsByName(inputName+"")[0].value;
                if(idBatch == null || idBatch == '') {
                    var html = '<p class="msg_err">'+'Vui lòng nhập Mã sản phẩm '+stt+'!'+'<p>';
                    $('#msg'+stt).html(html);
                    return false;
                }
            
                $.ajax({
                    url: '{{route('admin.export.ajaxCheckQtyByIdBatch')}}',
                    type: 'post',
                    cache: false,
                    data: {qty:qty,idBatch:idBatch,stt:stt},
                    success: function(data){                  
                            $('#msg'+stt).html(data);
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                });

                return false;

            }
        </script>
        <!-- <div class="clr"></div> -->

        <input type="submit" name="submit" value="Xuất" class="button btn_submit">

    </form>


    
</div>


<div class="clr"></div>

<script type="text/javascript">
    
    function ajaxThemDong(){
        var soDong = document.getElementById('soDong').value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: '{{route('admin.export.ajaxThemDong')}}',
            type: 'post',
            cache: false,
            data: {soDong:soDong},
            success: function(data){
                if(soDong > 0 && soDong < 100){
                    var soDongMoi = parseInt(soDong) + 1;
                    document.getElementById("soDong").value = soDongMoi+'';
                }

                $('#nhieu_sp').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });

        return false;
    }

    function ajaxXoaDong(){
        var soDong = document.getElementById('soDong').value;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        $.ajax({
            url: '{{route('admin.export.ajaxXoaDong')}}',
            type: 'post',
            cache: false,
            data: {soDong:soDong},
            success: function(data){
                if(soDong > 1 && soDong < 100){
                    var soDongMoi = parseInt(soDong) - 1;
                    document.getElementById("soDong").value = soDongMoi+'';
                } 
                $('#nhieu_sp').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });

        return false;
    }
</script>
@stop