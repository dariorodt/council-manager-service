{{-- filepath: resources/views/members/edit.blade.php --}}
@extends('layouts.app')

@section('page-title', 'Edit Member')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <h1>Editar miembro</h1>
    <form method="POST" action="{{ route('members.update', $member) }}">
        @csrf
        @method('PUT')
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $member->nombre) }}" required>
        <label>Cédula:</label>
        <input type="text" name="cedula" value="{{ old('cedula', $member->cedula) }}" required>
        <label>Nacimiento:</label>
        <input type="date" name="nacimiento" value="{{ old('nacimiento', $member->nacimiento) }}" required>
        <label>Correo:</label>
        <input type="email" name="correo" value="{{ old('correo', $member->correo) }}" required>
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono', $member->telefono) }}" required>
        <label>Dirección:</label>
        <input type="text" name="direccion" value="{{ old('direccion', $member->direccion) }}" required>
        <label>Unidad:</label>
        <select name="unidad" required>
            <option value="Ejecutiva" @if($member->unidad == 'Ejecutiva') selected @endif>Ejecutiva</option>
            <option value="Administrativa Financiera" @if($member->unidad == 'Administrativa Financiera') selected @endif>Administrativa Financiera</option>
            <option value="Contraloría Social" @if($member->unidad == 'Contraloría Social') selected @endif>Contraloría Social</option>
        </select>
        <button type="submit">Actualizar</button>
    </form>
@endsection