@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Curso</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Editar Curso</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('content')
    <form action="{{ route('courses.update',$course->id) }}" method="POST">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $course->nombre }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="curso">Curso</label>
                                <input id="curso" class="form-control @error('nombre') is-invalid @enderror" type="text"
                                    name="nombre" value="{{ $course->nombre ?? old('nombre') }}">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Cancelar</a>
                    <input type="submit" value="Actualizar curso" class="btn btn-success float-right">
                </div>
            </div>
        </section>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
