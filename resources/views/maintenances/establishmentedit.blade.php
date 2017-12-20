@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Editar Establecimiento
@endsection

@section('contentheader_title')
    editar datos del establecimiento
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del establecimiento {{ $establishment->name }}:</h3>
    </div>
    
    @include('partials/errors')
    @include('partials/success')
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($establishment, ['method' => 'PATCH', 'route' => array('establishments.update', $establishment->id), 'class' => 'form-horizontal']) !!}
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
                        {!! Form::text('id_number', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('name', 'Nombre', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('phone_number', 'Teléfono', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('phone_number', null, ['class'=>'form-control', 'data-inputmask'=>"'mask': '9999-9999'", 'data-mask']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('address', 'Dirección', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('address', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                 <div class="form-group col-md-6">
                     {!! Form::label('comment', 'Comentario', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('comment', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default" href="{{ route('establishments.index') }}">Cancelar</a>
            {!! Form::submit('Guardar', ['class'=>'btn btn-primary pull-right']) !!} 
        </div>
        <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/inputmask/jquery.inputmask.bundle.min.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $(":input").inputmask();
    $(":input").click(function() {
       $(this).select(); 
    });
    $('#id_number').focus();
});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection