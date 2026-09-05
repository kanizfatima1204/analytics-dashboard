<?php $__env->startSection('body'); ?>
<div class="app-shell" id="appShell">
    <aside class="sidebar" id="sidebar">
        <div class="brand"><div class="brand-mark">P</div><div><strong>Pulse</strong><span>Analytics</span></div></div>
        <nav class="nav">
            <a class="nav-item active" href="#overview">⌂ <span>Overview</span></a>
            <a class="nav-item" href="#analytics">◒ <span>Analytics</span></a>
            <a class="nav-item" href="#transactions">↔ <span>Transactions</span></a>
            <a class="nav-item" href="#customers">◎ <span>Customers</span></a>
        </nav>
        <div class="sidebar-bottom">
            <div class="upgrade-card"><span class="eyebrow">PRO PLAN</span><h4>Unlock deeper insights</h4><p>Forecasting, cohort views and scheduled reports.</p></div>
            <div class="account-links">
                <a class="nav-item" href="<?php echo e(route('profile')); ?>">☺ <span>Profile</span></a>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?><button class="nav-item logout" type="submit">↪ <span>Log out</span></button></form>
            </div>
        </div>
    </aside>
    <main class="main-content">
        <header class="topbar">
            <button class="icon-btn menu-btn" id="menuBtn" aria-label="Open menu">☰</button>
            <div class="topbar-title"><span class="eyebrow">BUSINESS INTELLIGENCE</span><h1>Overview</h1></div>
            <div class="topbar-actions"><button class="icon-btn" id="themeBtn" aria-label="Toggle dark mode">☾</button><div class="avatar"><?php echo e(collect(explode(' ', auth()->user()->name))->map(fn($p)=>substr($p,0,1))->implode('')); ?></div></div>
        </header>
        <section class="content-wrap" id="overview">
            <div class="hero-row"><div><h2>Good afternoon, <?php echo e(Str::before(auth()->user()->name, ' ')); ?></h2><p class="muted">Monitor growth, customer activity and revenue performance at a glance.</p></div><div class="filter-bar"><label class="filter-label" for="dateFilter">Period</label><select id="dateFilter"><option value="7">Last 7 days</option><option value="30" selected>Last 30 days</option><option value="90">Last 90 days</option><option value="365">Last 12 months</option></select></div></div>
            <section class="kpi-grid" id="kpis"></section>
            <section class="analytics-grid" id="analytics">
                <div class="panel chart-panel wide-panel"><div class="panel-header"><div><span class="eyebrow">PERFORMANCE</span><h3>Revenue & orders</h3></div><div class="legend"><span><i class="dot revenue"></i> Revenue</span><span><i class="dot orders"></i> Orders</span></div></div><div class="chart-wrap"><canvas id="performanceChart"></canvas></div></div>
                <div class="panel chart-panel"><div class="panel-header"><div><span class="eyebrow">ACQUISITION</span><h3>Traffic channels</h3></div><span class="pill" id="channelPeriod">30 days</span></div><div class="donut-wrap"><canvas id="channelChart"></canvas></div><div class="channel-list" id="channelList"></div></div>
                <div class="panel chart-panel wide-panel"><div class="panel-header"><div><span class="eyebrow">CONVERSION</span><h3>Funnel performance</h3></div></div><div class="funnel" id="funnel"></div></div>
                <div class="panel chart-panel"><div class="panel-header"><div><span class="eyebrow">CUSTOMERS</span><h3>New users</h3></div><span class="trend positive">+8.4%</span></div><div class="mini-stat"><strong id="newUsersStat">—</strong><span>new users</span></div><div class="chart-wrap compact"><canvas id="usersChart"></canvas></div></div>
            </section>
            <section class="data-grid" id="transactions"><div class="panel table-panel"><div class="panel-header table-toolbar"><div><span class="eyebrow">ACTIVITY</span><h3>Recent transactions</h3></div><div class="table-actions"><div class="search-box"><span>⌕</span><input id="transactionSearch" placeholder="Search transaction..."></div></div></div><div class="table-scroll"><table><thead><tr><th data-sort="customer">Customer</th><th data-sort="reference">Reference</th><th data-sort="date">Date</th><th data-sort="amount">Amount</th><th data-sort="status">Status</th></tr></thead><tbody id="transactionBody"></tbody></table></div></div>
            <div class="panel table-panel" id="customers"><div class="panel-header table-toolbar"><div><span class="eyebrow">CUSTOMERS</span><h3>Top users</h3></div></div><div class="table-scroll"><table><thead><tr><th>User</th><th>Plan</th><th>Spend</th><th>Orders</th></tr></thead><tbody id="userBody"></tbody></table></div></div></section>
            <footer class="footer">Pulse Analytics • Laravel 12 • Synthetic business data</footer>
        </section>
    </main>
</div><div class="mobile-overlay" id="overlay"></div>
<script>window.dashboardEndpoint='<?php echo e(route('dashboard.data')); ?>';</script>
<script src="<?php echo e(asset('assets/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'Pulse Analytics'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\My Projects\advanced-analytics-dashboard-laravel12\laravel12-analytics-dashboard\resources\views/dashboard/index.blade.php ENDPATH**/ ?>