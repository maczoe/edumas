@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Mantenimiento de Clases
@endsection

@section('styles')
<link href="{{ asset("/css/datatables.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Crear, Eliminar o Modificar Clases
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Clases</h3>
                <a href="{{ route('classes.create') }}" class="btn btn-success" style='margin-left: 20px;'><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            @include('partials/errors')
            @include('partials/success')
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="classes" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Profesor</th>
                            <th>Grupo</th>
                            <th>Establecimiento</th>
                            <th>Hora inicio</th>
                            <th>Hora final</th>
                            <th >Acciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $clas)
                        <tr>
                            <td><a href="{{ route('classes.show', $clas->id) }}">{{ $clas->subject->title }}</a></td>
                            <td>{{ $clas->teacher->fullname }}</td>
                            <td>{{ $clas->group->name }}</td>
                            <td>{{ $clas->establishment->name }}</td>
                            <td>{{ $clas->start_time }}</td>
                            <td>{{ $clas->end_time }}</td>
                            <td style="width: 100px;">
                                <a href="{{ route('classes.edit', $clas->id) }}" class="btn btn-block btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                            </td>
                            <td style="width: 100px;">
                                {{ Form::open(array('method'=>'DELETE', 'route'=>array('classes.destroy', $clas->id))) }}
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