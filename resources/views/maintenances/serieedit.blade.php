@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Editar serie
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Edita los datos de una serie
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos de la serie: {{ $serie->serie }}</h3>
    </div>

    @include('partials/errors')
    @include('partials/success')
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($serie, ['method' => 'PATCH', 'route' => array('series.update', $serie->id), 'class' => 'form-horizontal']) !!}
    <div class="box-body ">
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', $serie->id, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('serie', 'Serie', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('serie', $serie->serie, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('establishment_id', 'Estableci- miento', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('establishment_id', $establishments, $serie->establishment, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('type', 'Tipo', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('type', $types, $serie->type, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('min', 'Inicio', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::number('min', $serie->min, ['class'=>'form-control', 'min'=>1,'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('max', 'Final', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::number('max', $serie->max, ['class'=>'form-control', 'min'=>1]) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-lg-10">
                    <label class="control-label">
                        {!! Form::checkbox('enabled', $serie->enabled, $serie->enabled==1) !!}
                        Activa
                    </label>  
                </div>
            </div>  
        </div>
    </div>            
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('series.index') }}">Cancelar</a>
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