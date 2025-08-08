{{-- filepath: resources/views/members/create.blade.php --}}
@extends('layouts.app')

@section('page-title', 'Create Member')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <h1>Nuevo miembro</h1>
    <form method="POST" action="{{ route('members.store') }}">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" required>
        <label>Cédula:</label>
        <input type="text" name="cedula" value="{{ old('cedula') }}" required>
        <label>Nacimiento:</label>
        <input type="date" name="nacimiento" value="{{ old('nacimiento') }}" required>
        <label>Correo:</label>
        <input type="email" name="correo" value="{{ old('correo') }}" required>
        <label>Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono') }}" required>
        <label>Dirección:</label>
        <input type="text" name="direccion" value="{{ old('direccion') }}" required>
        <label>Unidad:</label>
        <select name="unidad" required>
            <option value="">Selecciona...</option>
            <option value="Ejecutiva">Ejecutiva</option>
            <option value="Administrativa Financiera">Administrativa Financiera</option>
            <option value="Contraloría Social">Contraloría Social</option>
        </select>
        <button type="submit">Guardar</button>
    </form>
@endsection