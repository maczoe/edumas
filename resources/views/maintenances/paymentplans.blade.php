@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Mantenimiento de Planes de Pago
@endsection

@section('styles')
<link href="{{ asset("/css/datatables.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Crear, Eliminar o Modificar Planes de Pago
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Planes de Pago</h3>
                <a href="{{ route('payment_plans.create') }}" class="btn btn-success" style='margin-left: 20px;'><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            @include('partials/errors')
            @include('partials/success')
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="classes" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Curso</th>
                            <th>Grado</th>
                            <th>Establecimiento</th>
                            <th>Precio</th>
                            <th>Mora</th>
                            <th>D&iacute;a de pago</th>
                            <th >Acciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plans as $plan)
                        <tr>
                            <td><a href="{{ route('payment_plans.show', $plan->id) }}">{{ $plan->name }}</a></td>
                            <td>{{ $plan->subject!= null ? $plan->subject->title : $plan->grade!= null ? $plan->grade->name : '' }}</a></td>
                            <td>{{ $plan->grade!= null ? $plan->grade->name : '' }}</td>
                            <td>{{ $plan->establishment->name }}</td>
                            <td>{{ $plan->priceCurrency }}</td>
                            <td>{{ $plan->faultCurrency }}</td>
                            <td>{{ $plan->pay_day }}</td>
                            <td style="width: 100px;">
                                <a href="{{ route('payment_plans.edit', $plan->id) }}" class="btn btn-block btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                            </td>
                            <td style="width: 100px;">
                                {{ Form::open(array('method'=>'DELETE', 'route'=>array('payment_plans.destroy', $plan->id))) }}
                                <button type="submit" class="btn btn-block btn-danger" id="delete-button"><i class="fa fa-trash "></i> Eliminar</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset("/js/datatables/datatables.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("/js/jquery.slimscroll.min.js") }}" type="text/javascript"></script>

<script>
$(document).ready(function () {
    $('#classes').DataTable({
        "columnDefs": [
            {"targets": [7, 8], "orderable": false, "searchable": false}
        ],
        "language": {
            "url": '{{ asset("/js/datatables/spanish.json") }}'
        },
        "order": [0, "asc"],
        "lengthMenu": [10, 20, 50]
    });
    $('form').submit(function (e) {
        var result = confirm('¿Esta seguro que desea eliminar este registro?')
        if (!result) {
            e.preventDefault();
        }
    });
});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection