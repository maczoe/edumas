@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Datos del Producto
@endsection

@section('contentheader_title')
    Muestra los datos del producto
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del producto: {{ $product->name }}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($product, ['class' => 'form-horizontal']) !!}
    <div class="box-body ">
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('code', 'Código', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('code', null, ['class'=>'form-control', 'disabled']) !!}
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
                {!! Form::label('barcode', 'Código de barras', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('barcode', null, ['class'=>'form-control', 'disabled']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('cost', 'Costo', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    <div class="input-group">
                        <span class="input-group-addon"><strong>Q</strong></span>
                        {!! Form::number('cost', null, ['class'=>'form-control', 'min'=>0, 'step'=>'any', 'disabled']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('price', 'Precio', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    <div class="input-group">
                        <span class="input-group-addon"><strong>Q</strong></span>
                        {!! Form::number('price', null, ['class'=>'form-control', 'min'=>0, 'step'=>'any', 'disabled']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('products.index') }}">Regresar</a>
    </div>
    <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection