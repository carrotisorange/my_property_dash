@foreach (['danger', 'warning', 'success', 'info'] as $key)
@if(Session::has($key))
<div class="col-md-5 p-0 m-0 mx-auto">
    <div class="alert alert-{{ $key }} alert-dismissable custom-{{ $key }}-box">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong> <i class="fas fa-check-square"></i>  {{ Session::get($key) }}</strong>
     </div>
</div>
@endif
@endforeach