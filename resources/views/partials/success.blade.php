@if(Session::has('alert'))
    <p id="alert" class="alert alert-success">
        {{ Session::get('alert') }}
    </p>
@endif