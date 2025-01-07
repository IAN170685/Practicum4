@extends('layout.layout')

@section('title', 'Crear Cita')

@section('content')
    <div class="container mt-4">
        <h2>Crear Cita</h2>

        <form method="POST" action="{{ route('citas.store') }}" id="citaForm">
            @csrf

            <div class="form-group">
                <label for="especialidad">Especialidad</label>
                <select class="form-control" id="especialidad" name="especialidad">
                    <option value="">Seleccione una especialidad</option>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="medico_id">Médico</label>
                <select class="form-control" id="medico_id" name="medico_id" required>
                    <option value="">Seleccione un médico</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="time" class="form-control" id="hora" name="hora" required>
            </div>

            <button type="submit" class="btn btn-primary">Crear Cita</button>
        </form>
    </div>

    <script>
        document.getElementById('especialidad').addEventListener('change', function() {
            const especialidadId = this.value;
            const medicoSelect = document.getElementById('medico_id');

            fetch(`/api/medicos?especialidad_id=${especialidadId}`)
                .then(response => response.json())
                .then(data => {
                    medicoSelect.innerHTML = '<option value="">Seleccione un médico</option>';
                    data.medicos.forEach(medico => {
                        const option = document.createElement('option');
                        option.value = medico.id;
                        option.textContent = medico.nombre;
                        medicoSelect.appendChild(option);
                    });
                });
        });

        document.getElementById('citaForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const medicoId = document.getElementById('medico_id').value;
            const fecha = document.getElementById('fecha').value;
            const hora = document.getElementById('hora').value;

            fetch('{{ route('citas.checkAvailability') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ medico_id: medicoId, fecha: fecha, hora: hora })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.disponible) {
                        this.submit();
                    } else {
                        alert('El médico no está disponible en la fecha y hora seleccionadas.');
                    }
                });
        });
    </script>
@endsection
