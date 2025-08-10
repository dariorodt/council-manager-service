@extends('layouts.app')

@section('page-title', 'Inicio')

@section('breadcrumb')
    <li class="breadcrumb-item active">Inicio</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome to Council Manager</h5>
                <p class="card-text">You have successfully logged in.</p>
            </div>
        </div>
    </div>
</div>
@endsection