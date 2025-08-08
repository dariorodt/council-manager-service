{{-- filepath: resources/views/members/index.blade.php --}}
@extends('layouts.app')

@section('page-title', 'Members')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Members</li>
@endsection

@section('content')
    <h1>Miembros</h1>
    <a href="{{ route('members.create') }}">Nuevo miembro</a>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Cédula</th>
                <th>Unidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
                <tr>
                    <td>{{ $member->nombre }}</td>
                    <td>{{ $member->cedula }}</td>
                    <td>{{ $member->unidad }}</td>
                    <td>
                        <a href="{{ route('members.show', $member) }}">Ver</a>
                        <a href="{{ route('members.edit', $member) }}">Editar</a>
                        <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar miembro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection