{{-- filepath: resources/views/members/edit.blade.php --}}
@extends('layouts.app')

@section('page-title', 'Edit Member')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item">Configuración</li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Miembros</a></li>
    <li class="breadcrumb-item active">Editar</li>
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
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $member->name) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Cédula</label>
                        <input type="text" class="form-control" name="cedula" value="{{ old('cedula', $member->id_document) }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" name="nacimiento" value="{{ old('nacimiento', $member->date_of_birth) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" name="correo" value="{{ old('correo', $member->email) }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $member->phone) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Unidad</label>
                        <select class="form-select" name="unidad" required>
                            <option value="Ejecutiva" @if($member->unit == 'Ejecutiva') selected @endif>Ejecutiva</option>
                            <option value="Administrativa Financiera" @if($member->unit == 'Administrativa Financiera') selected @endif>Administrativa Financiera</option>
                            <option value="Contraloría Social" @if($member->unit == 'Contraloría Social') selected @endif>Contraloría Social</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $member->address) }}" required>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Inicio de Mandato</label>
                        <input type="date" class="form-control" name="inicio_mandato" value="{{ old('inicio_mandato', $member->membership_start_date) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Fin de Mandato</label>
                        <input type="date" class="form-control" name="fin_mandato" value="{{ old('fin_mandato', $member->membership_end_date) }}" required>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('members.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection