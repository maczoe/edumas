
@if (count($errors) > 0)
    <div class="alert alert-danger">
        Se encontraron los siguientes errores:<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif