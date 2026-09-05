@extends('layouts.app', ['title' => 'Profile — Pulse Analytics'])
@section('body')
<div class="app-shell" id="appShell">
    <aside class="sidebar" id="sidebar">
        <div class="brand"><div class="brand-mark">P</div><div><strong>Pulse</strong><span>Analytics</span></div></div>
        <nav class="nav">
            <a class="nav-item" href="{{ route('dashboard') }}">⌂ <span>Overview</span></a>
            <a class="nav-item" href="#analytics">◒ <span>Analytics</span></a>
            <a class="nav-item" href="#transactions">↔ <span>Transactions</span></a>
            <a class="nav-item" href="#customers">◎ <span>Customers</span></a>
        </nav>
        <div class="sidebar-bottom">
            <div class="upgrade-card"><span class="eyebrow">PRO PLAN</span><h4>Unlock deeper insights</h4><p>Forecasting, cohort views and scheduled reports.</p></div>
            <div class="account-links">
                <a class="nav-item" href="{{ route('profile') }}">☺ <span>Profile</span></a>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="nav-item logout" type="submit">↪ <span>Log out</span></button></form>
            </div>
        </div>
    </aside>
    <main class="main-content">
        <header class="topbar">
            <button class="icon-btn menu-btn" id="menuBtn" aria-label="Open menu">☰</button>
            <div class="topbar-title"><span class="eyebrow">ACCOUNT</span><h1>Profile</h1></div>
            <div class="topbar-actions"><button class="icon-btn" id="themeBtn" aria-label="Toggle dark mode">☾</button><div class="avatar">{{ collect(explode(' ', $user->name))->map(fn($p)=>substr($p,0,1))->implode('') }}</div></div>
        </header>
        <section class="content-wrap" id="overview">
            <div class="hero-row"><div><h2>{{ $user->name }}</h2><p class="muted">{{ $user->email }}</p></div></div>
            <section class="analytics-grid" id="analytics">
                <div class="panel table-panel">
                    <div class="panel-header"><div><span class="eyebrow">ACCOUNT DETAILS</span><h3>Profile information</h3></div></div>
                    <div class="table-scroll">
                        <table>
                            <thead><tr><th>Field</th><th>Value</th></tr></thead>
                            <tbody>
                                <tr><td>Name</td><td>{{ $user->name }}</td></tr>
                                <tr><td>Email</td><td>{{ $user->email }}</td></tr>
                                <tr><td>Member since</td><td>{{ $user->created_at->format('d M Y') }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </section>
    </main>
</div><div class="mobile-overlay" id="overlay"></div>
<script>window.dashboardEndpoint='{{ route('dashboard.data') }}';</script>
<script src="{{ asset('assets/app.js') }}"></script>
@endsection