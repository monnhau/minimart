@if($presentStatus == 1)
<img onclick="return ajaxToggoActiveStatus(0,{{$id}})" class="toggle_img" src="{{$AdminResUrl}}/images/off.png"/>
@else
<img onclick="return ajaxToggoActiveStatus(1,{{$id}})" class="toggle_img" src="{{$AdminResUrl}}/images/on.png"/>
@endif