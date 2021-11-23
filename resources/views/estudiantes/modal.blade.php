
<div class="modal fade" id="agregar-estudiante">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('estudiantes.store') }}">
                <div class="modal-body">

                    @csrf
                    <div class="form-group">
                        <label for="nombre">Ingrese Nombre</label>
                        <input id="nombre" class="form-control @error('nombre') is-invalid @enderror"  type="text" name="nombre" placeholder="Ingrese Nombre">
                    </div>
                    <div class="form-group">
                        <label for="apellido">Ingrese apellido</label>
                        <input id="apellido" class="form-control @error('apellido') is-invalid @enderror"  type="text" name="apellido" placeholder="Ingrese apellidos">
                    </div>
                    <div class="form-group">
                        <label for="dni">Ingrese DNI</label>
                        <input id="dni" class="form-control @error('dni') is-invalid @enderror"  type="text" name="dni" placeholder="Ingrese dni">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Ingrese direccion</label>
                        <input id="direccion" class="form-control @error('direccion') is-invalid @enderror"  type="text" name="direccion" placeholder="Ingrese direccion">
                    </div>
                   
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar Estudiante</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
