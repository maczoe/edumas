@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Inscripción de alumnos
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Impresión de recibo
@endsection

@section('main-content')
<!-- Datos del alumno -->
{!! Form::open(['method' => 'POST', 'url' => route('registration4'), 'class' => 'form-horizontal']) !!}
<!-- Pago -->
<div id="box3" class="box box-primary">
    <div class="box-header with-border alert-success">
        <h3 class="box-title">Se realiz&oacute; la inscripci&oacute;n satisfactoriamente</h3>
    </div>
    @include('partials/errors')
    <div class="box-body">
        <h4><i class='glyphicon glyphicon-user'></i>&nbsp;Resumen de inscripci&oacute;n: </h4>
        @if($student->id_number!==null)
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-2">
                    Carnet:
                </div>
                <div class="col-lg-10">
                    {{ $student->id_number }}
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-2">
                    Nombre:
                </div>
                <div class="col-lg-10">
                    {{ $student->full_name }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-2">
                    Direcci&oacute;n:
                </div>
                <div class="col-lg-10">
                    {{ $student->address }}
                </div>
            </div>
        </div>
        <hr>
        <h4 class="box-title"><i class='fa fa-dollar'></i>&nbsp;Pago de inscripci&oacute;n:</h4>
        <br>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-10">
                    <strong>Cuota de incripci&oacute;n: {{ $registration->priceCurrency }}</strong>
                </div>
            </div>
        </div>
        <a class="btn btn-primary center" href="{{ route('print_invoice', ['payment' => $payment]) }}" target="_blank">Imprimir recibo</a>
        <hr>
        <h4 class="box-title"><i class='fa fa-pencil-square'></i>&nbsp;Cursos asignados:</h4>
        <br>
        @foreach($classes as $class)
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-10">
                    <strong>Curso: {{ $class->subject->title }}</strong>
                </div>
            </div>
        </div>
        @endforeach
        <hr>
        <a class="btn btn-default" href="{{ route('registration1') }}">Inicio</a>
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('custom_scripts')
<!-- Select2-->
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/select2/es.js") }}" type="text/javascript"></script>
<script>
$(document).ready(function () {
    $(".select2").select2();
});
</script>
@endsection