@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear Clase
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/bootstrap-timepicker.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    crea una nueva clase
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Datos de la clase</h3>
    </div>

    @include('partials/errors')
    @include('partials/success')
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($class, ['method' => 'POST', 'route' => array('classes.store'), 'class' => 'form-horizontal']) !!}
    <div class="box-body ">
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('subject_id', 'Curso', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('subject_id', $subjects, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('teacher_id', 'Profesor', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('teacher_id', $teachers, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('group_id', 'Grupo', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('group_id', $groups, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="bootstrap-timepicker">
                    {!! Form::label('start_time', 'Hora inicio', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        <div class="input-group">
                            {!! Form::text('start_time', $class->start_time, ['class'=>'form-control timepicker', 'id' => 'start_time']) !!}
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="bootstrap-timepicker">
                    {!! Form::label('end_time', 'Hora final', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        <div class="input-group">
                            {!! Form::text('end_time', $class->end_time, ['class'=>'form-control timepicker', 'id' => 'end_time']) !!}
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                {!! Form::label('establishment_id', 'Establecimiento', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('establishment_id', $establishments, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('classes.index') }}">Cancelar</a>
        {!! Form::submit('Guardar', ['class'=>'btn btn-primary pull-right']) !!} 
    </div>
    <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/select2/es.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-timepicker.min.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $(":input").click(function () {
        $(this).select();
    });
    $(".select2").select2();
    $('#section').focus();
});
//Timepicker
$(".timepicker").timepicker({
    showInputs: false
});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection