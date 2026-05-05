<div class="row g-3">
    <div class="col-12">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name ?? '') }}">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">NIK</label>
        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
               value="{{ old('nik', $user->nik ?? '') }}" maxlength="16">
        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">No. HP</label>
        <input type="text" name="no_hp" class="form-control"
               value="{{ old('no_hp', $user->no_hp ?? '') }}">
    </div>
    <div class="col-md-8">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email ?? '') }}">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Role <span class="text-danger">*</span></label>
        <select name="role" class="form-select @error('role') is-invalid @enderror">
            <option value="masyarakat" {{ old('role', $user->role ?? 'masyarakat') === 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
            <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">
            Password {{ !($isCreate ?? true) ? '(Kosongkan jika tidak diubah)' : '' }}
            @if($isCreate ?? true)<span class="text-danger">*</span>@endif
        </label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
               {{ ($isCreate ?? true) ? 'required' : '' }}>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control"
               {{ ($isCreate ?? true) ? 'required' : '' }}>
    </div>
    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Akun Aktif</label>
        </div>
    </div>
</div>
