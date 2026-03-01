@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    .auth-shell {
        min-height: calc(100vh - 120px);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .auth-shell::before,
    .auth-shell::after {
        content: "";
        position: absolute;
        border-radius: 999px;
        filter: blur(0.5px);
        opacity: 0.4;
        z-index: 0;
    }
    .auth-shell::before {
        width: 360px;
        height: 360px;
        background: #b1f1d6;
        top: -140px;
        right: -120px;
    }
    .auth-shell::after {
        width: 280px;
        height: 280px;
        background: #ffd6a5;
        bottom: -120px;
        left: -80px;
    }
    .auth-card {
        position: relative;
        z-index: 1;
        background: #ffffff;
        border-radius: 22px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr;
    }
    @media (min-width: 992px) {
        .auth-card {
            grid-template-columns: 1fr 1fr;
        }
    }
    .auth-panel {
        padding: 32px 36px;
    }
    .auth-panel--info {
        background: linear-gradient(135deg, #0f172a 0%, #1f2937 50%, #0f766e 100%);
        color: #e2e8f0;
    }
    .auth-brand {
        font-family: "Fraunces", serif;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-bottom: 12px;
        color: #f8fafc;
    }
    .auth-title {
        font-family: "Fraunces", serif;
        font-size: 2rem;
        margin-bottom: 12px;
        color: #ffffff;
    }
    .auth-subtitle {
        margin-bottom: 24px;
        color: rgba(248, 250, 252, 0.85);
    }
    .auth-points {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 10px;
        font-size: 0.95rem;
    }
    .auth-points li {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .auth-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #34d399;
        flex: 0 0 10px;
    }
    .auth-panel--form {
        background: #f8fafc;
    }
    .auth-form-header h3 {
        font-family: "Fraunces", serif;
        margin-bottom: 6px;
    }
    .auth-form-header p {
        color: #64748b;
        margin-bottom: 20px;
    }
    .auth-form-actions {
        display: grid;
        gap: 12px;
    }
    .auth-link {
        color: #0f766e;
        text-decoration: none;
        font-weight: 600;
    }
    .auth-link:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-shell">
    <div class="container">
        <div class="auth-card">
            <!-- LEFT INFO PANEL -->
            <div class="auth-panel auth-panel--info">
                <div class="auth-brand">SIKAM ELOK</div>
                <div class="auth-title">Buat Akun Baru</div>
                <p class="auth-subtitle">
                    Buat akses untuk admin atau operator agar pengelolaan data lebih rapi.
                </p>
                <ul class="auth-points">
                    <li><span class="auth-dot"></span>Kontrol hak akses sesuai peran.</li>
                    <li><span class="auth-dot"></span>Data pemohon tersinkron.</li>
                    <li><span class="auth-dot"></span>Dashboard siap untuk rekap.</li>
                </ul>
            </div>

            <!-- RIGHT FORM PANEL -->
            <div class="auth-panel auth-panel--form">
                <div class="auth-form-header">
                    <h3>Register</h3>
                    <p>Lengkapi data berikut untuk membuat akun.</p>
                </div>

                {{-- ERROR MESSAGE --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ old('username') }}"
                               placeholder="cth. petugas01"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Buat password"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password"
                               name="confirm_password"
                               class="form-control"
                               placeholder="Ulangi password"
                               required>
                    </div>

                    <!-- ROLE -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="auth-form-actions">
                        <button type="submit" class="btn btn-primary w-100">
                            Register
                        </button>

                        <div>
                            Sudah punya akun?
                            <a class="auth-link" href="{{ route('login') }}">Login</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection