@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Datos de la Serie
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Muestra los datos de la serie
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos de la serie: {{ $serie->serie }}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($serie, ['class' => 'form-horizontal']) !!}
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
                    {!! Form::text('serie', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('establishment_id', 'Estableci- miento', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('establishment_id', $establishments, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('type', 'Tipo', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('type', $types, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;', 'disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('min', 'Inicio', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::number('min', null, ['class'=>'form-control', 'min'=>1, 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('max', 'Final', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::number('max', null, ['class'=>'form-control', 'min'=>1, 'disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-lg-10">
                    <label class="control-label">
                        {!! Form::checkbox('enabled', 1, null, ['disabled']) !!}
                        Activa
                    </label>  
                </div>
            </div>  
        </div>
    </div>            
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('series.index') }}">Regresar</a>
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
});
</script>
@endsection