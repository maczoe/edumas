@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Datos del Establecimiento
@endsection

@section('contentheader_title')
    Muestra los datos del establecimiento
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del establecimiento {{ $establishment->name }}:</h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($establishment, ['method' => 'POST', 'route' => array('maintenances.establishments.update', $establishment->id), 'class' => 'form-horizontal']) !!}
        <div class="box-body ">
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('id_number', 'Código', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('id_number', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('name', 'Nombre', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('name', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('phone_number', 'Teléfono', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('phone_number', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('address', 'Dirección', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('address', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
                 <div class="form-group col-md-6">
                     {!! Form::label('comment', 'Comentario', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('comment', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default" href="{{ route('maintenances.establishments.index') }}">Cancelar</a>
        </div>
        <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection