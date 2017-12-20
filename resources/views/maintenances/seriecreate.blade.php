@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear Serie
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    crea una nueva serie
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos de la serie:</h3>
    </div>
    @include('partials/errors')
    @include('partials/success')
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($serie, ['method' => 'POST', 'route' => array('series.store'), 'class' => 'form-horizontal']) !!}
    <div class="box-body ">
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('serie', 'Serie', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('serie', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('establishment_id', 'Estableci- miento', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('establishment_id', $establishments, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('type', 'Tipo', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('type', $types, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('min', 'Inicio', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::number('min', null, ['class'=>'form-control', 'min'=>1]) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('max', 'Final', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::number('max', null, ['class'=>'form-control', 'min'=>1]) !!}
                </div>
            </div>
        </div>
    </div>            
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('series.index') }}">Regresar</a>
        {!! Form::submit('Guardar', ['class'=>'btn btn-primary pull-right']) !!} 
    </div>
    <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $(".select2").select2();
    $(":input").click(function () {
        $(this).select();
    });
    $('#serie').focus();
});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection