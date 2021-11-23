@extends('adminlte::page')

@section('title', 'Detalle compra')

@section('content_header')
    <h1>{{ $estudiante->nombre }} {{ $estudiante->apellido }}</b></h1>
    <hr>
@stop

@section('content')
    <!- <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><b>{{ $estudiante->dni }}</b></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('notas.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Notas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><span class="badge badge-primary p-2">Alumno:</span>
                        {{ $estudiante->nombre }} {{ $estudiante->apellido }}</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">

                            <div class="row">
                                <div class="col-12">
                                    <h4>Notas de Estudiante</h4>
                                   
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->

    @stop

    @section('css')

        <link rel="stylesheet" href="/css/admin_custom.css">
        <style>
            .wd-98 {
                width: 98vw;
            }
            .wd-45 {
                width: 45vw;
            }
            tr{
                border:solid 1px #000;
                padding: 0 10px;
            }
            td{
                border:solid 1px #000;
                padding: 0 10px;
            }
        </style>
    @stop

    @section('js')


    @stop
