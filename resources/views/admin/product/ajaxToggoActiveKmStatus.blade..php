@if($presentStatus == 1)
<img onclick="return ajaxToggoActiveKmStatus(0,{{$id}})" class="toggle_img" src="{{$AdminResUrl}}/images/off.png"/>
@else
<img onclick="return ajaxToggoActiveKmStatus(1,{{$id}})" class="toggle_img" src="{{$AdminResUrl}}/images/on.png"/>
@endif