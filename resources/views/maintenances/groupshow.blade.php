@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Datos del Grupo
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/daterangepicker.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/bootstrap-datepicker3.min.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/bootstrap-timepicker.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Muestra los datos del grupo
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del grupo {{ $group->name }}:</h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($group, ['method' => 'POST', 'route' => array('groups.update', $group->id), 'class' => 'form-horizontal']) !!}
        <div class="box-body ">
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('section', 'Sección', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('section', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('days', 'Días', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('daysWeek[]', ['1' => 'Lunes', '2' => 'Martes', '3' => 'Miércoles', '4' => 'Jueves', '5' => 'Viernes', '6' => 'Sábado', '7' => 'Domingo'], $group->daysWeek, ['class'=>'form-control select2', 'multiple', 'disabled', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('grade', 'Grado', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('grade_id', $grades, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'disabled', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="bootstrap-timepicker">
                    {!! Form::label('start_time', 'Hora inicio', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        <div class="input-group">
                            {!! Form::text('start_time', $group->start_time, ['class'=>'form-control timepicker', 'id' => 'start_time', 'disabled']) !!}
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
                            {!! Form::text('end_time', $group->end_time, ['class'=>'form-control timepicker', 'id' => 'end_time', 'disabled']) !!}
                            <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
    </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default" href="{{ route('groups.index') }}">Cancelar</a>
        </div>
        <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/select2/es.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-timepicker.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-datepicker.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-datepicker.es.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/daterangepicker.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $(".select2").select2();
    $('#start_date').datepicker({
        'autoclose': true,
        'format': 'dd/mm/yyyy',
        'language': 'es'
    });
    $('#end_date').datepicker({
        'autoclose': true,
        'format': 'dd/mm/yyyy',
        'language': 'es'
    });
});
//Timepicker
$(".timepicker").timepicker({
    showInputs: false
});
</script>
@endsection