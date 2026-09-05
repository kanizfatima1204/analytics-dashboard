@extends('layouts.app', ['title' => 'Login — Pulse Analytics'])
@section('body')
<div class="auth-shell">
    <div class="auth-card">
        <div class="brand auth-brand"><div class="brand-mark">P</div><div><strong>Pulse</strong><span>Analytics</span></div></div>
        <div class="auth-copy"><span class="eyebrow">BUSINESS INTELLIGENCE</span><h1>Sign in to your dashboard</h1><p>Use the demo account below to explore the complete analytics experience.</p></div>
        @if(session('status'))<div class="alert success">{{ session('status') }}</div>@endif
        @if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('login.store') }}" class="auth-form">
            @csrf
            <label>Email<input type="email" name="email" value="{{ old('email', 'admin@example.com') }}" required autocomplete="email"></label>
            <label>Password<input type="password" name="password" value="password" required autocomplete="current-password"></label>
            <label class="remember"><input type="checkbox" name="remember" value="1"> Remember me</label>
            <button class="primary-btn" type="submit">Sign in</button>
        </form>
        <div class="demo-box"><strong>Demo credentials</strong><span>admin@example.com</span><span>password</span></div>
    </div>
</div>
@endsection
