@extends('layouts.app')

@section('page-title', 'Ver Asamblea')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('assemblies.index') }}">Asambleas</a></li>
    <li class="breadcrumb-item active">Ver</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">{{ $assembly->correlative }}</h5>
        <div>
            <a href="{{ route('assemblies.edit', $assembly) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="{{ route('assemblies.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Tipo:</strong> {{ $assembly->type }}</p>
                <p><strong>Estado:</strong> {{ $assembly->status }}</p>
                <p><strong>Fecha Programada:</strong> {{ $assembly->scheduled_date->format('d/m/Y H:i') }}</p>
                @if($assembly->actual_date)
                    <p><strong>Fecha Real:</strong> {{ $assembly->actual_date->format('d/m/Y H:i') }}</p>
                @endif
            </div>
            <div class="col-md-6">
                <p><strong>Motivo:</strong></p>
                <p>{{ $assembly->reason }}</p>
            </div>
        </div>

        @if($assembly->attendees->count() > 0)
            <h6 class="mt-4">Asistentes</h6>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Miembro</th>
                            <th>Asistió</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assembly->attendees as $attendee)
                            <tr>
                                <td>{{ $attendee->name }}</td>
                                <td>{{ $attendee->position }}</td>
                                <td>{{ $attendee->is_member ? 'Sí' : 'No' }}</td>
                                <td>{{ $attendee->attended ? 'Sí' : 'No' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($assembly->subjects->count() > 0)
            <h6 class="mt-4">Asuntos</h6>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Propuesto por</th>
                            <th>Estado</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assembly->subjects as $subject)
                            <tr>
                                <td>{{ $subject->title }}</td>
                                <td>{{ $subject->proposed_by }}</td>
                                <td>{{ $subject->state }}</td>
                                <td>{{ $subject->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($assembly->documents->count() > 0)
            <h6 class="mt-4">Documentos</h6>
            <ul class="list-group">
                @foreach($assembly->documents as $document)
                    <li class="list-group-item">
                        <a href="{{ route('documents.show', $document) }}" class="text-decoration-none">{{ $document->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection