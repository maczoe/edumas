@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Inscripción de alumnos
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Asignación de curso
@endsection

@section('main-content')
<!-- Datos del alumno -->
{!! Form::open(['method' => 'POST', 'url' => route('registration2'), 'class' => 'form-horizontal']) !!}
<!-- Asignación de curso -->
<div id="box2" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Asignación de curso (Paso 2 de 3)</h3>
    </div>
    @include('partials/errors')
    <div class="box-body">
        <h4><i class='glyphicon glyphicon-user'></i>&nbsp;Asignación de curso para el estudiante:</h4>
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
        {!! Form::open(['method' => 'POST', 'url' => route('registration1'), 'class' => 'form-horizontal']) !!}
        <div class="row">
            <div class="form-group col-md-12">
            {!! Form::label('establishment', 'Establecimiento', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('establishment', $establishments, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'placeholder' => 'Seleccione un establecimiento']) !!}
            </div>
            </div>
        </div>
        <div id="grades" class="row" hidden>
            <div class="form-group col-md-12">
            {!! Form::label('grade', 'Grado', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('grade', $grades, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'placeholder' => 'Seleccione un grado']) !!}
            </div>
            </div>
        </div>
        <div id="groups" class="row" hidden>
            <div class="form-group col-md-12">
            {!! Form::label('group', 'Grupo', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('group', [], null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'placeholder' => 'Seleccione un grupo']) !!}
            </div>
            </div>
        </div>
        <div id="periods_" class="row" hidden>
            <div class="form-group col-md-12">
            {!! Form::label('period', 'Ciclo Escolar', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('period', [], null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'placeholder' => 'Seleccione un ciclo escolar']) !!}
            </div>
            </div>
        </div>
        <div id="subjects_" class="row" hidden>
            <div class="form-group col-md-12">
            {!! Form::label('subjects', 'Cursos', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('subjects[]', [], null, ['id'=>'subjects', 'class'=>'form-control select2', 'multiple'=>'multiple', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
            </div>
            </div>
        </div>
        <hr>
        <a class="btn btn-default" href="{{ route('registration1') }}">Regresar</a>
        {!! Form::submit('Siguiente', ['class'=>'btn btn-default pull-right']) !!} 
        {!! Form::close() !!}
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
    $("select[name=establishment]").change(function() {
        $("#grades").slideDown();
    });
    $("select[name=grade]").change(function() {
        $.ajax({
            url: '{{ route('api_get_groups') }}',
            method: 'GET',
            data: {grade : $('select[name=grade] option:selected').val()},
            success: function(data) {
                $("#groups").slideDown(); 
                $('select[name=group]').empty();
                $('select[name=group]').append($('<option>').text("Seleccione un grupo").attr('value', null));
                $.each(data.groups, function(key, value) {
                $('select[name=group]').append($('<option>').text(value).attr('value', key));
                });
        }
        });
    });
    $("select[name=group]").change(function() {
        $.ajax({
            url: '{{ route('api_get_periods') }}',
            method: 'GET',
            success: function(data) {
                $("#periods_").slideDown(); 
                $('#period').empty();
                $('select[name=period]').append($('<option>').text("Seleccione un grupo").attr('value', null));
                $.each(data.periods, function(key, value) {
                $('#period').append($('<option>').text(value).attr('value', key));
                });
        }
        });
    });
    $("select[name=period]").change(function() {
        $.ajax({
            url: '{{ route('api_get_subjects') }}',
            method: 'GET',
            data: {
                group : $('select[name=group] option:selected').val(),
                establishment : $('select[name=establishment] option:selected').val()
            },
            success: function(data) {
                $("#subjects_").slideDown(); 
                $('#subjects').empty();
                $.each(data.subjects, function(key, value) {
                $('#subjects').append($('<option>').text(value).attr('value', key));
                });
        }
        });
    });
});
</script>
@endsection