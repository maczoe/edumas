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
    {!! Form::open(['method' => 'POST', 'url' => route('payments.do'), 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('establishment', $establishment) !!}
    {!! Form::hidden('student', $student->id) !!}
    <div class="box-header with-border">
        <h3 class="box-title">Realizar pago de mensualidad</h3>
    </div>
    @if($details)
    <div class="box-body">
        <table class="table table-striped">
            <tr>
                <th>Grado/Detalle</th>
                <th>Fecha de Pago</th>
                <th>Mora</th>
                <th>Monto</th>
            </tr>
            <?php $i = 0; ?>
            @foreach($details as $detail)
            <tr>
                {!! Form::hidden('id_'.$i, $detail['id']) !!}
                <td>
                    {!! Form::text('subject_'.$i, $detail['subject'], ['class'=>'form-control']) !!}
                </td>
                <td>
                    {!! Form::text('date_'.$i, $detail['date']->format('d/m/Y'), ['class'=>'form-control']) !!}
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon"><strong>Q</strong></span>
                    {!! Form::number('fault_'.$i, $detail['fault'], ['class'=>'form-control fault']) !!}
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <span class="input-group-addon"><strong>Q</strong></span>
                    {!! Form::number('price_'.$i, $detail['price'], ['class'=>'form-control price']) !!}
                    </div>
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
            {!! Form::hidden('i', $i) !!}
        </table>
        <hr>
        <div class="text-right" style="padding-right: 80px">
            <strong><h4 id="total">Total {{ money_format('Q %i', $total) }}</h4></strong>
        </div>
        <div>
            <div>
                    Observaciones:
            </div>
            <div>
            {!! Form::text('comment', '', ['class'=>'form-control']) !!}
            </div>
        </div>
        <br>
        <div class="row text-center">
            {!! Form::submit('Aceptar', ['class'=>'btn btn-success']) !!} 
        </div>
    </div>
    @else
        <div class="box-body">
            <div class="alert alert-danger">
            No se encontró pago pendiente
            </div>
        </div>
    @endif
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
                    <th>Fecha de pago</th>
                    <th>Observacion</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $pay)
                <tr>
                    <td>{{ $pay->document_series.'-'.$pay->document_number }}</td>
                    <td>{{ $pay->payment_date->format('d/m/Y') }}</td>
                    <td>{{ $pay->date_time->format('d/m/Y h:i A') }}</td>
                    <td>{{ $pay->comment }}</td>
                    <td>{{ $pay->paymentCurrency }}</td>
                    <td>{{ $pay->status }}</td>
                    <td style="width: 100px;">
                        @if($pay->status!='Anulado')
                        <a href="{{ route('payments.reprint', ['id' =>$pay->id]) }}" target="_blank" class="btn btn-block btn-primary"><i class="fa fa-print"></i> Re-imprimir</a>
                        @endif
                    </td>
                    <td style="width: 100px;">
                        @if($pay->status!='Anulado')
                        <a href="{{ route('payments.cancel', ['id' =>$pay->id]) }}" class="btn btn-block btn-danger"><i class="fa fa-undo"></i> Anular</a>
                        @endif
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
            {"targets": [5, 6], "orderable": false, "searchable": false}
        ],
        "order": [[ 2, "desc" ]],
        "language": {
            "url": '{{ asset("/js/datatables/spanish.json") }}'
        },
        "lengthMenu": [10, 20, 50]
    });
    $('.btn-danger').click(function (e) {
        var result = confirm('¿Esta seguro que desea anular este registro?')
        if (!result) {
            e.preventDefault();
        }
    });

    $('.btn-success').click(function (e) {
        var result = confirm('¿Esta seguro que desea procesar el pago al alumno?')
        if (!result) {
            e.preventDefault();
        }
    });
});

function calculeTotal() {
    var sum = 0;
    var price = 0;
    var fault = 0;
    $(".price").each(function() {
        price += +$(this).val();
    });
    $(".fault").each(function() {
        fault += +$(this).val();
    });
    sum = price + fault;
    $("#total").html("Total Q "+parseFloat(sum).toFixed(2));
}

$(document).on("change", ".price", function() {
    calculeTotal();
});

$(document).on("change", ".fault", function() {
    calculeTotal();
});

$('#alert').delay(3000).slideUp(300);
</script>
@endsection