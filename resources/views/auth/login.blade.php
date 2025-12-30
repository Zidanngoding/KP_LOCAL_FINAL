@extends('layouts.app')

@section('title', 'Login')

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
        background: #ffd66b;
        top: -120px;
        right: -120px;
    }
    .auth-shell::after {
        width: 280px;
        height: 280px;
        background: #8bd3ff;
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
            grid-template-columns: 1.1fr 0.9fr;
        }
    }
    .auth-panel {
        padding: 32px 36px;
    }
    .auth-panel--info {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 55%, #0284c7 100%);
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
        background: #fbbf24;
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
        color: #1d4ed8;
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
            <div class="auth-panel auth-panel--info">
                <div class="auth-brand">SIKAM ELOK</div>
                <div class="auth-title">Masuk Dashboard</div>
                <p class="auth-subtitle">Pantau status KTP, catat pengambilan, dan rapikan data pemohon.</p>
                <ul class="auth-points">
                    <li><span class="auth-dot"></span>Ringkas, cepat, dan mudah dipantau.</li>
                    <li><span class="auth-dot"></span>Form yang jelas untuk setiap tahap proses.</li>
                    <li><span class="auth-dot"></span>Rekap selesai siap dicetak.</li>
                </ul>
            </div>
            <div class="auth-panel auth-panel--form">
                <div class="auth-form-header">
                    <h3>Login</h3>
                    <p>Masukkan akun Anda untuk lanjut.</p>
                </div>
                @if(request('error'))
                    <div class="alert alert-danger">Username atau password salah</div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="cth. admin01" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    </div>
                    <div class="auth-form-actions">
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <div>
                            Belum punya akun?
                            <a class="auth-link" href="{{ route('register') }}">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
