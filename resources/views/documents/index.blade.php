@extends('layouts.app')

@section('page-title', 'Documents')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item">Ejecutiva</li>
    <li class="breadcrumb-item active">Documentos</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Documentos</h2>
    <a href="{{ route('documents.create') }}" class="btn btn-primary">
        <i class="bi bi-plus"></i> Nuevo documento
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Extensión</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->name }}</td>
                            <td><span class="badge bg-info">{{ $document->extension }}</span></td>
                            <td>{{ Str::limit($document->description, 50) }}</td>
                            <td>
                                <a href="{{ $document->url }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-download"></i>
                                </a>
                                <a href="{{ route('documents.show', $document) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('documents.edit', $document) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar documento?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection