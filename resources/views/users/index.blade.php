@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>USUARIOS</h1>
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
                <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#agregar-usuario">
                    <i class="fas fa-plus"></i> Agregar Usuario
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
                                    <th>EMAIL</th>
                                    <th>ROL</th>
                                    <th>ACTIVO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="table-user">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td class="text-center"><span id="activebadge" class="badge badge-{{ $user->isActive == 'active' ? 'success' : 'danger' }}">{{ $user->isActive }}</span></td>
                                        <td>
                                            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                            <i class="fas {{ $user->isActive=='active' ? 'fa-user-lock bg-danger' : 'fa-user-check bg-info' }}" style="cursor: pointer; padding:10px; border-radius:5px;" data-user="{{ $user->id }}"></i>
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




    <div class="modal fade" id="agregar-usuario">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Agregar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('users.store') }}">
                    <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="name">Ingrese Nombre</label>
                            <input id="name" class="form-control @error('name') is-invalid @enderror"  type="text" name="name" placeholder="Ingrese Nombre">
                        </div>
                        <div class="form-group">
                            <label for="email">Ingrese Correo</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror"  type="email" name="email" placeholder="Ingrese Email">
                        </div>
                        <div class="form-group">
                            <label for="role">Roles</label>
                            <select id="role" class="form-control" name="role">
                                <option value=""> --Seleccione rol</option>
                                <option value="admin" {{ old('admin') === 'admin' ? 'selected' : '' }}>Administrador
                                </option>
                                <option value="watcher" {{ old('watcher') === 'watcher' ? 'selected' : '' }}>Digitador
                                </option>
                                <option value="reader" {{ old('reader') === 'reader' ? 'selected' : '' }}>Lector
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Ingrese Password</label>
                            <input id="password" class="form-control @error('password') is-invalid @enderror"
                                type="password" name="password" placeholder="Ingrese password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Password</label>
                            <input id="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                name="password_confirmation" placeholder="Confirme password">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Registrar Usuario</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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
        if (document.getElementById('table-user')) {

            const tableUser = document.getElementById('table-user');
            tableUser.addEventListener('click', async(event) => {
                const element = event.target;
                if (element.classList.contains('bg-danger') || element.classList.contains('bg-info')) {
                    const {
                        user
                    } = element.dataset;
                    
                    const message=await Swal.fire({
                        title: 'Esta seguro de cambiar estado al usuario?',
                        text: "Puede cambiar el estado en cualquier momento",
                        showCancelButton: true,
                        cancelButtonText: 'No',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si'
                      })
                    const {value} = await message
                    if (value) {
                        const response = await fetch(`/users/${user}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': window.CSRF_TOKEN
                            }
                        });
                        const result = await response.json();
                        const activebadge=document.getElementById('activebadge');
                        if(response.ok){
                            Swal.fire(
                                result.status,
                                'Se cambio el estado correctamente',
                                'success'
                            )
                            if(result.type==='inactive'){
                                element.classList.remove('bg-danger');
                                element.classList.add('bg-info');
                                element.classList.remove('fa-user-lock');
                                element.classList.add('fa-user-check');
                                activebadge.innerHTML='inactive';
                                activebadge.classList.remove('badge-success');
                                activebadge.classList.add('badge-danger');
                            }else{
                                element.classList.remove('bg-info');
                                element.classList.add('bg-danger');
                                element.classList.remove('fa-user-check');
                                element.classList.add('fa-user-lock');
                                activebadge.innerHTML='active';
                                activebadge.classList.remove('badge-danger');
                                activebadge.classList.add('badge-success');
                            }
                           
                        }else{
                            Swal.fire(
                                result.status,
                                'No se pudo cambiar el estado',
                                'error'
                            )
                        }
                    }
                }

               
            });
        }
    </script>
@stop
