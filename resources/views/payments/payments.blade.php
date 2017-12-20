@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Pagos de mensualidades
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Pagos de alumno
@endsection

@section('main-content')
@include('partials/errors')
@include('partials/success')
<!-- Datos del alumno -->
{!! Form::open(['method' => 'POST', 'url' => route('payments'), 'class' => 'form-horizontal']) !!}
<div id="box1" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Consultar pagos del alumno</h3>
    </div>
    <div class="box-body">
        <div id="search_student">
            <br>
            {!! Form::select('student', $students, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
        </div>
        <hr>
        {!! Form::submit('Buscar', ['class'=>'btn btn-primary pull-right']) !!} 
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('scripts')
@section('custom_scripts')
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/select2/es.js") }}" type="text/javascript"></script>

<script>
$('#alert').delay(3000).slideUp(300);
$(document).ready(function () {
    $(".select2").select2();
});
</script>
@endsection