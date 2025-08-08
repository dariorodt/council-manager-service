@extends('layouts.app')

@section('page-title', 'Member Details')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('members.index') }}">Members</a></li>
    <li class="breadcrumb-item active">{{ $member->name }}</li>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Member Details</div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Name:</strong> {{ $member->name }}
                    </div>
                    <div class="mb-3">
                        <strong>Email:</strong> {{ $member->email }}
                    </div>
                    <div class="mb-3">
                        <strong>Created:</strong> {{ $member->created_at->format('M d, Y') }}
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('members.edit', $member) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">Back to List</a>
                        <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection