@extends('layout.layout')

@section('title', 'Medicos')

@section('content')
    <div class="container mt-4">
        <h1>Lista de Médicos</h1>

        <!-- Calendario de citas -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Calendario de Citas</h2>
            </div>
            <div class="card-body">
                <iframe src="https://calendar.google.com/calendar/embed?src=your_calendar_id" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>

        <!-- Historiales médicos -->
        <div class="card mb-4">
            <div class="card-header">
                <h2>Historiales Médicos</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Tratamiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historiales as $historial)
                        <tr>
                            <td>{{ $historial->paciente->nombre }}</td>
                            <td>{{ $historial->fecha }}</td>
                            <td>{{ $historial->descripcion }}</td>
                            <td>{{ $historial->tratamiento }}</td>
                            <td>
                                <a href="{{ route('historiales.edit', $historial->id) }}" class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

