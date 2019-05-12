@extends('admin.templates.master')
@section('title')
Trang quản trị
@stop

@section('css')
style_index.css
@stop

@section('content')
<div class="content">
    <h1>Errors</h1>

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
    
    Có gì đó sai!!!
</div>
<div class="clr"></div>
@stop
