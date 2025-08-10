{{-- filepath: resources/views/members/edit.blade.php --}}
@extends('layouts.app')

@section('page-title', 'Edit Member')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Miembro</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('members.update', $member) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $member->nombre) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Cédula</label>
                        <input type="text" class="form-control" name="cedula" value="{{ old('cedula', $member->cedula) }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento', $member->nacimiento) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" value="{{ old('correo', $member->correo) }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $member->telefono) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Unidad</label>
                        <select class="form-select" name="unidad" required>
                            <option value="Ejecutiva" @if($member->unidad == 'Ejecutiva') selected @endif>Ejecutiva</option>
                            <option value="Administrativa Financiera" @if($member->unidad == 'Administrativa Financiera') selected @endif>Administrativa Financiera</option>
                            <option value="Contraloría Social" @if($member->unidad == 'Contraloría Social') selected @endif>Contraloría Social</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $member->direccion) }}" required>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('members.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection