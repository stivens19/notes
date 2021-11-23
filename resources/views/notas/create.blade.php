@extends('adminlte::page')

@section('title', 'Registrar | Notas')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar Notas</h1>
                </div>
                <hr>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Registrar compra</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('content')

    <section class="content">
        <div class="row">
            <div class="card card-default w-100">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Agregar Notas</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Estudiante</label>
                                <select class="form-control select2" style="width: 100%;" name="estudiante_id">
                                    <option value="">--Seleccione Estudiante</option>
                                    @foreach ($estudiantes as $estudiante)
                                        <option value="{{ $estudiante->id }}">{{ $estudiante->dni }} -
                                            {{ $estudiante->nombre }} </option>
                                    @endforeach
                                    <input type="hidden" id="estudiante_id">
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-alt"></i></i></span>
                                        </div>
                                        <select name="grado_input" class="form-control" id="grado_input">
                                            <option value="">--GRADO</option>
                                            @foreach ($grados as $grado)
                                                <option value="{{ $grado->id }}">{{ $grado->slug }}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-alt"></i></i></span>
                                        </div>
                                        

                                        <select name="periodo_input" class="form-control" id="periodo_input">
                                            <option value="">--SELECCCIONE PERIODO</option>
                                            
                                            @foreach ($periodos as $periodo)
                                                <option value="{{ $periodo->id }}">{{ $periodo->anio }}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label>Curso</label>
                                        <select class="form-control select2curso" style="width: 100%;"
                                            id="curso-select">
                                            <option value="">--Seleccione Curso</option>
                                            @foreach ($cursos as $curso)
                                                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row p-2 bg-light">
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-product-hunt"></i></span>
                                        </div>
                                        <input type="hidden" id="curso_id" name="curso_id">
                                        <input type="text" class="form-control" name="curso" placeholder="Curso"
                                            disabled id="curso_input">
                                    </div>
                                </div>
                              
                                <div class="col-3">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                                        </div>
                                        <input type="number" class="form-control" step=".1" min="0" id="promedio" name="promedio"
                                            placeholder="Promedio" value="{{ old('promedio') }}" step="1">
                                    </div>
                                </div>

                                <button id="btnAgregar" class="btn btn-success ml-1">Agregar</button>
                            </div>
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-md-5">
                            <table class="table table-light" id="table-cursos">
                                
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer d-flex justify-content-between">
                    <button class="btn btn-primary" id="btnRegistrar">Registrar Notas</button>
                    
                </div>
            </div>
        </div>

    </section>

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    //Initialize Select2 Elements
    //Initialize Select2 Elements
    <script>
        $('.select2').select2()
        $('.select2curso').select2()
       

        document.addEventListener('DOMContentLoaded', async () => {
            

            $(".select2curso").on("change", function (e) {
                document.getElementById("curso_input").value = e.target.selectedOptions[0].text;
                document.getElementById("curso_id").value = e.target.value;
            });
            $(".select2").on("change", function (e) {
                document.getElementById("estudiante_id").value = e.target.value;
            });
            let notas=[];
            const btnAgregar=document.getElementById("btnAgregar");
            const btnRegistrar=document.getElementById("btnRegistrar");
            const cursoId=document.getElementById("curso_id");
            const estudianteId=document.getElementById("estudiante_id");
            const gradoInput=document.getElementById("grado_input");
            const promedio=document.getElementById("promedio");
            btnAgregar.addEventListener('click',function(){
                if(promedio.value=='' || gradoInput.value=='' || estudianteId.value=='' || cursoId.value==''){
                    alert("Debe completar todos los campos");
                    return;
                }
                let nota={
                    curso_id:cursoId.value*1,
                    estudiante_id:estudianteId.value*1,
                    promedio:promedio.value*1,
                    grado:gradoInput.value,
                    grado_id:gradoInput.value*1,
                    cursoTexto:document.getElementById("curso_input").value,
                    periodo_id:document.getElementById("periodo_input").value*1
                }
                notas.push(nota);
                cursoId.value='';  
                promedio.value='';
                document.getElementById("curso_input").value='';
                
                dibujarNotas()

            });
            
            let table=document.getElementById("table-cursos");
            function dibujarNotas(){
                
                table.innerHTML='';
                notas.forEach(function(nota){

                    let row=document.createElement('tr');
                    row.innerHTML=`
                        <td>${nota.cursoTexto}</td>
                        <td>${(nota.promedio).toFixed(2)}</td>
                        <td><button class="btn btn-danger btn-sm" data-id="${(nota.curso_id).toFixed(2)}">X</button></td>
                    `;
                    table.appendChild(row);
                });
            }
            
            table.addEventListener('click',e=>{
                if(e.target.classList.contains('btn-danger')){
                    let id=e.target.dataset.id;
                    notas=notas.filter(function(nota){
                        return nota.curso_id!=id;
                    });
                    dibujarNotas();
                }
            });

            btnRegistrar.addEventListener('click',async ()=>{
        
                var formData = new FormData();
                formData.append('notas', JSON.stringify(notas));

                const response = await fetch(`/notas`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const result = await response.json();
                if(result.success){
                    Swal.fire({
                        title: 'Exito',
                        text: 'Notas registrada correctamente',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                    location.href="/notas";
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo registrar la compra',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }
            })
            
        })
    </script>


@stop
