@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Mantenimiento de Grupos
@endsection

@section('styles')
<link href="{{ asset("/css/datatables.min.css") }}" rel="stylesheet" />
@endsection

@section('contentheader_title')
    Crear, Eliminar o Modificar Grupos de Estudiantes
@endsection

@section('main-content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Grupos</h3>
                <a href="{{ route('groups.create') }}" class="btn btn-success" style='margin-left: 20px;'><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            @include('partials/errors')
            @include('partials/success')
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="groups" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Secci&oacute;n</th>
                            <th>Grado</th>
                            <th>D&iacute;as</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th >Acciones</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                        <tr>
                            <td><a href="{{ route('groups.show', $group->id) }}">{{ $group->section }}</a></td>
                            <td>{{ $group->grade->name }}</td>
                            <td>{{ implode(',', array_keys($group->daysWeek)) }}</td>
                            <td>{{ $group->start_date->format('d-m-Y') }}</td>
                            <td>{{ $group->end_date->format('d-m-Y') }}</td>
                            <td style="width: 100px;">
                                <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-block btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                            </td>
                            <td style="width: 100px;">
                                {{ Form::open(array('method'=>'DELETE', 'route'=>array('groups.destroy', $group->id))) }}
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
    $('#groups').DataTable({
        "columnDefs": [
            {"targets": [5, 6], "orderable": false, "searchable": false}
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