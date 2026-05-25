@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --ivory:     #FAF8F3;
    --cream:     #F3EFE6;
    --charcoal:  #1C1C1E;
    --ink:       #3A3A3C;
    --muted:     #6E6E73;
    --gold:      #C9913A;
    --gold-lt:   #F0D9B3;
    --gold-dk:   #8B6120;
    --teal:      #1A6B6B;
    --teal-lt:   #D1ECEC;
    --teal-dk:   #0D4444;
    --white:     #FFFFFF;
    --border:    rgba(0,0,0,0.09);
    --shadow-sm: 0 2px 10px rgba(0,0,0,0.06);
    --shadow-md: 0 6px 28px rgba(0,0,0,0.09);
    --radius:    10px;
    --radius-lg: 16px;
    --serif:     'Playfair Display', Georgia, serif;
    --sans:      'DM Sans', system-ui, sans-serif;
    --tr:        0.24s cubic-bezier(0.4,0,0.2,1);
  }

  body { font-family: var(--sans); background: var(--ivory); color: var(--charcoal); }

  /* ── PAGE HEADER ─────────────────────────────────── */
  .dash-header {
    background: var(--charcoal);
    position: relative;
    overflow: hidden;
    padding: 42px 40px 38px;
  }

  .dash-header-bg {
    position: absolute; inset: 0;
    background:
      radial-gradient(ellipse 55% 80% at 95% 40%, rgba(201,145,58,0.16) 0%, transparent 65%),
      radial-gradient(ellipse 40% 70% at 2%  70%, rgba(26,107,107,0.17) 0%, transparent 65%),
      linear-gradient(140deg, #1C1C1E 0%, #222628 100%);
  }

  .d-ring {
    position: absolute; border-radius: 50%;
    border: 1px solid rgba(201,145,58,0.10);
    pointer-events: none;
  }
  .dr1 { width: 340px; height: 340px; top: -150px; right: -60px; }
  .dr2 { width: 180px; height: 180px; top: -40px;  right:  80px; border-color: rgba(201,145,58,0.18); }
  .dr3 { width: 130px; height: 130px; bottom: -50px; left: 30px; border-color: rgba(26,107,107,0.22); }

  .dash-header-inner {
    position: relative; z-index: 2;
    max-width: 1300px; margin: 0 auto;
    display: flex; align-items: center; justify-content: space-between; gap: 24px;
    flex-wrap: wrap;
  }

  .dash-header-left {}

  .dash-eyebrow {
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 8px;
    display: flex; align-items: center; gap: 7px;
  }
  .dash-eyebrow span { width: 18px; height: 1px; background: var(--gold); display: block; }

  .dash-title {
    font-family: var(--serif);
    font-size: clamp(1.5rem, 3vw, 2.1rem);
    font-weight: 700; color: var(--white); line-height: 1.2;
  }
  .dash-title em { font-style: normal; color: var(--gold); }

  .dash-sub {
    font-size: 0.82rem; color: rgba(255,255,255,0.40);
    margin-top: 5px; font-weight: 300;
  }

  .dash-header-right {
    display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
  }

  .dash-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 14px; border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.12);
    font-size: 0.76rem; font-weight: 500;
    color: rgba(255,255,255,0.55);
    background: rgba(255,255,255,0.05);
  }
  .dash-badge i { font-size: 0.7rem; color: var(--gold); }

  /* ── MAIN BODY ───────────────────────────────────── */
  .dash-body {
    max-width: 1300px;
    margin: 0 auto;
    padding: 36px 28px 70px;
  }

  /* ── STAT CARDS ──────────────────────────────────── */
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 18px;
    margin-bottom: 36px;
  }

  .stat-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px 22px;
    display: flex; align-items: flex-start; gap: 16px;
    transition: transform var(--tr), box-shadow var(--tr);
    animation: fadeUp 0.5s both;
  }

  .stat-card:nth-child(1) { animation-delay: 0.05s; }
  .stat-card:nth-child(2) { animation-delay: 0.10s; }
  .stat-card:nth-child(3) { animation-delay: 0.15s; }
  .stat-card:nth-child(4) { animation-delay: 0.20s; }

  .stat-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }

  .stat-icon {
    width: 48px; height: 48px; border-radius: 13px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 1.1rem;
  }

  .si-blue   { background: #EBF4FF; color: #1A5FAD; }
  .si-green  { background: #D1F0E0; color: #0D6B47; }
  .si-teal   { background: var(--teal-lt); color: var(--teal-dk); }
  .si-gold   { background: var(--gold-lt); color: var(--gold-dk); }

  .stat-info {}
  .stat-label { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.07em; color: var(--muted); margin-bottom: 4px; }
  .stat-value { font-family: var(--serif); font-size: 2rem; font-weight: 700; color: var(--charcoal); line-height: 1; }
  .stat-hint  { font-size: 0.72rem; color: var(--muted); margin-top: 4px; }

  /* ── TABS ────────────────────────────────────────── */
  .dash-tabs {
    display: flex; gap: 4px;
    border-bottom: 1.5px solid var(--border);
    margin-bottom: 26px;
    overflow-x: auto;
    padding-bottom: 0;
  }

  .dash-tab {
    padding: 10px 20px;
    font-size: 0.85rem; font-weight: 500;
    color: var(--muted);
    cursor: pointer;
    border: none; background: transparent;
    border-bottom: 2.5px solid transparent;
    margin-bottom: -1.5px;
    white-space: nowrap;
    transition: color var(--tr), border-color var(--tr);
    display: flex; align-items: center; gap: 7px;
    font-family: var(--sans);
  }

  .dash-tab i { font-size: 0.8rem; }

  .dash-tab:hover { color: var(--charcoal); }

  .dash-tab.active {
    color: var(--teal);
    border-bottom-color: var(--teal);
    font-weight: 600;
  }

  .dash-tab .tab-count {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 20px; height: 20px; padding: 0 5px;
    border-radius: 10px;
    background: var(--gold-lt);
    color: var(--gold-dk);
    font-size: 10px; font-weight: 700;
  }

  /* tab panels */
  .tab-panel { display: none; animation: fadeUp 0.3s both; }
  .tab-panel.active { display: block; }

  /* ── SECTION CARD ────────────────────────────────── */
  .section-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }

  .section-head {
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px;
    background: var(--cream);
    flex-wrap: wrap;
  }

  .section-head-left {
    display: flex; align-items: center; gap: 11px;
  }

  .section-icon {
    width: 34px; height: 34px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 0.82rem;
  }

  .si-warning { background: var(--gold-lt); color: var(--gold-dk); }
  .si-primary { background: #EBF4FF; color: #1A5FAD; }
  .si-success { background: #D1F0E0; color: #0D6B47; }
  .si-info    { background: var(--teal-lt); color: var(--teal-dk); }

  .section-head-title { font-weight: 600; font-size: 0.92rem; color: var(--charcoal); }
  .section-head-sub   { font-size: 0.75rem; color: var(--muted); margin-top: 1px; }

  /* ── PENDING PROVIDER CARDS ──────────────────────── */
  .pending-list { padding: 18px 24px; display: flex; flex-direction: column; gap: 16px; }

  .pending-card {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 18px 20px;
    display: flex; align-items: flex-start; justify-content: space-between; gap: 18px;
    background: var(--ivory);
    transition: box-shadow var(--tr);
    flex-wrap: wrap;
  }

  .pending-card:hover { box-shadow: var(--shadow-sm); }

  .pending-avatar {
    width: 44px; height: 44px; border-radius: 12px;
    background: linear-gradient(135deg, var(--teal), var(--teal-dk));
    display: flex; align-items: center; justify-content: center;
    font-family: var(--serif); font-size: 1rem; font-weight: 700;
    color: var(--white); flex-shrink: 0;
  }

  .pending-info { flex: 1; min-width: 200px; }

  .pending-name { font-weight: 600; font-size: 0.95rem; color: var(--charcoal); margin-bottom: 6px; }

  .pending-meta {
    display: flex; flex-wrap: wrap; gap: 10px 20px;
    font-size: 0.78rem; color: var(--muted);
  }

  .pending-meta span { display: flex; align-items: center; gap: 5px; }
  .pending-meta i { color: var(--teal); font-size: 0.72rem; }

  .pending-actions { display: flex; gap: 8px; align-items: flex-start; flex-shrink: 0; }

  .btn-approve, .btn-reject, .btn-action {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 16px; border-radius: 8px;
    font-family: var(--sans); font-size: 0.8rem; font-weight: 600;
    border: none; cursor: pointer;
    transition: all var(--tr);
    text-decoration: none;
  }

  .btn-approve {
    background: #D1F0E0; color: #0D6B47;
    border: 1px solid rgba(13,107,71,0.20);
  }
  .btn-approve:hover { background: #0D6B47; color: var(--white); }

  .btn-reject {
    background: #FEE2E2; color: #991B1B;
    border: 1px solid rgba(153,27,27,0.18);
  }
  .btn-reject:hover { background: #991B1B; color: var(--white); }

  .empty-state {
    text-align: center; padding: 48px 24px;
    color: var(--muted); font-size: 0.9rem;
  }
  .empty-state i { font-size: 2.2rem; color: var(--gold-lt); margin-bottom: 12px; display: block; }

  /* ── TABLE ───────────────────────────────────────── */
  .table-wrap { overflow-x: auto; }

  table.dash-table {
    width: 100%; border-collapse: collapse;
    font-size: 0.83rem;
  }

  .dash-table thead th {
    padding: 12px 16px;
    text-align: left;
    font-size: 10px; font-weight: 700;
    letter-spacing: 0.09em; text-transform: uppercase;
    color: var(--muted);
    border-bottom: 1.5px solid var(--border);
    background: var(--cream);
    white-space: nowrap;
  }

  .dash-table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background var(--tr);
  }
  .dash-table tbody tr:last-child { border-bottom: none; }
  .dash-table tbody tr:hover { background: var(--ivory); }

  .dash-table td {
    padding: 12px 16px;
    color: var(--ink);
    vertical-align: middle;
  }

  .td-id { color: var(--muted); font-size: 0.75rem; }

  .td-name { font-weight: 600; color: var(--charcoal); }
  .td-sub  { font-size: 0.74rem; color: var(--muted); margin-top: 1px; }

  /* status badges */
  .badge {
    display: inline-block; padding: 3px 10px;
    border-radius: 20px; font-size: 10px; font-weight: 700;
    letter-spacing: 0.04em; text-transform: uppercase;
  }

  .badge-success  { background: #D1F0E0; color: #0D6B47; }
  .badge-warning  { background: var(--gold-lt); color: var(--gold-dk); }
  .badge-danger   { background: #FEE2E2; color: #991B1B; }
  .badge-info     { background: var(--teal-lt); color: var(--teal-dk); }
  .badge-gray     { background: #F1EFE8; color: var(--muted); }

  /* table action buttons */
  .tbl-btn {
    width: 30px; height: 30px; border-radius: 7px;
    border: 1px solid var(--border);
    display: inline-flex; align-items: center; justify-content: center;
    cursor: pointer; font-size: 0.72rem;
    transition: all var(--tr); background: var(--white);
    color: var(--muted);
  }
  .tbl-btn:hover { border-color: transparent; }
  .tbl-btn-view:hover  { background: var(--teal-lt); color: var(--teal); }
  .tbl-btn-edit:hover  { background: var(--gold-lt); color: var(--gold-dk); }
  .tbl-btn-del:hover   { background: #FEE2E2; color: #991B1B; }

  /* ── CATEGORIES ──────────────────────────────────── */
  .cat-add-form {
    display: flex; gap: 12px; flex-wrap: wrap;
    padding: 20px 24px;
    border-bottom: 1px solid var(--border);
    background: var(--ivory);
    align-items: flex-end;
  }

  .cat-add-form .field { flex: 1; min-width: 160px; }

  .cat-add-form label {
    display: block; font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.08em;
    color: var(--muted); margin-bottom: 6px;
  }

  .cat-add-form input {
    width: 100%; padding: 10px 13px;
    border-radius: 9px; border: 1.5px solid var(--border);
    background: var(--white); color: var(--charcoal);
    font-family: var(--sans); font-size: 0.87rem;
    outline: none; transition: border-color var(--tr), box-shadow var(--tr);
  }

  .cat-add-form input:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 3px rgba(26,107,107,0.08);
  }

  .btn-add {
    padding: 10px 22px; border-radius: 9px;
    background: var(--charcoal); color: var(--white);
    font-family: var(--sans); font-size: 0.85rem; font-weight: 600;
    border: none; cursor: pointer;
    display: inline-flex; align-items: center; gap: 7px;
    transition: background var(--tr), transform var(--tr);
    white-space: nowrap;
  }

  .btn-add:hover { background: var(--teal); transform: translateY(-1px); }

  /* ── PAGINATION ──────────────────────────────────── */
  .pagination-wrap {
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    background: var(--cream);
  }

  /* ── MODAL ───────────────────────────────────────── */
  .modal-overlay {
    display: none;
    position: fixed; inset: 0; z-index: 1000;
    background: rgba(0,0,0,0.45);
    align-items: center; justify-content: center;
    padding: 20px;
  }

  .modal-overlay.open { display: flex; }

  .modal-box {
    background: var(--white);
    border-radius: var(--radius-lg);
    width: 100%; max-width: 520px;
    max-height: 90vh; overflow-y: auto;
    box-shadow: 0 24px 80px rgba(0,0,0,0.22);
    animation: fadeUp 0.28s both;
  }

  .modal-head {
    padding: 20px 24px 16px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
    position: sticky; top: 0; background: var(--white); z-index: 2;
  }

  .modal-title {
    font-family: var(--serif); font-size: 1.15rem;
    font-weight: 700; color: var(--charcoal);
  }

  .modal-close {
    width: 32px; height: 32px; border-radius: 8px;
    border: 1px solid var(--border); background: transparent;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: var(--muted); font-size: 0.9rem;
    transition: all var(--tr);
  }
  .modal-close:hover { background: #FEE2E2; color: #991B1B; border-color: #FECACA; }

  .modal-body { padding: 22px 24px; }

  /* info rows in view modal */
  .info-row {
    display: flex; gap: 10px;
    padding: 9px 0; border-bottom: 1px solid var(--border);
    font-size: 0.85rem;
  }
  .info-row:last-child { border-bottom: none; }
  .info-key { font-weight: 600; color: var(--muted); min-width: 110px; font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.06em; }
  .info-val { color: var(--charcoal); }

  /* form fields inside modal */
  .modal-field { margin-bottom: 16px; }

  .modal-field label {
    display: block; font-size: 10px; font-weight: 700;
    text-transform: uppercase; letter-spacing: 0.08em;
    color: var(--muted); margin-bottom: 6px;
  }

  .modal-field input,
  .modal-field select {
    width: 100%; padding: 10px 13px;
    border-radius: 9px; border: 1.5px solid var(--border);
    background: var(--ivory); color: var(--charcoal);
    font-family: var(--sans); font-size: 0.87rem;
    outline: none; transition: border-color var(--tr), box-shadow var(--tr);
    -webkit-appearance: none;
  }

  .modal-field input:focus,
  .modal-field select:focus {
    border-color: var(--teal); background: var(--white);
    box-shadow: 0 0 0 3px rgba(26,107,107,0.08);
  }

  .modal-foot {
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    display: flex; justify-content: flex-end; gap: 10px;
    background: var(--cream);
    position: sticky; bottom: 0;
  }

  .btn-modal-cancel {
    padding: 9px 20px; border-radius: 9px;
    background: transparent; color: var(--muted);
    font-family: var(--sans); font-size: 0.85rem; font-weight: 500;
    border: 1.5px solid var(--border); cursor: pointer;
    transition: all var(--tr);
  }
  .btn-modal-cancel:hover { background: var(--ivory); color: var(--ink); }

  .btn-modal-save {
    padding: 9px 22px; border-radius: 9px;
    background: var(--charcoal); color: var(--white);
    font-family: var(--sans); font-size: 0.85rem; font-weight: 600;
    border: none; cursor: pointer;
    display: inline-flex; align-items: center; gap: 7px;
    transition: background var(--tr), transform var(--tr);
  }
  .btn-modal-save:hover { background: var(--teal); transform: translateY(-1px); }

  /* ── ANIMATIONS ──────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .dash-body { animation: fadeUp 0.45s 0.05s both; }

  /* ── RESPONSIVE ──────────────────────────────────── */
  @media (max-width: 700px) {
    .dash-header { padding: 32px 20px 28px; }
    .dash-body { padding: 24px 16px 50px; }
    .section-head { padding: 14px 16px; }
    .pending-list { padding: 14px 16px; }
    .modal-body { padding: 16px; }
  }
</style>

{{-- ══ PAGE HEADER ══════════════════════════════════════════════════════════ --}}
<div class="dash-header">
  <div class="dash-header-bg"></div>
  <div class="d-ring dr1"></div>
  <div class="d-ring dr2"></div>
  <div class="d-ring dr3"></div>
  <div class="dash-header-inner">
    <div class="dash-header-left">
      <div class="dash-eyebrow"><span></span> Control Panel</div>
      <div class="dash-title">Admin <em>Dashboard</em></div>
      <div class="dash-sub">Manage providers, bookings, and categories from one place.</div>
    </div>
    <div class="dash-header-right">
      <div class="dash-badge"><i class="fas fa-circle-dot"></i> Live</div>
      <div class="dash-badge"><i class="fas fa-calendar"></i> {{ date('d M Y') }}</div>
    </div>
  </div>
</div>

<div class="dash-body">

  {{-- ══ STAT CARDS ══════════════════════════════════════════════════════════ --}}
  <div class="stat-grid">
    <div class="stat-card">
      <div class="stat-icon si-blue"><i class="fas fa-users"></i></div>
      <div class="stat-info">
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ $totalUsers }}</div>
        <div class="stat-hint">Registered accounts</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon si-green"><i class="fas fa-briefcase"></i></div>
      <div class="stat-info">
        <div class="stat-label">Service Providers</div>
        <div class="stat-value">{{ $totalProviders }}</div>
        <div class="stat-hint">Active on platform</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon si-teal"><i class="fas fa-calendar-check"></i></div>
      <div class="stat-info">
        <div class="stat-label">Total Bookings</div>
        <div class="stat-value">{{ $totalBookings }}</div>
        <div class="stat-hint">All time bookings</div>
      </div>
    </div>
    <div class="stat-card">
      <div class="stat-icon si-gold"><i class="fas fa-hourglass-half"></i></div>
      <div class="stat-info">
        <div class="stat-label">Pending Approvals</div>
        <div class="stat-value">{{ $pendingProviders }}</div>
        <div class="stat-hint">Awaiting review</div>
      </div>
    </div>
  </div>

  {{-- ══ TABS ══════════════════════════════════════════════════════════════ --}}
  <div class="dash-tabs">
    <button class="dash-tab active" onclick="switchTab('pending', this)">
      <i class="fas fa-hourglass-half"></i> Pending Providers
      @if($pendingProviders > 0)
        <span class="tab-count">{{ $pendingProviders }}</span>
      @endif
    </button>
    <button class="dash-tab" onclick="switchTab('allproviders', this)">
      <i class="fas fa-briefcase"></i> All Providers
    </button>
    <button class="dash-tab" onclick="switchTab('categories', this)">
      <i class="fas fa-tags"></i> Categories
    </button>
    <button class="dash-tab" onclick="switchTab('bookings', this)">
      <i class="fas fa-calendar-check"></i> All Bookings
    </button>
  </div>

  {{-- ══ TAB: PENDING PROVIDERS ══════════════════════════════════════════════ --}}
  <div class="tab-panel active" id="tab-pending">
    <div class="section-card">
      <div class="section-head">
        <div class="section-head-left">
          <div class="section-icon si-warning"><i class="fas fa-hourglass-half"></i></div>
          <div>
            <div class="section-head-title">Pending Provider Approvals</div>
            <div class="section-head-sub">Review and approve or reject applications</div>
          </div>
        </div>
      </div>

      <div class="pending-list">
        @forelse($pendingProviderList as $provider)
        <div class="pending-card">
          <div class="pending-avatar">{{ strtoupper(substr($provider->business_name, 0, 2)) }}</div>
          <div class="pending-info">
            <div class="pending-name">{{ $provider->business_name }}</div>
            <div class="pending-meta">
              <span><i class="fas fa-user"></i> {{ $provider->user->name }}</span>
              <span><i class="fas fa-envelope"></i> {{ $provider->user->email }}</span>
              <span><i class="fas fa-tag"></i> {{ $provider->category->name }}</span>
              <span><i class="fas fa-map-marker-alt"></i> {{ $provider->city }}, {{ $provider->area }}</span>
              <span><i class="fas fa-phone"></i> {{ $provider->phone }}</span>
            </div>
          </div>
          <div class="pending-actions">
            <form action="{{ route('admin.providers.approve', $provider) }}" method="POST">
              @csrf
              <button type="submit" class="btn-approve">
                <i class="fas fa-check"></i> Approve
              </button>
            </form>
            <form action="{{ route('admin.providers.reject', $provider) }}" method="POST">
              @csrf
              <button type="submit" class="btn-reject"
                      onclick="return confirm('Reject this provider?')">
                <i class="fas fa-xmark"></i> Reject
              </button>
            </form>
          </div>
        </div>
        @empty
        <div class="empty-state">
          <i class="fas fa-circle-check"></i>
          No pending approvals — you're all caught up!
        </div>
        @endforelse
      </div>
    </div>
  </div>

  {{-- ══ TAB: ALL PROVIDERS ══════════════════════════════════════════════════ --}}
  <div class="tab-panel" id="tab-allproviders">
    <div class="section-card">
      <div class="section-head">
        <div class="section-head-left">
          <div class="section-icon si-primary"><i class="fas fa-briefcase"></i></div>
          <div>
            <div class="section-head-title">All Service Providers</div>
            <div class="section-head-sub">View, edit, and manage every provider on the platform</div>
          </div>
        </div>
      </div>

      <div class="table-wrap">
        <table class="dash-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Business</th>
              <th>Category</th>
              <th>City</th>
              <th>Status</th>
              <th>Approved</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($allProviders as $provider)
            <tr>
              <td class="td-id">#{{ $provider->id }}</td>
              <td>
                <div class="td-name">{{ $provider->business_name }}</div>
                <div class="td-sub">{{ $provider->user->name }}</div>
              </td>
              <td>{{ $provider->category->name }}</td>
              <td>{{ $provider->city }}</td>
              <td>
                @php
                  $sc = match($provider->status) {
                    'available' => 'badge-success',
                    'working'   => 'badge-info',
                    'on_leave'  => 'badge-warning',
                    default     => 'badge-gray',
                  };
                @endphp
                <span class="badge {{ $sc }}">
                  {{ ucfirst(str_replace('_', ' ', $provider->status)) }}
                </span>
              </td>
              <td>
                @if($provider->is_approved)
                  <span class="badge badge-success">Approved</span>
                @else
                  <span class="badge badge-warning">Pending</span>
                @endif
              </td>
              <td>
                <div style="display:flex;gap:5px;">
                  <button class="tbl-btn tbl-btn-view" title="View"
                          onclick="openModal('view-{{ $provider->id }}')">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="tbl-btn tbl-btn-edit" title="Edit"
                          onclick="openModal('edit-{{ $provider->id }}')">
                    <i class="fas fa-pen"></i>
                  </button>
                  <form action="{{ route('admin.providers.delete', $provider) }}" method="POST"
                        onsubmit="return confirm('Delete this provider permanently?')" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="tbl-btn tbl-btn-del" title="Delete">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="pagination-wrap">{{ $allProviders->links() }}</div>
    </div>
  </div>

  {{-- ══ TAB: CATEGORIES ═════════════════════════════════════════════════════ --}}
  <div class="tab-panel" id="tab-categories">
    <div class="section-card">
      <div class="section-head">
        <div class="section-head-left">
          <div class="section-icon si-success"><i class="fas fa-tags"></i></div>
          <div>
            <div class="section-head-title">Manage Categories</div>
            <div class="section-head-sub">Add, edit, or remove service categories</div>
          </div>
        </div>
      </div>

      <form action="{{ route('admin.categories.store') }}" method="POST" class="cat-add-form">
        @csrf
        <div class="field">
          <label>Category Name</label>
          <input type="text" name="name" placeholder="e.g. Plumbing" required>
        </div>
        <div class="field">
          <label>Icon Class</label>
          <input type="text" name="icon" placeholder="e.g. fa-wrench">
        </div>
        <button type="submit" class="btn-add">
          <i class="fas fa-plus"></i> Add Category
        </button>
      </form>

      <div class="table-wrap">
        <table class="dash-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Icon</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $category)
            <tr>
              <td class="td-id">#{{ $category->id }}</td>
              <td class="td-name">{{ $category->name }}</td>
              <td style="color:var(--muted);font-size:0.78rem;">{{ $category->slug }}</td>
              <td><i class="fas {{ $category->icon }}" style="color:var(--teal);"></i></td>
              <td>
                <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-danger' }}">
                  {{ $category->is_active ? 'Active' : 'Inactive' }}
                </span>
              </td>
              <td>
                <div style="display:flex;gap:5px;">
                  <button class="tbl-btn tbl-btn-edit" title="Edit"
                          onclick="openModal('editcat-{{ $category->id }}')">
                    <i class="fas fa-pen"></i>
                  </button>
                  <form action="{{ route('admin.categories.delete', $category) }}" method="POST"
                        onsubmit="return confirm('Delete this category?')" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="tbl-btn tbl-btn-del" title="Delete">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- ══ TAB: ALL BOOKINGS ═══════════════════════════════════════════════════ --}}
  <div class="tab-panel" id="tab-bookings">
    <div class="section-card">
      <div class="section-head">
        <div class="section-head-left">
          <div class="section-icon si-info"><i class="fas fa-calendar-check"></i></div>
          <div>
            <div class="section-head-title">All Bookings</div>
            <div class="section-head-sub">Complete log of every booking made on the platform</div>
          </div>
        </div>
      </div>

      <div class="table-wrap">
        <table class="dash-table">
          <thead>
            <tr>
              <th>Booking #</th>
              <th>Customer</th>
              <th>Provider</th>
              <th>Service</th>
              <th>Date</th>
              <th>Status</th>
              <!-- <th>Amount</th> -->
            </tr>
          </thead>
          <tbody>
            @foreach($allBookings as $booking)
            <tr>
              <td class="td-id">{{ $booking->booking_number }}</td>
              <td class="td-name">{{ $booking->user->name }}</td>
              <td>{{ $booking->serviceProvider->business_name }}</td>
              <td>{{ $booking->category->name }}</td>
              <td style="white-space:nowrap;color:var(--muted);">
                {{ date('d M Y', strtotime($booking->service_date)) }}
              </td>
              <td>
                @php
                  $bc = match($booking->status) {
                    'pending'   => 'badge-warning',
                    'accepted'  => 'badge-success',
                    'completed' => 'badge-info',
                    default     => 'badge-danger',
                  };
                @endphp
                <span class="badge {{ $bc }}">{{ ucfirst($booking->status) }}</span>
              </td>
              <!-- <td style="font-weight:600;">₹{{ number_format($booking->total_amount ?? 0) }}</td> -->
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="pagination-wrap">{{ $allBookings->links() }}</div>
    </div>
  </div>

</div>{{-- end dash-body --}}

{{-- ══════════════════════════════════════════════════════════════════════════
     MODALS — Provider View & Edit
════════════════════════════════════════════════════════════════════════════ --}}
@foreach($allProviders as $provider)

{{-- View Modal --}}
<div class="modal-overlay" id="modal-view-{{ $provider->id }}" onclick="closeOnOverlay(event, 'view-{{ $provider->id }}')">
  <div class="modal-box">
    <div class="modal-head">
      <div class="modal-title">{{ $provider->business_name }}</div>
      <button class="modal-close" onclick="closeModal('view-{{ $provider->id }}')"><i class="fas fa-xmark"></i></button>
    </div>
    <div class="modal-body">
      <div class="info-row"><span class="info-key">Owner</span><span class="info-val">{{ $provider->user->name }}</span></div>
      <div class="info-row"><span class="info-key">Email</span><span class="info-val">{{ $provider->user->email }}</span></div>
      <div class="info-row"><span class="info-key">Phone</span><span class="info-val">{{ $provider->phone }}</span></div>
      <div class="info-row"><span class="info-key">Category</span><span class="info-val">{{ $provider->category->name }}</span></div>
      <div class="info-row"><span class="info-key">Address</span><span class="info-val">{{ $provider->address }}</span></div>
      <div class="info-row"><span class="info-key">City</span><span class="info-val">{{ $provider->city }}</span></div>
      <div class="info-row"><span class="info-key">Area</span><span class="info-val">{{ $provider->area }}</span></div>
      <div class="info-row"><span class="info-key">Pincode</span><span class="info-val">{{ $provider->pincode }}</span></div>
      <div class="info-row"><span class="info-key">Experience</span><span class="info-val">{{ $provider->experience ?? 'N/A' }}</span></div>
      <div class="info-row"><span class="info-key">Base Price</span><span class="info-val">₹{{ number_format($provider->base_price ?? 0) }}</span></div>
      <div class="info-row"><span class="info-key">Rating</span><span class="info-val">{{ number_format($provider->rating, 1) }} ⭐</span></div>
    </div>
    <div class="modal-foot">
      <button class="btn-modal-cancel" onclick="closeModal('view-{{ $provider->id }}')">Close</button>
    </div>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="modal-edit-{{ $provider->id }}" onclick="closeOnOverlay(event, 'edit-{{ $provider->id }}')">
  <div class="modal-box">
    <form action="{{ route('admin.providers.update', $provider) }}" method="POST">
      @csrf @method('PUT')
      <div class="modal-head">
        <div class="modal-title">Edit — {{ $provider->business_name }}</div>
        <button type="button" class="modal-close" onclick="closeModal('edit-{{ $provider->id }}')"><i class="fas fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <div class="modal-field">
          <label>Business Name</label>
          <input type="text" name="business_name" value="{{ $provider->business_name }}" required>
        </div>
        <div class="modal-field">
          <label>Phone</label>
          <input type="text" name="phone" value="{{ $provider->phone }}" required>
        </div>
        <div class="modal-field">
          <label>City</label>
          <input type="text" name="city" value="{{ $provider->city }}" required>
        </div>
        <div class="modal-field">
          <label>Area</label>
          <input type="text" name="area" value="{{ $provider->area }}" required>
        </div>
        <div class="modal-field">
          <label>Base Price (₹)</label>
          <input type="number" step="0.01" name="base_price" value="{{ $provider->base_price }}" required>
        </div>
        <div class="modal-field">
          <label>Status</label>
          <select name="status">
            <option value="available" {{ $provider->status == 'available' ? 'selected' : '' }}>Available</option>
            <option value="working"   {{ $provider->status == 'working'   ? 'selected' : '' }}>Working</option>
            <option value="free"      {{ $provider->status == 'free'      ? 'selected' : '' }}>Free</option>
            <option value="on_leave"  {{ $provider->status == 'on_leave'  ? 'selected' : '' }}>On Leave</option>
          </select>
        </div>
      </div>
      <div class="modal-foot">
        <button type="button" class="btn-modal-cancel" onclick="closeModal('edit-{{ $provider->id }}')">Cancel</button>
        <button type="submit" class="btn-modal-save"><i class="fas fa-floppy-disk"></i> Save Changes</button>
      </div>
    </form>
  </div>
</div>

@endforeach

{{-- Category Edit Modals --}}
@foreach($categories as $category)
<div class="modal-overlay" id="modal-editcat-{{ $category->id }}" onclick="closeOnOverlay(event, 'editcat-{{ $category->id }}')">
  <div class="modal-box">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
      @csrf @method('PUT')
      <div class="modal-head">
        <div class="modal-title">Edit Category</div>
        <button type="button" class="modal-close" onclick="closeModal('editcat-{{ $category->id }}')"><i class="fas fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <div class="modal-field">
          <label>Name</label>
          <input type="text" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="modal-field">
          <label>Icon Class</label>
          <input type="text" name="icon" value="{{ $category->icon }}">
        </div>
        <div class="modal-field">
          <label>Status</label>
          <select name="is_active">
            <option value="1" {{ $category->is_active ? 'selected' : '' }}>Active</option>
            <option value="0" {{ !$category->is_active ? 'selected' : '' }}>Inactive</option>
          </select>
        </div>
      </div>
      <div class="modal-foot">
        <button type="button" class="btn-modal-cancel" onclick="closeModal('editcat-{{ $category->id }}')">Cancel</button>
        <button type="submit" class="btn-modal-save"><i class="fas fa-floppy-disk"></i> Update</button>
      </div>
    </form>
  </div>
</div>
@endforeach

<script>
  function switchTab(id, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.dash-tab').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + id).classList.add('active');
    btn.classList.add('active');
  }

  function openModal(id) {
    document.getElementById('modal-' + id).classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(id) {
    document.getElementById('modal-' + id).classList.remove('open');
    document.body.style.overflow = '';
  }

  function closeOnOverlay(e, id) {
    if (e.target === e.currentTarget) closeModal(id);
  }

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.open').forEach(m => {
        m.classList.remove('open');
        document.body.style.overflow = '';
      });
    }
  });
</script>

@endsection