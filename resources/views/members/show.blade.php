@extends('layouts.app')

@section('page-title', 'Member Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
    <li class="breadcrumb-item active">{{ $member->name }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detalles del Miembro</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Nombre:</strong>
                    <p>{{ $member->nombre }}</p>
                </div>
                <div class="mb-3">
                    <strong>Cédula:</strong>
                    <p>{{ $member->cedula }}</p>
                </div>
                <div class="mb-3">
                    <strong>Fecha de Nacimiento:</strong>
                    <p>{{ $member->nacimiento }}</p>
                </div>
                <div class="mb-3">
                    <strong>Correo:</strong>
                    <p>{{ $member->correo }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <strong>Teléfono:</strong>
                    <p>{{ $member->telefono }}</p>
                </div>
                <div class="mb-3">
                    <strong>Dirección:</strong>
                    <p>{{ $member->direccion }}</p>
                </div>
                <div class="mb-3">
                    <strong>Unidad:</strong>
                    <p><span class="badge bg-secondary">{{ $member->unidad }}</span></p>
                </div>
                <div class="mb-3">
                    <strong>Creado:</strong>
                    <p>{{ $member->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-end">
            <a href="{{ route('members.index') }}" class="btn btn-secondary me-2">Volver</a>
            <a href="{{ route('members.edit', $member) }}" class="btn btn-warning me-2">Editar</a>
            <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar miembro?')">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection