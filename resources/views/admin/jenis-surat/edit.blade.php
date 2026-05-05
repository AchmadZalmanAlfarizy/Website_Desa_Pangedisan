@extends('layouts.app')
@section('title', 'Edit Jenis Surat')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Jenis Surat</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.jenis-surat.index') }}">Jenis Surat</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</div>

<div class="card" style="max-width:700px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.jenis-surat.update', $jenisSurat) }}">
            @csrf @method('PUT')
            @include('admin.jenis-surat._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning"><i class="bi bi-save me-1"></i>Perbarui</button>
                <a href="{{ route('admin.jenis-surat.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
