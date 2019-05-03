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
                    <!-- ****** SE ELIMINA EL BODY DE LA TABLA YA QUE SE LLENA CON AJAX DATATABLES -->
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
        /* "columnDefs": [
            {"targets": [6, 7], "orderable": false, "searchable": false}
        ],
        "language": {
            "url": '{{ asset("/js/datatables/spanish.json") }}'
        },
        "order": [0, "asc"],
        "lengthMenu": [10, 20, 50] */

        "processing": true,
            "serverSide": true,
            "ajax": "{{ route('api_get_classes_datatable') }}",
            "columns": [
                // ***** El campo se renderiza para link a show 
            	{data: 'id', render: function (data, type, row) {
            		    var route = "{{ route('classes.index') }}/"+row.id;
            		    var link = "<a href="+route+">"+row.fullname+"</a>"
                        return link;
                    }
                },
                {data: 'first_name', name: 'first_name'},
                {data: 'group.name', name: 'group.name'},
                {data: 'establishment.name', name: 'establishment.name'},
                {data: 'start_time', name: 'start_time'},
                {data: 'end_time', name: 'end_time'},

                // ***** El campo se renderiza para link a edit 
                {data: 'id', render: function (data, type, row) {
                	    var route = "{{ route('classes.index') }}/"+row.id+"/edit";
                	    var button = "<a href="+route+" class=\"btn btn-block btn-primary\"><i class=\"fa fa-pencil\"></i> Editar</a>";
                        return button;
                    }
                },
                // ***** El campo se renderiza para funcion delete
                {data: 'id', render: function (data, type, row) {
                	    var route = "{{ route('classes.index') }}/"+row.id;
                	    var button = "<button type=\"submit\" class=\"btn btn-block btn-danger\" id=\"delete-button\"><i class=\"fa fa-trash \"></i> Eliminar</button>";
                	    var form = "<form id=\"del\" method=\"POST\" action="+route+" accept-charset=\"UTF-8\"><input name=\"_token\" type=\"hidden\" value=\"{{ Session::token() }}\"><input name=\"_method\" type=\"hidden\" value=\"DELETE\">"+button+"</form>";
                        return form;
                    }
                }
            ],
            "language": {
            	"url": '{{ asset("/js/datatables/spanish.json") }}'
        	},
        	"order": [0, "asc"],
        	"columnDefs": [
            	{"targets": [6, 7], "orderable": false, "searchable": false}
        	],
        	"lengthMenu": [10, 20, 50],
        	// ******** Los eventos del boton delete se deben aplicar una vez renderizada la tabla 
        	"initComplete": function(settings, json) {
    			$('form').submit(function (e) {
        			var result = confirm('¿Esta seguro que desea eliminar este registro?')
        			if (!result) {
            			e.preventDefault();
        			}
    			});
              }       
    });
    
});
$('#alert').delay(3000).slideUp(300);
</script>
@endsection