@if($presentStatus == 1)
    @php
    $price_si_fm = number_format($price_si,0).'('.$TienTe.') /'.$unit_si_int.' '.$unit_le_char;
    $msg = 'Giá sĩ hiện tại của sản phẩm "'.$name.'" là: <p>'.$price_si_fm.'</p> <br>Bạn chắc chắn muốn tắt chương trình bán sĩ của sản phẩm này?';
    @endphp
    <script type="text/javascript">
        Confirm('Xác nhận', '{!!$msg!!}', 'OK', 'Hủy', '{{route('admin.product.toggoActivePriceStatus', ['presentStatus'=>$presentStatus, 'id'=>$id])}}');
    </script>
@elseif($presentStatus == 0)
    @if($price_si == null)
        @php
        $msg = 'Thông tin bán sĩ hiện tại của sản phẩm "'.$name.'" hiện không có.<br> Bạn không thể bật chương trình bán sĩ, mà không có giá bán sĩ kèm theo.<br><br> Vui lòng thêm giá bán sĩ cho sản phẩm ở mục SỬA, và thử lại!';
        @endphp
        <script type="text/javascript">
            PopupText('Thông báo', '{!!$msg!!}', 'Đóng');
        </script>
    @else
        @php
        $price_si_fm = number_format($price_si,0).'('.$TienTe.') /'.$unit_si_int.' '.$unit_le_char;
        $msg = 'Thông tin bán sĩ hiện tại của sản phẩm "'.$name.'" là:<p>'.$price_si_fm.'</p> <br>Bạn chắc chắn muốn bật chương trình bán sĩ của sản phẩm này?';
        @endphp
        <script type="text/javascript">
            Confirm('Xác nhận', '{!!$msg!!}', 'OK', 'Hủy', '{{route('admin.product.toggoActivePriceStatus', ['presentStatus'=>$presentStatus, 'id'=>$id])}}');
        </script>
    @endif
@else
    @php
    $msg = 'Error';
    @endphp
    <script type="text/javascript">
        PopupText('Thông báo', '{!!$msg!!}', 'Đóng');
    </script>
@endif