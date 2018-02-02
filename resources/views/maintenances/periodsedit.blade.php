@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Editar Ciclo Escolar
@endsection

@section('styles')
<link href="{{ asset("/css/daterangepicker.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/bootstrap-datepicker3.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    editar datos del ciclo escolar
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del ciclo escolar {{ $period->name }}:</h3>
    </div>
    
    @include('partials/errors')
    @include('partials/success')
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($period, ['method' => 'PATCH', 'route' => array('periods.update', $period->id), 'class' => 'form-horizontal']) !!}
        <div class="box-body ">
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('name', 'Nombre', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('start_date', 'Fecha inicio', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('start_date', $period->start_date->format('d/m/Y'), ['class'=>'form-control', 'id' => 'start_date']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('end_date', 'Fecha final', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('end_date', $period->end_date->format('d/m/Y'), ['class'=>'form-control', 'id' => 'end_date']) !!}
                </div>
            </div>
        </div>
    </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default" href="{{ route('periods.index') }}">Cancelar</a>
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary pull-right']) !!} 
        </div>
        <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/bootstrap-datepicker.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-datepicker.es.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/daterangepicker.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $(":input").click(function () {
        $(this).select();
    });
    $('#name').focus();
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
$('#alert').delay(3000).slideUp(300);
</script>
@endsection