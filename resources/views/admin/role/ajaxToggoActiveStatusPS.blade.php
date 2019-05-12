@if($presentStatus == 1)
<img onclick="return ajaxToggoActiveStatusPS(0,{{$id}}, '{{$level}}' )" class="toggle_img" src="{{$AdminResUrl}}/images/off.png"/>
@else
<img onclick="return ajaxToggoActiveStatusPS(1,{{$id}}, '{{$level}}' )" class="toggle_img" src="{{$AdminResUrl}}/images/on.png"/>
@endif