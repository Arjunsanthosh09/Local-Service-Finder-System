@extends('layouts.app')

@section('title', 'Provider Dashboard')

@section('content')

{{-- ============================================================
     GOOGLE FONTS + FONT AWESOME
     ============================================================ --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  /* ── RESET & BASE ─────────────────────────────────────── */
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
    --border:    rgba(0,0,0,0.10);
    --shadow-sm: 0 2px 12px rgba(0,0,0,0.07);
    --shadow-md: 0 8px 32px rgba(0,0,0,0.10);
    --shadow-lg: 0 20px 60px rgba(0,0,0,0.13);
    --radius:    14px;
    --radius-lg: 22px;
    --serif:     'Playfair Display', Georgia, serif;
    --sans:      'DM Sans', system-ui, sans-serif;
    --transition: 0.28s cubic-bezier(0.4, 0, 0.2, 1);
  }

  body {
    font-family: var(--sans);
    background: var(--ivory);
    color: var(--charcoal);
    line-height: 1.7;
  }

  /* ── DASHBOARD HEADER ─────────────────────────────────── */
  .dash-header {
    background: var(--charcoal);
    position: relative;
    overflow: hidden;
    padding: 48px 40px 52px;
  }

  .dash-header-bg {
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 80% at 90% 50%, rgba(201,145,58,0.16) 0%, transparent 65%),
      radial-gradient(ellipse 40% 80% at 5% 80%,  rgba(26,107,107,0.20) 0%, transparent 60%),
      linear-gradient(135deg, #1C1C1E 0%, #2C2C30 60%, #1A2A2A 100%);
  }

  .dash-header-grain {
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
    opacity: 0.6;
  }

  .dash-header-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(201,145,58,0.13);
  }
  .dash-header-ring-1 { width: 340px; height: 340px; top: -120px; right: -60px; }
  .dash-header-ring-2 { width: 180px; height: 180px; top: 20px;  right: 120px; border-color: rgba(201,145,58,0.20); }

  .dash-header-inner {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 24px;
  }

  .dash-header-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 10px;
  }
  .dash-header-eyebrow span { width: 22px; height: 1px; background: var(--gold); display: block; }

  .dash-header h1 {
    font-family: var(--serif);
    font-size: clamp(1.6rem, 3vw, 2.4rem);
    font-weight: 700;
    color: var(--white);
    line-height: 1.2;
    margin-bottom: 6px;
  }

  .dash-header h1 em {
    font-style: normal;
    color: var(--gold);
  }

  .dash-header-sub {
    font-size: 0.88rem;
    color: rgba(255,255,255,0.50);
    font-weight: 300;
  }

  .dash-header-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
  }

  /* ── LAYOUT ───────────────────────────────────────────── */
  .dash-body {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 40px 80px;
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 28px;
    align-items: start;
  }

  /* ── CARDS ────────────────────────────────────────────── */
  .card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }

  .card-body { padding: 28px; }

  /* ── PROFILE CARD ─────────────────────────────────────── */
  .profile-avatar {
    width: 72px;
    height: 72px;
    border-radius: 20px;
    background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dk) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--serif);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--white);
    margin: 0 auto 16px;
  }

  .profile-name {
    font-family: var(--serif);
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--charcoal);
    text-align: center;
    margin-bottom: 4px;
  }

  .profile-cat {
    font-size: 0.8rem;
    color: var(--muted);
    text-align: center;
    margin-bottom: 20px;
  }

  .profile-divider {
    height: 1px;
    background: var(--border);
    margin: 0 -28px 20px;
  }

  .profile-stats-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1px;
    background: var(--border);
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 20px;
  }

  .profile-stat {
    background: var(--white);
    padding: 14px 12px;
    text-align: center;
  }

  .profile-stat-value {
    font-family: var(--serif);
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--gold);
    display: block;
    line-height: 1.1;
    margin-bottom: 2px;
  }

  .profile-stat-label {
    font-size: 11px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }

  /* ── STATUS BADGES ────────────────────────────────────── */
  .status-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  .status-active, .status-available, .status-verified {
    background: #D1ECE4;
    color: #0D6B47;
  }

  .status-working {
    background: var(--teal-lt);
    color: var(--teal-dk);
  }

  .status-free {
    background: var(--gold-lt);
    color: var(--gold-dk);
  }

  .status-pending {
    background: #FEF3C7;
    color: #92400E;
  }

  .status-on_leave, .status-inactive {
    background: #F3F4F6;
    color: var(--muted);
  }

  /* ── STATUS SELECT ────────────────────────────────────── */
  .status-section-title {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 10px;
  }

  .status-select {
    width: 100%;
    padding: 11px 14px;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    background: var(--ivory);
    color: var(--charcoal);
    font-family: var(--sans);
    font-size: 0.88rem;
    font-weight: 500;
    outline: none;
    cursor: pointer;
    transition: border-color var(--transition), background var(--transition);
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236E6E73' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
  }

  .status-select:focus { border-color: var(--teal); background-color: var(--white); }

  /* ── MAIN PANEL ───────────────────────────────────────── */
  .panel-header {
    padding: 22px 28px 0;
    border-bottom: 1px solid var(--border);
    margin-bottom: 0;
  }

  .panel-title {
    font-family: var(--serif);
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--charcoal);
    margin-bottom: 16px;
  }

  /* ── TABS ─────────────────────────────────────────────── */
  .tabs {
    display: flex;
    gap: 0;
    border-bottom: 1px solid var(--border);
  }

  .tab-btn {
    padding: 12px 20px;
    font-family: var(--sans);
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--muted);
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: color var(--transition), border-color var(--transition);
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: -1px;
  }

  .tab-btn .tab-count {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    font-size: 10px;
    background: var(--cream);
    color: var(--muted);
    font-weight: 700;
    transition: background var(--transition), color var(--transition);
  }

  .tab-btn.active {
    color: var(--teal);
    border-bottom-color: var(--teal);
  }

  .tab-btn.active .tab-count {
    background: var(--teal-lt);
    color: var(--teal-dk);
  }

  .tab-btn:hover:not(.active) { color: var(--ink); }

  /* ── TAB PANES ────────────────────────────────────────── */
  .tab-content { padding: 24px 28px; }
  .tab-pane { display: none; }
  .tab-pane.active { display: block; }

  /* ── BOOKING CARD ─────────────────────────────────────── */
  .booking-card {
    border: 1px solid var(--border);
    border-radius: var(--radius);
    padding: 20px 22px;
    background: var(--white);
    margin-bottom: 14px;
    transition: box-shadow var(--transition), transform var(--transition);
    position: relative;
    overflow: hidden;
  }

  .booking-card::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: var(--teal);
    border-radius: 2px 0 0 2px;
  }

  .booking-card.accepted::before { background: var(--gold); }
  .booking-card.completed::before { background: #10B981; }

  .booking-card:hover {
    box-shadow: var(--shadow-sm);
    transform: translateY(-2px);
  }

  .booking-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
  }

  .booking-number {
    font-family: var(--serif);
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--charcoal);
    margin-bottom: 2px;
  }

  .booking-meta-row {
    display: flex;
    flex-wrap: wrap;
    gap: 14px;
    margin-top: 10px;
  }

  .booking-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.82rem;
    color: var(--muted);
  }

  .booking-meta-item i {
    color: var(--teal);
    font-size: 0.78rem;
    width: 14px;
    text-align: center;
  }

  .booking-desc {
    font-size: 0.83rem;
    color: var(--ink);
    background: var(--cream);
    border-radius: 10px;
    padding: 10px 14px;
    margin-top: 12px;
    line-height: 1.55;
  }

  .booking-desc strong {
    font-weight: 600;
    color: var(--charcoal);
  }

  .booking-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 14px;
    padding-top: 14px;
    border-top: 1px solid var(--border);
    flex-wrap: wrap;
    gap: 10px;
  }

  .expiry-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.78rem;
    font-weight: 600;
    color: #B45309;
    background: #FEF3C7;
    padding: 5px 11px;
    border-radius: 20px;
  }

  .expiry-tag i { font-size: 0.72rem; }

  .booking-actions { display: flex; gap: 8px; }

  /* ── BUTTONS ──────────────────────────────────────────── */
  .btn {
    padding: 9px 18px;
    border-radius: var(--radius);
    font-family: var(--sans);
    font-size: 0.82rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    text-decoration: none;
  }

  .btn:hover { transform: translateY(-1px); }

  .btn-accept {
    background: var(--teal);
    color: var(--white);
    box-shadow: 0 3px 12px rgba(26,107,107,0.25);
  }
  .btn-accept:hover { background: var(--teal-dk); box-shadow: 0 6px 20px rgba(26,107,107,0.35); }

  .btn-reject {
    background: var(--ivory);
    color: #B91C1C;
    border: 1.5px solid #FCA5A5;
  }
  .btn-reject:hover { background: #FEF2F2; }

  .btn-complete {
    background: var(--charcoal);
    color: var(--white);
    box-shadow: 0 3px 12px rgba(0,0,0,0.15);
  }
  .btn-complete:hover { background: var(--teal); box-shadow: 0 6px 20px rgba(26,107,107,0.30); }

  /* ── REVIEW BLOCK ─────────────────────────────────────── */
  .review-block {
    background: var(--teal-lt);
    border-radius: 10px;
    padding: 12px 16px;
    margin-top: 12px;
    font-size: 0.83rem;
    color: var(--teal-dk);
  }

  .review-block .stars { color: #F59E0B; margin-right: 4px; }

  /* ── EXPIRED BADGE ────────────────────────────────────── */
  .badge-expired {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 11px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    background: #F3F4F6;
    color: var(--muted);
  }

  /* ── EMPTY STATE ──────────────────────────────────────── */
  .empty-state {
    text-align: center;
    padding: 48px 20px;
  }

  .empty-icon {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    background: var(--cream);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
  }

  .empty-icon i {
    font-size: 1.4rem;
    color: var(--muted);
  }

  .empty-title {
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--charcoal);
    margin-bottom: 6px;
  }

  .empty-sub {
    font-size: 0.82rem;
    color: var(--muted);
  }

  /* ── ANIMATIONS ───────────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .dash-header-left { animation: fadeUp 0.6s 0.05s both; }
  .dash-header-meta { animation: fadeUp 0.6s 0.15s both; }
  .dash-body > * { animation: fadeUp 0.6s 0.25s both; }

  /* ── RESPONSIVE ───────────────────────────────────────── */
  @media (max-width: 900px) {
    .dash-body {
      grid-template-columns: 1fr;
      padding: 24px 20px 60px;
    }

    .dash-header { padding: 36px 20px 40px; }
    .dash-header-ring-1, .dash-header-ring-2 { display: none; }

    .booking-card-header { flex-direction: column; gap: 10px; }
    .booking-footer { flex-direction: column; align-items: flex-start; }
  }
</style>

{{-- ============================================================
     DASHBOARD HEADER
     ============================================================ --}}
<div class="dash-header">
  <div class="dash-header-bg"></div>
  <div class="dash-header-grain"></div>
  <div class="dash-header-ring dash-header-ring-1"></div>
  <div class="dash-header-ring dash-header-ring-2"></div>

  <div class="dash-header-inner">
    <div class="dash-header-left">
      <div class="dash-header-eyebrow"><span></span> Provider Portal</div>
      <h1>Welcome back, <em>{{ $provider->business_name }}</em></h1>
      <p class="dash-header-sub">Manage your bookings and keep your status up to date.</p>
    </div>
    <div class="dash-header-meta">
      <span class="status-badge status-{{ $provider->status }}">
        {{ ucfirst(str_replace('_', ' ', $provider->status)) }}
      </span>
    </div>
  </div>
</div>

{{-- ============================================================
     DASHBOARD BODY
     ============================================================ --}}
<div class="dash-body">

  {{-- ── LEFT SIDEBAR ─────────────────────────────────────── --}}
  <aside>

    {{-- Profile Card --}}
    <div class="card" style="margin-bottom: 20px;">
      <div class="card-body">
        <div class="profile-avatar">
          {{ strtoupper(substr($provider->business_name, 0, 2)) }}
        </div>
        <div class="profile-name">{{ $provider->business_name }}</div>
        <div class="profile-cat">
          <i class="fas fa-tag" style="color:var(--teal);margin-right:4px;font-size:0.75rem;"></i>
          {{ $provider->category->name }}
        </div>

        <div class="profile-divider"></div>

        <div class="profile-stats-row">
          <div class="profile-stat">
            <span class="profile-stat-value">{{ number_format($provider->rating, 1) }}</span>
            <span class="profile-stat-label"><i class="fas fa-star" style="color:#F59E0B;"></i> Rating</span>
          </div>
          <div class="profile-stat">
            <span class="profile-stat-value">{{ $provider->total_reviews }}</span>
            <span class="profile-stat-label">Reviews</span>
          </div>
        </div>

        <div style="font-size:0.8rem;color:var(--muted);display:flex;align-items:center;gap:6px;justify-content:center;">
          <i class="fas fa-map-marker-alt" style="color:var(--teal);font-size:0.75rem;"></i>
          {{ $provider->city }}, {{ $provider->area }}
        </div>
      </div>
    </div>

    {{-- Status Updater --}}
    <div class="card">
      <div class="card-body">
        <div class="status-section-title">Update Your Status</div>
        <form action="{{ route('provider.status.update') }}" method="POST">
          @csrf
          <select name="status" class="status-select" onchange="this.form.submit()">
            <option value="available" {{ $provider->status == 'available' ? 'selected' : '' }}>✅ Available</option>
            <option value="working"   {{ $provider->status == 'working'   ? 'selected' : '' }}>🔧 Working</option>
            <option value="free"      {{ $provider->status == 'free'      ? 'selected' : '' }}>🆓 Free</option>
            <option value="on_leave"  {{ $provider->status == 'on_leave'  ? 'selected' : '' }}>🚫 On Leave</option>
          </select>
        </form>
      </div>
    </div>

  </aside>

  {{-- ── MAIN PANEL ───────────────────────────────────────── --}}
  <main>
    <div class="card">
      <div class="panel-header">
        <div class="panel-title">Booking Requests</div>

        {{-- Tabs --}}
        <div class="tabs" id="bookingTabs">
          <button class="tab-btn active" data-tab="pending">
            <i class="fas fa-clock"></i> Pending
            <span class="tab-count">{{ $pendingBookings->count() }}</span>
          </button>
          <button class="tab-btn" data-tab="accepted">
            <i class="fas fa-check"></i> Accepted
            <span class="tab-count">{{ $acceptedBookings->count() }}</span>
          </button>
          <button class="tab-btn" data-tab="completed">
            <i class="fas fa-check-circle"></i> Completed
            <span class="tab-count">{{ $completedBookings->count() }}</span>
          </button>
        </div>
      </div>

      <div class="tab-content">

        {{-- PENDING --}}
        <div class="tab-pane active" id="tab-pending">
          @forelse($pendingBookings as $booking)
          <div class="booking-card">
            <div class="booking-card-header">
              <div>
                <div class="booking-number">Booking #{{ $booking->booking_number }}</div>
                <div class="booking-meta-row">
                  <span class="booking-meta-item">
                    <i class="fas fa-user"></i> {{ $booking->user->name }}
                  </span>
                  <span class="booking-meta-item">
                    <i class="fas fa-calendar"></i>
                    {{ date('d M Y', strtotime($booking->service_date)) }} at {{ date('h:i A', strtotime($booking->service_time)) }}
                  </span>
                  <span class="booking-meta-item">
                    <i class="fas fa-map-marker-alt"></i> {{ $booking->address }}
                  </span>
                </div>
              </div>
            </div>

            @if($booking->description)
            <div class="booking-desc">
              <strong>Note:</strong> {{ $booking->description }}
            </div>
            @endif

            <div class="booking-footer">
              @if($booking->expires_at > now())
                <span class="expiry-tag">
                  <i class="fas fa-hourglass-half"></i>
                  Expires in {{ now()->diffInMinutes($booking->expires_at) }} min
                </span>
                <div class="booking-actions">
                  <form action="{{ route('provider.accept', $booking) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-accept">
                      <i class="fas fa-check"></i> Accept
                    </button>
                  </form>
                  <form action="{{ route('provider.reject', $booking) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-reject">
                      <i class="fas fa-times"></i> Reject
                    </button>
                  </form>
                </div>
              @else
                <span class="badge-expired"><i class="fas fa-ban"></i> Expired</span>
              @endif
            </div>
          </div>
          @empty
          <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-inbox"></i></div>
            <div class="empty-title">No Pending Bookings</div>
            <div class="empty-sub">New requests will appear here as they come in.</div>
          </div>
          @endforelse
        </div>

        {{-- ACCEPTED --}}
        <div class="tab-pane" id="tab-accepted">
          @forelse($acceptedBookings as $booking)
          <div class="booking-card accepted">
            <div class="booking-card-header">
              <div>
                <div class="booking-number">Booking #{{ $booking->booking_number }}</div>
                <div class="booking-meta-row">
                  <span class="booking-meta-item">
                    <i class="fas fa-user"></i> {{ $booking->user->name }}
                  </span>
                  <span class="booking-meta-item">
                    <i class="fas fa-calendar"></i>
                    {{ date('d M Y', strtotime($booking->service_date)) }} at {{ date('h:i A', strtotime($booking->service_time)) }}
                  </span>
                  <span class="booking-meta-item">
                    <i class="fas fa-map-marker-alt"></i> {{ $booking->address }}
                  </span>
                </div>
              </div>
            </div>

            <div class="booking-footer">
              <span class="status-badge status-working">In Progress</span>
              <form action="{{ route('provider.complete', $booking) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-complete">
                  <i class="fas fa-check-circle"></i> Mark Completed
                </button>
              </form>
            </div>
          </div>
          @empty
          <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-clipboard-list"></i></div>
            <div class="empty-title">No Accepted Bookings</div>
            <div class="empty-sub">Accepted jobs will appear here.</div>
          </div>
          @endforelse
        </div>

        {{-- COMPLETED --}}
        <div class="tab-pane" id="tab-completed">
          @forelse($completedBookings as $booking)
          <div class="booking-card completed">
            <div>
              <div class="booking-number">Booking #{{ $booking->booking_number }}</div>
              <div class="booking-meta-row">
                <span class="booking-meta-item">
                  <i class="fas fa-user"></i> {{ $booking->user->name }}
                </span>
                <span class="booking-meta-item">
                  <i class="fas fa-calendar"></i>
                  {{ date('d M Y', strtotime($booking->service_date)) }} at {{ date('h:i A', strtotime($booking->service_time)) }}
                </span>
              </div>
            </div>

            @if($booking->review)
            <div class="review-block">
              <span class="stars">
                @for($i = 1; $i <= 5; $i++)
                  <i class="fas fa-star" style="{{ $i <= $booking->review->rating ? '' : 'opacity:0.3;' }}"></i>
                @endfor
              </span>
              {{ $booking->review->comment }}
            </div>
            @endif
          </div>
          @empty
          <div class="empty-state">
            <div class="empty-icon"><i class="fas fa-award"></i></div>
            <div class="empty-title">No Completed Jobs Yet</div>
            <div class="empty-sub">Finished bookings and reviews will show up here.</div>
          </div>
          @endforelse
        </div>

      </div>{{-- /tab-content --}}
    </div>{{-- /card --}}
  </main>

</div>{{-- /dash-body --}}

<script>
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
      btn.classList.add('active');
      document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
    });
  });
</script>

@endsection