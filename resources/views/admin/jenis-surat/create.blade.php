@extends('layouts.app')
@section('title', 'Tambah Jenis Surat')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-file-earmark-plus-fill me-2 text-primary"></i>Tambah Jenis Surat</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.jenis-surat.index') }}">Jenis Surat</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
</div>

<div class="card" style="max-width:700px;">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.jenis-surat.store') }}">
            @csrf
            @include('admin.jenis-surat._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Simpan</button>
                <a href="{{ route('admin.jenis-surat.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
