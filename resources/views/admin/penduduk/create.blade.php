@extends('layouts.app')
@section('title', 'Tambah Data Penduduk')

@section('content')
<div class="page-header">
    <h4><i class="bi bi-person-plus-fill me-2 text-primary"></i>Tambah Data Penduduk</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.penduduk.index') }}">Penduduk</a></li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
</div>

<div class="card" style="max-width:900px;">
    <div class="card-header">Data Kependudukan</div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.penduduk.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.penduduk._form')
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>Simpan Data
                </button>
                <a href="{{ route('admin.penduduk.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
