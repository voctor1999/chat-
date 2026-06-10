@foreach(['success','danger','warning','info'] as $msg)
@if(session()->has($msg))
<div class="alert alert-{{$msg}}" role="alert">
    <i class="fa-solid fa-bullhorn"></i>
    {{session()->get($msg)}}

</div>
@endif
@endforeach