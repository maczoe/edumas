@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Datos del Curso
@endsection

@section('styles')
<link href="{{ asset("/css/spinner.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Muestra los datos del curso
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del curso {{ $subject->title }}:</h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($subject, ['method' => 'POST', 'route' => array('subjects.update', $subject->id), 'class' => 'form-horizontal']) !!}
    <div class="box-body ">
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('title', 'Nombre', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('title', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('comment', 'Descripción', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('comment', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('min_mark', 'Nota Aprobación', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    <div class="input-group number-spinner">
                        <span class="input-group-btn data-dwn">
                            <button type="button" disabled class="btn btn-default btn-info" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                        {!! Form::text('min_mark', null, ['class'=>'form-control text-center', 'disabled', 'min=0', 'max=100']) !!}
                        <span class="input-group-btn data-up">
                            <button type="button" disabled class="btn btn-default btn-info" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="form-group col-md-6">
            {!! Form::label('grade_id', 'Grado', ['class'=>'col-sm-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::select('grade_id', $grades, null, ['class'=>'form-control', 'aria-hidden'=>'true', 'disabled']) !!}
            </div>
        </div>
    </div>    
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('subjects.index') }}">Cancelar</a>
    </div>
    <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/spinner.js") }}" type="text/javascript"></script>
@endsection