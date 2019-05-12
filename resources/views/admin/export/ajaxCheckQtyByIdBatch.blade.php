
@if($err == 'false1')
    <p class="msg_err">Mã sản phẩm {{$stt}} không tìm thấy!<p>'
@elseif($err == 'false2')
    <p class="msg_err">Sản phẩm {{$stt}} không còn hàng để bán!<p>'
@elseif($err == 'false3')
    <p class="msg_err">Sản phẩm {{$stt}} không đủ số lượng hàng để bán! Trong kho chỉ còn {{$qtyBatch}} sản phẩm.<p>
@else

@endif

