@extends('layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Pengguna</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Edit: {{ $user->name }}</li>
    </ol>
</div>

<div class="card" style="max-width:640px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            @include('admin.users._form', ['isCreate' => false])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save me-1"></i>Perbarui</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
