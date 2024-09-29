@extends('layouts.app')

@section('content')
<div class="container mt-20">
    <h2>Register Super Admin</h2>
    <form action="{{ url('/registerSuperAdmin') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="border border-black" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="border border-black" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="border border-black" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password:</label>
            <input type="password" class="border border-black" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Register Super Admin</button>
    </form>
</div>
@endsection
