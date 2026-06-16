@extends('layouts.app')

@section('title', 'Tambah Panitia')
@section('page-title', 'Tambah Panitia Baru')
@section('page-breadcrumb')
    Admin / <a href="{{ route('admin.panitia.index') }}" style="color:#64748b;text-decoration:none;">Kelola Panitia</a> / <span>Tambah Baru</span>
@endsection

@section('content')

<div class="form-card" style="max-width:700px;">
    <div class="form-card-header">
        <h3>
            <svg width="18" height="18" fill="none" stroke="#0056B3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Form Pembuatan Akun Panitia
        </h3>
    </div>
    <div class="form-card-body">
        <div class="alert" style="background:#eff6ff;color:#1e3a8a;border:1px solid #bfdbfe;margin-bottom:1.5rem;">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>Akun yang dibuat di sini akan otomatis memiliki hak akses sebagai <strong>Panitia</strong> dan bisa langsung masuk ke Dashboard Panitia tanpa perlu mendaftar dari halaman depan.</div>
        </div>

        <form action="{{ route('admin.panitia.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Organisasi / Kepanitiaan <span style="color:red;">*</span></label>
                <input type="text" id="name" name="name" class="form-input @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: BEM Polbeng" required autofocus>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Resmi <span style="color:red;">*</span></label>
                <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Contoh: bem@polbeng.ac.id" required>
                <div class="form-hint">Email ini akan digunakan untuk login dan menerima kode OTP.</div>
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label for="password" class="form-label">Password <span style="color:red;">*</span></label>
                    <input type="password" id="password" name="password" class="form-input @error('password') is-invalid @enderror" required placeholder="Minimal 8 karakter">
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span style="color:red;">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required placeholder="Ulangi password">
                </div>
            </div>

            <div style="display:flex;gap:1rem;margin-top:1.5rem;padding-top:1.5rem;border-top:1px solid #f1f5f9;">
                <button type="submit" class="btn btn-primary" style="min-width:140px;justify-content:center;">Buat Akun</button>
                <a href="{{ route('admin.panitia.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
