@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Datos del Grado
@endsection

@section('contentheader_title')
    Muestra los datos del grado
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del grado {{ $grade->name }}:</h3>
    </div>

    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($grade, ['method' => 'POST', 'route' => array('grades.update', $grade->id), 'class' => 'form-horizontal']) !!}
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
                        {!! Form::text('name', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
            </div>
           
            
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default" href="{{ route('grades.index') }}">Cancelar</a>
        </div>
        <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection