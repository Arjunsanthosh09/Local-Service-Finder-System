@extends('layouts.app')

@section('title', 'My Dashboard')

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

  /* ── CONTAINER ────────────────────────────────────────── */
  .container.mt-4 {
    max-width: 1200px;
    padding-top: 40px !important;
    padding-bottom: 80px;
  }

  /* ── PROFILE CARD (left col) ──────────────────────────── */
  .col-md-3 .card {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }

  .col-md-3 .card-body {
    padding: 32px 24px;
    background: var(--white);
  }

  /* replace the generic user-circle icon with an initials avatar */
  .col-md-3 .card-body .fa-user-circle {
    display: none;
  }

  .col-md-3 .card-body::before {
    content: attr(data-initials, '?');
    display: flex;
    align-items: center;
    justify-content: center;
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--teal), var(--teal-dk));
    font-family: var(--serif);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--white);
    margin: 0 auto 18px;
  }

  .col-md-3 .card h5 {
    font-family: var(--serif);
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--charcoal);
    margin-bottom: 4px;
  }

  .col-md-3 .card .text-muted {
    font-size: 0.8rem;
    color: var(--muted) !important;
  }

  .col-md-3 .card hr {
    border: none;
    border-top: 1px solid var(--border);
    margin: 18px 0;
  }

  .col-md-3 .card p strong {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--muted);
  }

  .col-md-3 .card p {
    background: var(--cream);
    border-radius: 12px;
    padding: 14px;
    font-family: var(--serif);
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--gold);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    margin: 0;
  }

  /* ── MAIN CARD ────────────────────────────────────────── */
  .col-md-9 .card {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
  }

  .col-md-9 .card-header.bg-primary {
    background: var(--white) !important;
    border-bottom: 1px solid var(--border);
    padding: 22px 28px;
  }

  .col-md-9 .card-header h5 {
    font-family: var(--serif);
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--charcoal);
  }

  .col-md-9 .card-body {
    padding: 0;
    background: var(--white);
  }

  /* ── TABLE ────────────────────────────────────────────── */
  .table-responsive { overflow-x: auto; }

  .table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
    margin: 0;
  }

  .table thead tr {
    background: var(--ivory);
    border-bottom: 1px solid var(--border);
  }

  .table thead th {
    padding: 13px 18px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.09em;
    text-transform: uppercase;
    color: var(--muted);
    border: none;
    white-space: nowrap;
  }

  .table tbody tr {
    border-bottom: 1px solid var(--border);
    transition: background var(--transition);
  }

  .table tbody tr:last-child { border-bottom: none; }
  .table-hover tbody tr:hover { background: var(--cream) !important; }

  .table tbody td {
    padding: 16px 18px;
    vertical-align: middle;
    color: var(--ink);
    border: none;
  }

  /* booking number */
  .table tbody td strong {
    font-family: var(--serif);
    font-weight: 600;
    color: var(--charcoal);
    font-size: 0.9rem;
  }

  /* provider & category text */
  .table tbody td:nth-child(2) { font-weight: 600; color: var(--charcoal); }
  .table tbody td:nth-child(3) { color: var(--muted); font-size: 0.82rem; }

  /* date + small time */
  .table tbody td small {
    color: var(--muted);
    font-size: 0.78rem;
    display: block;
    margin-top: 1px;
  }

  /* expiry small */
  .table .text-danger {
    display: inline-flex !important;
    align-items: center;
    gap: 4px;
    font-size: 10px !important;
    font-weight: 600;
    color: #B45309 !important;
    background: #FEF3C7;
    padding: 3px 8px;
    border-radius: 20px;
    margin-top: 5px;
  }

  /* ── STATUS BADGES ────────────────────────────────────── */
  .badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  .badge.bg-warning  { background: #FEF3C7 !important; color: #92400E !important; }
  .badge.bg-success  { background: #D1ECE4 !important; color: #0D6B47 !important; }
  .badge.bg-info     { background: var(--teal-lt) !important; color: var(--teal-dk) !important; }
  .badge.bg-danger   { background: #FEE2E2 !important; color: #B91C1C !important; }
  .badge.bg-secondary{ background: #F3F4F6 !important; color: var(--muted) !important; }
  .badge.bg-dark     { background: rgba(28,28,30,0.10) !important; color: var(--charcoal) !important; }

  /* ── ACTION BUTTONS ───────────────────────────────────── */
  .btn.btn-sm {
    padding: 7px 14px !important;
    border-radius: 10px !important;
    font-family: var(--sans) !important;
    font-size: 0.78rem !important;
    font-weight: 600 !important;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition) !important;
    border: none !important;
  }

  .btn.btn-sm:hover { transform: translateY(-1px); }

  .btn-sm.btn-info {
    background: var(--charcoal) !important;
    color: var(--white) !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.14);
  }

  .btn-sm.btn-info:hover {
    background: var(--teal) !important;
    box-shadow: 0 5px 18px rgba(26,107,107,0.30) !important;
    color: var(--white) !important;
  }

  .btn-sm.btn-danger {
    background: transparent !important;
    color: #B91C1C !important;
    border: 1.5px solid #FCA5A5 !important;
    box-shadow: none !important;
  }

  .btn-sm.btn-danger:hover {
    background: #FEF2F2 !important;
    color: #B91C1C !important;
  }

  /* ── PAGINATION ───────────────────────────────────────── */
  nav[aria-label="pagination"],
  .pagination {
    padding: 16px 20px;
    border-top: 1px solid var(--border);
    display: flex;
    justify-content: flex-end;
  }

  .pagination .page-item .page-link {
    border-radius: 8px !important;
    margin: 0 2px;
    font-size: 0.82rem;
    font-family: var(--sans);
    color: var(--ink);
    border-color: var(--border);
  }

  .pagination .page-item.active .page-link {
    background: var(--teal) !important;
    border-color: var(--teal) !important;
    color: var(--white);
  }

  /* ── EMPTY STATE ──────────────────────────────────────── */
  .text-center.py-5 {
    padding: 56px 20px !important;
  }

  .text-center.py-5 .fa-calendar-times {
    display: block;
    width: 68px;
    height: 68px;
    line-height: 68px;
    border-radius: 20px;
    background: var(--cream);
    color: var(--muted) !important;
    font-size: 1.6rem !important;
    margin: 0 auto 18px !important;
    text-align: center;
  }

  .text-center.py-5 p {
    font-family: var(--serif);
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--charcoal);
    margin-bottom: 20px;
  }

  .text-center.py-5 .btn.btn-primary {
    padding: 12px 26px !important;
    border-radius: var(--radius) !important;
    background: var(--teal) !important;
    border-color: var(--teal) !important;
    color: var(--white) !important;
    font-family: var(--sans) !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    box-shadow: 0 4px 18px rgba(26,107,107,0.25);
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .text-center.py-5 .btn.btn-primary:hover {
    background: var(--teal-dk) !important;
    transform: translateY(-1px);
  }

  /* ── ANIMATION ────────────────────────────────────────── */
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
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user-circle fa-4x mb-3 text-primary"></i>
                    <h5>{{ Auth::user()->name }}</h5>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <hr>
                    <p><strong>Total Bookings:</strong> {{ Auth::user()->bookings->count() }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">My Bookings</h5>
                </div>
                <div class="card-body">
                    @if($bookings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Booking #</th>
                                        <th>Service Provider</th>
                                        <th>Service</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    <tr>
                                        <td><strong>{{ $booking->booking_number }}</strong></td>
                                        <td>{{ $booking->serviceProvider->business_name }}</td>
                                        <td>{{ $booking->category->name }}</td>
                                        <td>
                                            {{ date('d M Y', strtotime($booking->service_date)) }}<br>
                                            <small>{{ date('h:i A', strtotime($booking->service_time)) }}</small>
                                        </td>
                                        <td>
                                            @if($booking->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                                @if($booking->expires_at > now())
                                                    <small class="d-block text-danger">
                                                        Expires in {{ now()->diffInMinutes($booking->expires_at) }} min
                                                    </small>
                                                @endif
                                            @elseif($booking->status == 'accepted')
                                                <span class="badge bg-success">Accepted</span>
                                            @elseif($booking->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @elseif($booking->status == 'cancelled')
                                                <span class="badge bg-secondary">Cancelled</span>
                                            @elseif($booking->status == 'completed')
                                                <span class="badge bg-info">Completed</span>
                                            @elseif($booking->status == 'expired')
                                                <span class="badge bg-dark">Expired</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('bookings.show', $booking) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            @if($booking->status == 'pending')
                                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $bookings->links() }}
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                            <p>No bookings yet.</p>
                            <a href="{{ route('search') }}" class="btn btn-primary">Book a Service Now</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection