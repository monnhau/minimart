@if($presentStatus == 1)
    @php
    $msg = 'Thông tin khuyến mãi hiện tại của sản phẩm "'.$name.'" là: <p>'.$km_text.'</p> <br>Bạn chắc chắn muốn tắt chương trình khuyến mãi của sản phẩm này?';
    @endphp
    <script type="text/javascript">
        Confirm('Xác nhận', '{!!$msg!!}', 'OK', 'Hủy', '{{route('admin.product.toggoActiveKmStatus', ['presentStatus'=>$presentStatus, 'id'=>$id])}}');
    </script>
@elseif($presentStatus == 0)
    @if($km_text == null)
        @php
        $msg = 'Thông tin khuyến mãi hiện tại của sản phẩm "'.$name.'" hiện không có.<br> Bạn không thể bật chương trình khuyến mãi, mà không có thông tin khuyến mãi.<br><br> Vui lòng thêm thông tin khuyến mãi cho sản phẩm ở mục SỬA, và thử lại!';
        @endphp
        <script type="text/javascript">
            PopupText('Thông báo', '{!!$msg!!}', 'Đóng');
        </script>
    @else
        @php
        $msg = 'Thông tin khuyến mãi hiện tại của sản phẩm "'.$name.'" là:<p>'.$km_text.'</p> <br>Bạn chắc chắn muốn bật chương trình khuyến mãi của sản phẩm này?';
        @endphp
        <script type="text/javascript">
            Confirm('Xác nhận', '{!!$msg!!}', 'OK', 'Hủy', '{{route('admin.product.toggoActiveKmStatus', ['presentStatus'=>$presentStatus, 'id'=>$id])}}');
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