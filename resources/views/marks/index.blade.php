@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Notas de alumnos
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Notas de alumnos
@endsection

@section('main-content')
@include('partials/errors')
@include('partials/success')
<!-- Datos del alumno -->
<div id="box1" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Administrar notas de alumnos</h3>
    </div>
    <div class="box-body">
        <div id="search_subjects">
            <div id="grades" class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('subject', 'Curso', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::select('subjects', $subjects, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                    </div>
                </div>
            </div>
            <div id="groups" class="row">
                <div class="form-group col-md-12">
                    {!! Form::label('group', 'Grupo', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::select('groups', $groups, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div id="buttons" class="row">
            <div class="col-xs-12">
                <h3>Notas</h3>
                <a class="fa fa-arrow-up btn btn-success pull-right" href="{{ route('marks.export') }}">&nbsp;Exportar</a>
                <input id="file" type="file" style="display: none;"/>
                <button class="fa fa-arrow-down btn btn-warning pull-right" onclick="document.getElementById('file').click();">&nbsp;Importar</button>
            </div>
        </div>
        <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped">
                <tr>
                    <th>Alumno</th>
                    <th>Carnet</th>
                    <th style="width: 30%">Nota</th>
                </tr>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->fullName }}</td>
                    <td>{{ $student->id_number }}</td>
                    <td>{!! Form::number('mark'.$student->id, null, ['class'=>'form-control', 'min'=>1]) !!}</td>
                </tr>
                @endforeach
            </table>
        </div>
        </div>
        <div class="box-footer">
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary pull-right']) !!} 
        </div>
    </div>
    @endsection

@section('custom_scripts')
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>

<script>
$('#alert').delay(3000).slideUp(300);
$(document).ready(function () {
    $(".select2").select2();
});
</script>
@endsection