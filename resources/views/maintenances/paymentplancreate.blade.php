@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Crear Plan de Pago
@endsection

@section('styles')
<link href="{{ asset("/css/select2.min.css") }}" rel="stylesheet" />
<link href="{{ asset("/css/spinner.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    crea un nuevo plan de pago
@endsection

@section('main-content')
<!-- Horizontal Form -->
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del Plan de Pago</h3>
    </div>

    @include('partials/errors')
    @include('partials/success')
    <!-- /.box-header -->
    <!-- form start -->
    {!! Form::model($plan, ['method' => 'POST', 'route' => array('payment_plans.store'), 'class' => 'form-horizontal']) !!}
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
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('grade_id', 'Grado', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('grade_id', $grades, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('establishment_id', 'Estable-cimiento', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-10">
                    {!! Form::select('establishment_id', $establishments, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('subject_id', 'Curso', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::select('subject_id', $subjects, null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                </div>
            </div>
            <div class="form-group col-md-6">
                    {!! Form::label('period', 'Periodo', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        {!! Form::select('period', ['monthly' => 'Mensual', 'total' => 'Total', 'registration' => 'Inscripción'], null, ['class'=>'form-control select2', 'aria-hidden'=>'true', 'style' =>'width: 100%;']) !!}
                    </div>
                    <!-- /.input group -->
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {!! Form::label('price', 'Precio', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    <div class="input-group">
                        <span class="input-group-addon"><strong>Q</strong></span>
                    {!! Form::number('price', 0.00, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('fault', 'Mora', ['class'=>'col-sm-2 control-label', 'min'=>0, 'step'=>'any']) !!}
                <div class="col-lg-10">
                    <div class="input-group">
                        <span class="input-group-addon"><strong>Q</strong></span>
                    {!! Form::number('fault', 0.00, ['class'=>'form-control', 'min'=>0, 'step'=>'any']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                    {!! Form::label('pay_day', 'Día de pago', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-lg-10">
                        <div class="input-group number-spinner">
                        <span class="input-group-btn data-dwn">
                            <button type="button" class="btn btn-default btn-info" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                        </span>
                        {!! Form::text('pay_day', "1", ['class'=>'form-control text-center', 'min'=>'1', 'max'=>'28']) !!}
                        <span class="input-group-btn data-up">
                            <button type="button" class="btn btn-default btn-info" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                        </span>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('comment', 'Comentarios', ['class'=>'col-sm-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::textarea('comment', null, ['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('payment_plans.index') }}">Cancelar</a>
        {!! Form::submit('Guardar', ['class'=>'btn btn-primary pull-right']) !!} 
    </div>
    <!-- /.box-footer -->
    {!! Form::close() !!}
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/select2/select2.full.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/select2/es.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/spinner.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/inputmask/jquery.inputmask.bundle.min.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $(":input").click(function () {
        $(this).select();
    });
    $(":input").inputmask();
    $("#establishment_id, #period").select2();
    $("#subject_id, #grade_id").select2({
        allowClear : true,
        placeholder : "Todos"
    });
    $('#section').focus();
});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection