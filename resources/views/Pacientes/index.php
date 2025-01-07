@extends('layout.layout')

@section('title', 'Pacientes')

@section('content')
    <div class="container mt-4">
        <h1>Panel del Paciente</h1>

        <!-- Generar cita -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Generar Cita</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('citas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generar Cita</button>
                </form>
            </div>
        </div>

        <!-- Verificar y editar datos -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Mis Datos</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $paciente->nombre }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $paciente->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $paciente->telefono }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                </form>
            </div>
        </div>

        <!-- Ver recetas -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Mis Recetas</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Receta</th>
                            <th>Doctor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recetas as $receta)
                        <tr>
                            <td>{{ $receta->fecha }}</td>
                            <td>{{ $receta->descripcion }}</td>
                            <td>{{ $receta->doctor->nombre }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
