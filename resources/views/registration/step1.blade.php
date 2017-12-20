@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Inscripción de alumnos
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/daterangepicker.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/bootstrap-datepicker3.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Selección de alumno
@endsection

@section('main-content')
<!-- Datos del alumno -->
{!! Form::open(['method' => 'POST', 'url' => route('registration1'), 'class' => 'form-horizontal']) !!}
<div id="box1" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del alumno (Paso 1 de 3)</h3>
    </div>
    @include('partials/errors')
    <div class="box-body">
        <div>
            <label class="radio-inline">{{ Form::radio('student_option', 'new', $student_option=='new') }} Nuevo Alumno</label>
            <label class="radio-inline">{{ Form::radio('student_option', 'old', $student_option=='old') }} Alumno existente</label>
        </div>
        <div id="search_student">
            <br>
            {!! Form::select('student', $students, $student->id, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
        </div>
        <div id="new_student">
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
                        {!! Form::text('id_number', $student->id_number, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('first_name', 'Nombre', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('first_name', $student->first_name, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('last_name', 'Apellido', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('last_name', $student->last_name, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('phone_number', 'Teléfono', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('phone_number', $student->phone_number, ['class'=>'form-control', 'data-inputmask'=>"'mask': '9999-9999'", 'data-mask']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('cellphone_number', 'Celular', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('cellphone_number', $student->cellphone_number, ['class'=>'form-control', 'data-inputmask'=>"'mask': '9999-9999'", 'data-mask']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label('address', 'Dirección', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::text('address', $student->address, ['class'=>'form-control']) !!}
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
                        {!! Form::text('comment', $student->comment, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    {!! Form::label('gender', 'Género', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        <label>{!! Form::radio('gender', 'M', $student->gender=='M') !!} Masculino</label>    
                        <label>{!! Form::radio('gender', 'F', $student->gender=='F', ['style'=>'margin-left: 20px;']) !!} Femenino</label>
                    </div>
                </div>
            </div>   
        </div>
        <hr>
        {!! Form::submit('Siguiente', ['class'=>'btn btn-default pull-right']) !!} 
    </div>
</div>
{!! Form::close() !!}
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/select2/es.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-datepicker.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/bootstrap-datepicker.es.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/daterangepicker.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/inputmask/jquery.inputmask.bundle.min.js") }}" type="text/javascript"></script>

<script>
$('#alert').delay(3000).slideUp(300);
$(document).ready(function () {
    $(".select2").select2( { language: "es" });
    
    if ($("input[name='student_option']:checked").val() === 'old') {
        $('#new_student').hide();
        $('#search_student').show("slow");
    } else if($("input[name='student_option']:checked").val() === 'new') {
        $('#new_student').show("slow");
        $('#search_student').hide();
    }
    else {
        $('#new_student').hide();
        $('#search_student').hide();
    }
    //Date picker
    $('#birth_date').datepicker({
        'autoclose': true,
        'format': 'dd/mm/yyyy',
        'language': 'es'
    });
    $(":input").inputmask();
});
$("input[name='student_option']").change(function () {
    if ($(this).val() === 'old') {
        $('#new_student').hide();
        $('#search_student').show("slow");
    } else {
        $('#new_student').show("slow");
        $('#search_student').hide();
    }
});
</script>

@endsection