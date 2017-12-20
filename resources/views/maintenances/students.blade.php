@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Mantenimiento de Alumnos
@endsection

@section('styles')
<link href="{{ asset("/css/datatables.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Crear, Eliminar o Modificar Alumnos
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Alumnos</h3>
                <a href="{{ route('students.create') }}" class="btn btn-success" style='margin-left: 20px;'><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            @include('partials/errors')
            @include('partials/success')
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="students" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Carnet</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Teléfono</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th >Acciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td><a href="{{ route('students.show', $student->id) }}">{{ $student->id_number }}</a></td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name }}</td>
                            <td>{{ $student->phone_number }}</td>
                            <td>{{ $student->cellphone_number }}</td>
                            <td>{{ $student->address }}</td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-block btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                            </td>
                            <td>
                                {{ Form::open(array('method'=>'DELETE', 'route'=>array('students.destroy', $student->id))) }}
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
    $('#students').DataTable({
        "columnDefs": [
            {"targets": [6, 7], "orderable": false, "searchable": false}
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