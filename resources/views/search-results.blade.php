@extends('layouts.app')

@section('title', 'Search Results')

@section('content')

{{-- ============================================================
     GOOGLE FONTS + FONT AWESOME
     ============================================================ --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  /* ── ROOT TOKENS (same as homepage) ──────────────────── */
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
  }

  /* ── PAGE WRAPPER ─────────────────────────────────────── */
  .container.mt-4 {
    max-width: 1200px;
    padding-top: 40px !important;
    padding-bottom: 80px;
  }

  /* ══════════════════════════════════════════════════════
     FILTER SIDEBAR
  ══════════════════════════════════════════════════════ */
  .col-md-3 .card {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }

  /* header */
  .col-md-3 .card-header.bg-primary {
    background: var(--charcoal) !important;
    padding: 18px 22px;
    border-bottom: 1px solid rgba(255,255,255,0.08);
  }

  .col-md-3 .card-header h5 {
    font-family: var(--serif);
    font-size: 1rem;
    font-weight: 600;
    color: var(--white);
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .col-md-3 .card-header h5 i { color: var(--gold); }

  .col-md-3 .card-body {
    background: var(--white);
    padding: 22px 20px;
  }

  /* form labels */
  .col-md-3 .form-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 7px;
    display: block;
  }

  /* inputs & select */
  .col-md-3 .form-control {
    width: 100%;
    padding: 11px 14px;
    border-radius: var(--radius);
    border: 1px solid var(--border);
    background: var(--ivory);
    color: var(--charcoal);
    font-family: var(--sans);
    font-size: 0.88rem;
    outline: none;
    transition: border-color var(--transition), background var(--transition);
    appearance: none;
    -webkit-appearance: none;
  }

  .col-md-3 .form-control:focus {
    border-color: var(--teal);
    background: var(--white);
    box-shadow: none;
  }

  select.form-control {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236E6E73' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 13px center;
    padding-right: 34px;
  }

  .col-md-3 .mb-3 { margin-bottom: 16px !important; }

  /* Apply Filters button */
  .col-md-3 .btn.btn-primary.w-100 {
    width: 100% !important;
    padding: 12px !important;
    border-radius: var(--radius) !important;
    background: var(--teal) !important;
    border-color: var(--teal) !important;
    color: var(--white) !important;
    font-family: var(--sans) !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    box-shadow: 0 4px 16px rgba(26,107,107,0.22);
    transition: background var(--transition), transform var(--transition) !important;
    margin-top: 4px;
  }

  .col-md-3 .btn.btn-primary.w-100:hover {
    background: var(--teal-dk) !important;
    transform: translateY(-1px);
  }

  /* Reset button */
  .col-md-3 .btn.btn-secondary.w-100 {
    width: 100% !important;
    padding: 11px !important;
    border-radius: var(--radius) !important;
    background: transparent !important;
    border: 1.5px solid var(--border) !important;
    color: var(--muted) !important;
    font-family: var(--sans) !important;
    font-size: 0.85rem !important;
    font-weight: 500 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    transition: all var(--transition) !important;
  }

  .col-md-3 .btn.btn-secondary.w-100:hover {
    background: var(--cream) !important;
    border-color: var(--border) !important;
    color: var(--ink) !important;
  }

  /* ══════════════════════════════════════════════════════
     RESULTS HEADER ROW
  ══════════════════════════════════════════════════════ */
  .col-md-9 .d-flex.justify-content-between.align-items-center.mb-3 {
    margin-bottom: 20px !important;
    padding: 16px 20px;
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
  }

  .col-md-9 h4 {
    font-family: var(--serif);
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--charcoal);
  }

  .col-md-9 h4 strong { color: var(--teal); }

  /* Sort dropdown */
  .btn.btn-outline-secondary.dropdown-toggle {
    padding: 9px 16px !important;
    border-radius: var(--radius) !important;
    border: 1.5px solid var(--border) !important;
    background: var(--ivory) !important;
    color: var(--ink) !important;
    font-family: var(--sans) !important;
    font-size: 0.82rem !important;
    font-weight: 600 !important;
    transition: all var(--transition) !important;
    box-shadow: none !important;
  }

  .btn.btn-outline-secondary.dropdown-toggle:hover {
    background: var(--cream) !important;
    border-color: var(--teal) !important;
    color: var(--teal) !important;
  }

  .dropdown-menu {
    border: 1px solid var(--border) !important;
    border-radius: var(--radius) !important;
    box-shadow: var(--shadow-md) !important;
    padding: 6px !important;
    font-family: var(--sans) !important;
    font-size: 0.85rem !important;
  }

  .dropdown-item {
    border-radius: 9px !important;
    padding: 9px 14px !important;
    color: var(--ink) !important;
    font-weight: 500 !important;
    transition: background var(--transition) !important;
  }

  .dropdown-item:hover {
    background: var(--cream) !important;
    color: var(--teal) !important;
  }

  /* ══════════════════════════════════════════════════════
     PROVIDER CARDS
  ══════════════════════════════════════════════════════ */
  .col-md-9 .row .col-md-6 { margin-bottom: 0 !important; }
  .col-md-9 .row { gap: 0; row-gap: 20px; }

  .service-card {
    border: 1px solid var(--border) !important;
    border-radius: var(--radius-lg) !important;
    box-shadow: var(--shadow-sm) !important;
    background: var(--white) !important;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition) !important;
    position: relative;
    overflow: hidden;
  }

  /* left accent stripe (same as booking-card in provider dashboard) */
  .service-card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--teal);
    border-radius: 2px 0 0 2px;
  }

  .service-card:hover {
    transform: translateY(-4px) !important;
    box-shadow: var(--shadow-md) !important;
    border-color: rgba(26,107,107,0.22) !important;
  }

  .service-card .card-body {
    padding: 22px 22px 20px 26px !important;
  }

  /* business name */
  .service-card .card-title {
    font-family: var(--serif) !important;
    font-size: 1rem !important;
    font-weight: 600 !important;
    color: var(--charcoal) !important;
    margin-bottom: 0 !important;
  }

  /* category badge (bg-info) */
  .service-card .badge.bg-info {
    background: var(--teal-lt) !important;
    color: var(--teal-dk) !important;
    font-size: 10px !important;
    font-weight: 700 !important;
    letter-spacing: 0.05em !important;
    text-transform: uppercase !important;
    padding: 4px 10px !important;
    border-radius: 20px !important;
  }

  /* meta text (user / location / phone) */
  .service-card .text-muted.small {
    font-size: 0.8rem !important;
    color: var(--muted) !important;
    line-height: 1.9 !important;
  }

  .service-card .text-muted.small i {
    color: var(--teal);
    font-size: 0.75rem;
    width: 14px;
    text-align: center;
    margin-right: 3px;
  }

  /* description */
  .service-card .card-text.small {
    font-size: 0.82rem !important;
    color: var(--ink) !important;
    line-height: 1.6 !important;
    background: var(--cream);
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 12px !important;
  }

  /* experience / base price */
  .service-card .mb-2:last-of-type {
    font-size: 0.82rem;
    color: var(--ink);
    line-height: 1.8;
  }

  .service-card .mb-2:last-of-type strong {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--muted);
  }

  .service-card .text-success.fw-bold {
    color: var(--teal) !important;
    font-weight: 700 !important;
    font-size: 0.95rem !important;
  }

  /* rating row */
  .service-card .d-flex.justify-content-between.align-items-center {
    padding-top: 12px;
    border-top: 1px solid var(--border);
    margin-top: 12px;
  }

  .service-card .fa-star.text-warning { color: #F59E0B !important; }

  .service-card .d-flex > div strong {
    font-family: var(--serif);
    font-size: 0.95rem;
    color: var(--charcoal);
  }

  .service-card .d-flex > div small {
    font-size: 0.75rem;
    color: var(--muted);
  }

  /* Book Now / Login to Book buttons */
  .service-card .btn.btn-primary.btn-sm {
    padding: 8px 18px !important;
    border-radius: 10px !important;
    background: var(--charcoal) !important;
    border-color: var(--charcoal) !important;
    color: var(--white) !important;
    font-family: var(--sans) !important;
    font-size: 0.78rem !important;
    font-weight: 600 !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition) !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.14);
  }

  .service-card .btn.btn-primary.btn-sm:hover {
    background: var(--teal) !important;
    border-color: var(--teal) !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(26,107,107,0.30) !important;
  }

  /* ── STATUS BADGES ────────────────────────────────────── */
  .status-badge {
    display: inline-block;
    padding: 4px 11px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    white-space: nowrap;
  }

  .status-active, .status-available, .status-verified {
    background: #D1ECE4; color: #0D6B47;
  }
  .status-working  { background: var(--teal-lt); color: var(--teal-dk); }
  .status-free     { background: var(--gold-lt);  color: var(--gold-dk); }
  .status-pending  { background: #FEF3C7; color: #92400E; }
  .status-on_leave,
  .status-inactive { background: #F3F4F6; color: var(--muted); }

  /* ── PAGINATION ───────────────────────────────────────── */
  .d-flex.justify-content-center.mt-4 {
    padding-top: 8px;
  }

  .pagination .page-item .page-link {
    border-radius: 8px !important;
    margin: 0 2px;
    font-size: 0.82rem;
    font-family: var(--sans);
    color: var(--ink);
    border-color: var(--border);
    transition: all var(--transition);
  }

  .pagination .page-item.active .page-link {
    background: var(--teal) !important;
    border-color: var(--teal) !important;
    color: var(--white);
  }

  .pagination .page-item .page-link:hover {
    background: var(--cream);
    color: var(--teal);
    border-color: var(--teal);
  }

  /* ── ANIMATIONS ───────────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .col-md-3 { animation: fadeUp 0.6s 0.05s both; }
  .col-md-9 { animation: fadeUp 0.6s 0.18s both; }

  /* ── RESPONSIVE ───────────────────────────────────────── */
  @media (max-width: 768px) {
    .container.mt-4 { padding: 20px 16px 60px !important; }
    .col-md-3, .col-md-9 { width: 100%; }
  }
</style>

{{-- ============================================================
     ORIGINAL CODE — UNTOUCHED BELOW THIS LINE
     ============================================================ --}}
<div class="container mt-4">
    <div class="row">
        <!-- Sidebar Filters -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-filter"></i> Filters</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Service Type</label>
                            <select name="service" class="form-control">
                                <option value="">All Services</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->name }}" {{ request('service') == $category->name ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="{{ request('city') }}" placeholder="Enter city">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Area/Locality</label>
                            <input type="text" name="area" class="form-control" value="{{ request('area') }}" placeholder="Enter area">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Apply Filters
                        </button>
                        <a href="{{ route('search') }}" class="btn btn-secondary w-100 mt-2">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Found <strong>{{ $providers->total() }}</strong> Service Providers</h4>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Sort by
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Rating: High to Low</a></li>
                        <li><a class="dropdown-item" href="#">Price: Low to High</a></li>
                        <li><a class="dropdown-item" href="#">Experience: High to Low</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="row">
                @foreach($providers as $provider)
                <div class="col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">{{ $provider->business_name }}</h5>
                                <span class="status-badge status-{{ $provider->status }}">
                                    {{ ucfirst(str_replace('_', ' ', $provider->status)) }}
                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="badge bg-info">{{ $provider->category->name }}</span>
                            </div>
                            <p class="text-muted small">
                                <i class="fas fa-user"></i> {{ $provider->user->name }}<br>
                                <i class="fas fa-map-marker-alt"></i> {{ $provider->city }}, {{ $provider->area }} - {{ $provider->pincode }}<br>
                                <i class="fas fa-phone"></i> {{ $provider->phone }}
                            </p>
                            <p class="card-text small">{{ Str::limit($provider->description, 120) }}</p>
                            <div class="mb-2">
                                <strong>Experience:</strong> {{ $provider->experience ?? 'Not specified' }}<br>
                                <strong>Base Price:</strong> <span class="text-success fw-bold">₹{{ number_format($provider->base_price ?? 0) }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-star text-warning"></i> 
                                    <strong>{{ number_format($provider->rating, 1) }}</strong> 
                                    <small>({{ $provider->total_reviews }} reviews)</small>
                                </div>
                                @auth
                                    @if(auth()->user()->role == 'user')
                                    <a href="{{ route('bookings.create', $provider) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-calendar-check"></i> Book Now
                                    </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-sign-in-alt"></i> Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $providers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection