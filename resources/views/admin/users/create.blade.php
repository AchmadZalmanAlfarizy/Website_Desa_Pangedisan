@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-person-plus-fill me-2 text-primary"></i>Tambah Pengguna</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
</div>

<div class="card" style="max-width:640px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            @include('admin.users._form', ['isCreate' => true])
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
