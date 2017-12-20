@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Inscripción de alumnos
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Asignación de pago
@endsection

@section('main-content')
<!-- Datos del alumno -->
{!! Form::open(['method' => 'POST', 'url' => route('registration3'), 'class' => 'form-horizontal']) !!}
<!-- Pago -->
<div id="box3" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Pago de inscripción (Paso 3 de 3)</h3>
    </div>
    @include('partials/errors')
    <div class="box-body">
        <h4><i class='glyphicon glyphicon-user'></i>&nbsp;Asignación de plan de pagos para el estudiante:</h4>
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
        <h4 class="box-title">Cuota de inscripci&oacute;n:</h4>
        <br>
        <div class="row">
            <div class="form-group col-md-12">
                {!! Form::label('registration', 'Inscripción', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('registration', $registrations, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'placeholder' => 'Seleccione una cuota de inscripción']) !!}
                </div>
            </div>
        </div>
        <hr>
        <h4 class="box-title">Planes de pago por curso:</h4>
        <br>
        @foreach($plans as $subject => $plan)
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-10">
                    <i class='glyphicon glyphicon-usd'></i>
                    <strong>Curso: {{ key($plan) }}</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                {!! Form::label('plan_'.$subject, 'Plan de pago', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('subject_'.$subject, array_values($plan)[0], null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'placeholder' => 'Seleccione un plan de pago']) !!}
                </div>
            </div>
        </div>
        <br>
        @endforeach
        <hr>
        <a class="btn btn-default" href="{{ route('registration2') }}">Regresar</a>
        {!! Form::submit('Finalizar', ['class'=>'btn btn-primary pull-right']) !!} 
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