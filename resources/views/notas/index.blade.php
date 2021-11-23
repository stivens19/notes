@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>NOTAS ESTUDIANTES</h1>
    <hr>
@stop

@section('content')
    <div class="container-fluid">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                <strong>{{ session()->get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">

            <div class="col-12">
                <a href="{{ route('notas.create') }}" class="btn btn-success mb-2"><i class="fas fa-plus"></i> Agregar Notas</a>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Compras</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="notas" class="table table-bordered table-hover mw-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRES</th>
                                    <th>DNI</th>
                                    <th>ACCION</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRES</th>
                                    <th>DNI</th>
                                    <th>ACCION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        $(function() {
            $('#notas').DataTable({
                ajax: '{{ route('datatable.notas') }}',
                serverSide: true,
                processing: true,
                order: [ [0, 'desc'] ],
                columns: [
                    { data: 'id'},
                    { data: 'nombre_completo'},
                    { data: 'dni'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
            });
        });
        /*$('body').on('click', '.deleteItem', function () {
     
            var Item_id = $(this).data("id");
            Swal.fire({
                title: 'Esta seguro de anular compra?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Anular!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('/compras') }}"+'/'+Item_id,
                        success: function (data) {
                            $('#compras').DataTable().ajax.reload();
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido anulado.',
                                'success'
                            )
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            Swal.fire(
                                'Error!',
                                'El registro no pudo ser anulado.',
                                'error'
                            )
                        }
                    });
                }
            })
            
        });*/
    </script>
@stop
