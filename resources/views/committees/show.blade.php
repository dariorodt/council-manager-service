@extends('layouts.app')

@section('page-title', 'Ver Comité')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('committees.index') }}">Comités</a></li>
    <li class="breadcrumb-item active">Ver</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="mb-0">{{ $committee->name }}</h5>
        <div>
            <a href="{{ route('committees.edit', $committee) }}" class="btn btn-warning btn-sm">Editar</a>
            <a href="{{ route('committees.index') }}" class="btn btn-secondary btn-sm">Volver</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Responsable:</strong> {{ $committee->responsible->name ?? 'Sin asignar' }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge bg-{{ $committee->status === 'En Funciones' ? 'success' : ($committee->status === 'Suspendido' ? 'danger' : 'secondary') }}">
                        {{ $committee->status }}
                    </span>
                </p>
                <p><strong>Fecha de Creación:</strong> {{ $committee->creation_date->format('d/m/Y') }}</p>
            </div>
        </div>

        @if($committee->functions->count() > 0)
            <h6 class="mt-4">Funciones</h6>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Ref. Acta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($committee->functions as $function)
                            <tr>
                                <td>{{ $function->nombre }}</td>
                                <td>{{ $function->descripcion }}</td>
                                <td>{{ $function->ref_act }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($committee->members->count() > 0)
            <h6 class="mt-4">Miembros</h6>
            <div class="row">
                @foreach($committee->members as $member)
                    <div class="col-md-4 mb-2">
                        <span class="badge bg-light text-dark">{{ $member->name }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        @if($committee->documents->count() > 0)
            <h6 class="mt-4">Documentos</h6>
            <ul class="list-group">
                @foreach($committee->documents as $document)
                    <li class="list-group-item">
                        <a href="{{ route('documents.show', $document) }}" class="text-decoration-none">{{ $document->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection