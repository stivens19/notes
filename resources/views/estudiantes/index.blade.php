@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>ESTUDIANTES</h1>
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
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach

        <div class="row">

            <div class="col-12">
                <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#agregar-estudiante">
                    <i class="fas fa-plus"></i> Agregar Estudiante
                </button>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Usuario</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="tabla" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>APELLIOS</th>
                                    <th>DNI</th>
                                    <th>DIRECCION</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="table-user">
                                @foreach ($estudiantes as $estudiante)
                                    <tr>
                                        <td>{{ $estudiante->id }}</td>
                                        <td>{{ $estudiante->nombre }}</td>
                                        <td>{{ $estudiante->apellido }}</td>
                                        <td>{{ $estudiante->dni }}</td>
                                        <td>{{ $estudiante->direccion }}</td>
                                        <td>
                                            <a href="{{ route('estudiantes.edit',$estudiante->id) }}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                        </td>
                                    </tr>
                                @endforeach



                            </tbody>
                            
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>



    @include('estudiantes.modal')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function() {
            $('#tabla').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        window.CSRF_TOKEN = '{{ csrf_token() }}';
       
    </script>
@stop
