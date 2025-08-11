@extends('layouts.app')

@section('page-title', 'Document Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item">Ejecutiva</li>
    <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documentos</a></li>
    <li class="breadcrumb-item active">{{ $document->name }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detalles del Documento</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Nombre:</strong>
                    <p>{{ $document->name }}</p>
                </div>
                <div class="mb-3">
                    <strong>Extensión:</strong>
                    <p><span class="badge bg-info">{{ $document->extension }}</span></p>
                </div>
                <div class="mb-3">
                    <strong>URL:</strong>
                    <p><a href="{{ $document->url }}" target="_blank">{{ $document->url }}</a></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Descripción:</strong>
                    <p>{{ $document->description ?: 'Sin descripción' }}</p>
                </div>
                <div class="mb-3">
                    <strong>Creado:</strong>
                    <p>{{ $document->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
        
        @if($document->transcription)
        <div class="mb-3">
            <strong>Transcripción:</strong>
            <div class="border p-3 bg-light">
                {{ $document->transcription }}
            </div>
        </div>
        @endif
        
        <div class="d-flex justify-content-end">
            <a href="{{ route('documents.index') }}" class="btn btn-secondary me-2">Volver</a>
            <a href="{{ $document->url }}" target="_blank" class="btn btn-success me-2">Descargar</a>
            <a href="{{ route('documents.edit', $document) }}" class="btn btn-warning me-2">Editar</a>
            <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar documento?')">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection