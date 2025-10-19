@extends('layouts.assets-admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets-admin/img/logo.png') }}" alt="Logo" width="80">
                        <h3 style="font-family: 'Poppins', sans-serif;">Posyandu Admin</h3>
                    </div>
                    <!-- Flash Message -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <!-- Login Form -->
                    <form method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username (NIM)</label>
                            <input type="text" class="form-control" id="username" name="username" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (NIM)</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="{{ route('auth.register') }}" class="btn btn-outline-secondary">Registrasi</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Custom Font -->
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
<style>
    h3 { font-family: 'Poppins', sans-serif; }
</style>
@endpush
@endsection
