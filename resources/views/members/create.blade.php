{{-- filepath: resources/views/members/create.blade.php --}}
@extends('layouts.app')

@section('page-title', 'Create Member')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Crear Nuevo Miembro</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('members.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Cédula</label>
                        <input type="text" class="form-control" name="cedula" value="{{ old('cedula') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Unidad</label>
                        <select class="form-select" name="unidad" required>
                            <option value="">Selecciona...</option>
                            <option value="Ejecutiva">Ejecutiva</option>
                            <option value="Administrativa Financiera">Administrativa Financiera</option>
                            <option value="Contraloría Social">Contraloría Social</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Inicio de Mandato</label>
                        <input type="date" class="form-control" name="inicio_mandato" value="{{ old('inicio_mandato') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fin de Mandato</label>
                        <input type="date" class="form-control" name="fin_mandato" value="{{ old('fin_mandato') }}" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('members.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection