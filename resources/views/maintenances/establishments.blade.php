@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Mantenimiento de Establecimientos
@endsection

@section('contentheader_title')
    Crear, Eliminar o Modificar Establecimientos
@endsection

@section('styles')
<link href="{{ asset("/css/datatables.min.css") }}" rel="stylesheet" />
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Establecimientos</h3>
                <a href="{{ route('establishments.create') }}" class="btn btn-success" style='margin-left: 20px;'><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            @include('partials/errors')
            @include('partials/success')
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="establishments" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th >Acciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($establishments as $establishment)
                        <tr>
                            <td><a href="{{ route('establishments.show', $establishment->id) }}">{{ $establishment->id_number }}</a></td>
                            <td>{{ $establishment->name }}</td>
                            <td>{{ $establishment->phone_number }}</td>
                            <td>{{ $establishment->address }}</td>
                            <td>
                                <a href="{{ route('establishments.edit', $establishment->id) }}" class="btn btn-block btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                            </td>
                            <td>
                                {{ Form::open(array('method'=>'DELETE', 'route'=>array('establishments.destroy', $establishment->id))) }}
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
    $('#establishments').DataTable({
        "columnDefs": [
            {"targets": [4, 5], "orderable": false, "searchable": false}
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