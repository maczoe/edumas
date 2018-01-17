@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Editar Estudiante
@endsection

@section('styles')
<link href="{{ asset("/css/daterangepicker.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/bootstrap-datepicker3.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Edita los datos de un estudiante
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del estudiante: {{ $student->first_name." ".$student->last_name }}</h3>
    </div>
    
    @include('partials/errors')
    @include('partials/success')
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($student, ['method' => 'PATCH', 'route' => array('students.update', $student->id), 'class' => 'form-horizontal']) !!}
        <div class="box-body ">
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('id', 'ID', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('id', null, ['class'=>'form-control', 'disabled']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('id_number', 'Carnet', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('id_number', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('first_name', 'Nombre', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('last_name', 'Apellido', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('phone_number', 'Teléfono', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('phone_number', null, ['class'=>'form-control', 'data-inputmask'=>"'mask': '9999-9999'", 'data-mask']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('cellphone_number', 'Celular', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('cellphone_number', null, ['class'=>'form-control', 'data-inputmask'=>"'mask': '9999-9999'", 'data-mask']) !!}
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
                    {!! Form::label('birth_day', 'Fecha Nacimiento', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('birth_date', $student->birth_date->format('d/m/Y'), ['class'=>'form-control', 'id' => 'birth_date']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                     {!! Form::label('comment', 'Comentario', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('gender', 'Género', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        <label>{!! Form::radio('gender', 'M', null) !!} Masculino</label>    
                        <label>{!! Form::radio('gender', 'F', null, ['style'=>'margin-left: 20px;']) !!} Femenino</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <a class="btn btn-default" href="{{ route('students.index') }}">Cancelar</a>
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
<script src="{{ asset("/js/inputmask/jquery.inputmask.bundle.min.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $(":input").inputmask();
    $(":input").click(function() {
       $(this).select(); 
    });
    $('#id_number').focus();
    
    //Date picker
    $('#birth_date').datepicker({
        'autoclose': true,
        'format' : 'dd/mm/yyyy',
        'language' : 'es'
    });

});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection