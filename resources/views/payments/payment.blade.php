@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Pagos de mensualidades
@endsection

@section('styles')
<link href="{{ asset("/css/datatables.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Pagos de alumno
@endsection

@section('main-content')
<!-- Datos del alumno -->
<div id="box1" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Datos del alumno</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-2">
                    Carnet:
                </div>
                <div class="col-lg-10">
                    {{ $student->id_number }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-2">
                    Nombre:
                </div>
                <div class="col-lg-10">
                    {{ $student->full_name }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="col-sm-2">
                    Direcci&oacute;n:
                </div>
                <div class="col-lg-10">
                    {{ $student->address }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="box2" class="box box-primary">
    {!! Form::open(['method' => 'POST', 'url' => route('payments'), 'class' => 'form-horizontal']) !!}
    <div class="box-header with-border">
        <h3 class="box-title">Realizar pago de mensualidad</h3>
    </div>
    <div class="box-body">
        <table class="table table-striped">
            <tr>
                <th>Curso</th>
                <th>Fecha de Pago</th>
                <th>Mora</th>
                <th>Monto</th>
            </tr>
            <tr>
                <td>Operador en Computadoras</td>
                <td>01/07/2017</td>
                <td>Q 0.00</td>
                <td>Q 500.00</td>
            </tr>
        </table>
        <hr>
        <div class="text-right" style="padding-right: 80px">
            <h4><strong>Total</strong> Q 500.00</h4>
        </div>
        <div class="row text-center">
            <a class="btn btn-success" href="{{ route('payments.do') }}">Aceptar</a>
        </div>
    </div>
    {!! Form::close() !!}
</div>
<div id="box3" class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Historial de pagos</h3>
    </div>
    <div class="box-body table-responsive">
        <table id="payments" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No. Recibo</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th >Acciones</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $pay)
                <tr>
                    <td>{{ $pay->document_series.'-'.$pay->document_number }}</td>
                    <td>{{ $pay->date_time->format('d/m/Y h:i A') }}</td>
                    <td>{{ $pay->paymentCurrency }}</td>
                    <td style="width: 100px;">
                        <a href="{{ route('payments.reprint', ['id' =>$pay->id]) }}" target="_blank" class="btn btn-block btn-primary"><i class="fa fa-print"></i> Re-imprimir</a>
                    </td>
                    <td style="width: 100px;">
                        <a href="{{ route('payments.cancel', ['id' =>$pay->id]) }}" class="btn btn-block btn-danger"><i class="fa fa-undo"></i> Anular</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('payments') }}">Regresar</a>
    </div>
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/datatables/datatables.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/jquery.slimscroll.min.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $('#payments').DataTable({
        "columnDefs": [
            {"targets": [3, 4], "orderable": false, "searchable": false}
        ],
        "language": {
            "url": '{{ asset("/js/datatables/spanish.json") }}'
        },
        "lengthMenu": [10, 20, 50]
    });
});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection