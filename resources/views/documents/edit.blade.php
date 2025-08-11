@extends('layouts.app')

@section('page-title', 'Edit Document')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item">Ejecutiva</li>
    <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documentos</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Documento</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('documents.update', $document) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $document->name) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Extensión</label>
                        <input type="text" class="form-control" name="extension" value="{{ old('extension', $document->extension) }}" required>
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">URL</label>
                <input type="text" class="form-control" name="url" value="{{ old('url', $document->url) }}" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="description" rows="3">{{ old('description', $document->description) }}</textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Transcripción</label>
                <textarea class="form-control" name="transcription" rows="5">{{ old('transcription', $document->transcription) }}</textarea>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('documents.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection