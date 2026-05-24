@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')

{{-- ============================================================
     GOOGLE FONTS + FONT AWESOME
     ============================================================ --}}
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  /* ── ROOT TOKENS ──────────────────────────────────────── */
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
    padding-top: 48px !important;
    padding-bottom: 80px;
  }

  /* ── OUTER CARD ───────────────────────────────────────── */
  .col-md-8 > .card {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    animation: fadeUp 0.6s 0.05s both;
  }

  /* ── CARD HEADER ──────────────────────────────────────── */
  .col-md-8 > .card > .card-header.bg-primary {
    background: var(--charcoal) !important;
    position: relative;
    overflow: hidden;
    padding: 28px 32px;
    border-bottom: none;
  }

  .col-md-8 > .card > .card-header.bg-primary::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 70% 120% at 95% 50%, rgba(201,145,58,0.18) 0%, transparent 65%),
      radial-gradient(ellipse 40% 100% at 5%  80%, rgba(26,107,107,0.18) 0%, transparent 60%);
    pointer-events: none;
  }

  .col-md-8 > .card > .card-header h4 {
    position: relative;
    z-index: 1;
    font-family: var(--serif);
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--white);
    display: flex;
    align-items: center;
    gap: 10px;
    margin: 0;
  }

  .col-md-8 > .card > .card-header h4 i { color: var(--gold); }

  /* ── OUTER CARD BODY ──────────────────────────────────── */
  .col-md-8 > .card > .card-body {
    background: var(--white);
    padding: 32px !important;
  }

  /* ── BOOKING NUMBER + STATUS HERO ─────────────────────── */
  .text-center.mb-4 {
    background: var(--cream);
    border-radius: var(--radius-lg);
    padding: 24px 20px;
    margin-bottom: 28px !important;
  }

  .text-center.mb-4 h5 {
    font-family: var(--serif);
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--muted);
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    font-style: normal;
  }

  .text-center.mb-4 h5 strong,
  .text-center.mb-4 h5 .text-primary {
    font-family: var(--serif);
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--charcoal) !important;
    display: block;
    margin-top: 4px;
    letter-spacing: 0.04em;
  }

  /* status badge in hero */
  .text-center.mb-4 .badge {
    display: inline-block;
    padding: 7px 18px !important;
    border-radius: 20px;
    font-size: 12px !important;
    font-weight: 700 !important;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  /* Bootstrap badge colour overrides */
  .badge-warning  { background: #FEF3C7 !important; color: #92400E !important; }
  .badge-success  { background: #D1ECE4 !important; color: #0D6B47 !important; }
  .badge-danger   { background: #FEE2E2 !important; color: #B91C1C !important; }
  .badge-info     { background: var(--teal-lt) !important; color: var(--teal-dk) !important; }
  .badge-secondary{ background: #F3F4F6 !important; color: var(--muted) !important; }
  .badge-dark     { background: rgba(28,28,30,0.10) !important; color: var(--charcoal) !important; }

  /* ── INNER DETAIL CARDS ───────────────────────────────── */
  /* col-md-6 cards + Service Details card */
  .col-md-8 > .card > .card-body .card {
    border: 1px solid var(--border) !important;
    border-radius: var(--radius-lg) !important;
    box-shadow: var(--shadow-sm) !important;
    overflow: hidden;
    margin-bottom: 20px !important;
    position: relative;
  }

  /* left accent stripe on inner cards */
  .col-md-8 > .card > .card-body .card::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--teal);
    border-radius: 2px 0 0 2px;
  }

  /* inner card headers (bg-light) */
  .col-md-8 > .card > .card-body .card .card-header.bg-light {
    background: var(--ivory) !important;
    border-bottom: 1px solid var(--border) !important;
    padding: 14px 20px 14px 22px !important;
  }

  .col-md-8 > .card > .card-body .card .card-header strong {
    font-size: 11px !important;
    font-weight: 700 !important;
    letter-spacing: 0.09em !important;
    text-transform: uppercase !important;
    color: var(--muted) !important;
    display: flex;
    align-items: center;
    gap: 7px;
  }

  .col-md-8 > .card > .card-body .card .card-header strong i {
    color: var(--teal);
    font-size: 0.85rem;
  }

  /* inner card bodies */
  .col-md-8 > .card > .card-body .card .card-body {
    padding: 18px 20px 18px 22px !important;
    background: var(--white) !important;
  }

  .col-md-8 > .card > .card-body .card .card-body p {
    font-size: 0.87rem;
    color: var(--ink);
    margin-bottom: 8px !important;
    line-height: 1.6;
  }

  .col-md-8 > .card > .card-body .card .card-body p:last-child { margin-bottom: 0 !important; }

  .col-md-8 > .card > .card-body .card .card-body p strong {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--muted);
    display: inline-block;
    margin-right: 4px;
  }

  /* description paragraph (no label transform needed) */
  .col-md-8 > .card > .card-body .card .card-body p:has(strong:only-child) strong {
    font-size: inherit;
    text-transform: none;
    letter-spacing: 0;
  }

  /* ── FOOTER ACTIONS ───────────────────────────────────── */
  .d-flex.justify-content-between {
    display: flex !important;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    padding-top: 8px;
  }

  /* Cancel Booking */
  .btn.btn-danger {
    padding: 11px 20px !important;
    border-radius: var(--radius) !important;
    background: transparent !important;
    border: 1.5px solid #FCA5A5 !important;
    color: #B91C1C !important;
    font-family: var(--sans) !important;
    font-size: 0.85rem !important;
    font-weight: 600 !important;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    transition: all var(--transition) !important;
    box-shadow: none !important;
  }

  .btn.btn-danger:hover {
    background: #FEF2F2 !important;
    transform: translateY(-1px);
  }

  /* Write a Review */
  .btn.btn-primary[data-bs-target="#reviewModal"] {
    padding: 11px 20px !important;
    border-radius: var(--radius) !important;
    background: var(--gold) !important;
    border-color: var(--gold) !important;
    color: var(--charcoal) !important;
    font-family: var(--sans) !important;
    font-size: 0.85rem !important;
    font-weight: 700 !important;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    box-shadow: 0 4px 16px rgba(201,145,58,0.28) !important;
    transition: all var(--transition) !important;
  }

  .btn.btn-primary[data-bs-target="#reviewModal"]:hover {
    background: #D9A44A !important;
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(201,145,58,0.38) !important;
  }

  /* Back to Dashboard */
  .btn.btn-secondary {
    padding: 11px 20px !important;
    border-radius: var(--radius) !important;
    background: transparent !important;
    border: 1.5px solid var(--border) !important;
    color: var(--muted) !important;
    font-family: var(--sans) !important;
    font-size: 0.85rem !important;
    font-weight: 600 !important;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    transition: all var(--transition) !important;
    box-shadow: none !important;
  }

  .btn.btn-secondary:hover {
    background: var(--cream) !important;
    color: var(--ink) !important;
    transform: translateY(-1px);
  }

  /* ── STATUS ALERTS IN FOOTER ──────────────────────────── */
  /* expiry warning */
  .d-flex.justify-content-between .alert.alert-warning {
    background: #FEF9EC !important;
    border: 1px solid var(--gold-lt) !important;
    border-radius: var(--radius) !important;
    padding: 12px 16px !important;
    font-size: 0.83rem !important;
    color: var(--gold-dk) !important;
    display: inline-flex !important;
    align-items: center;
    gap: 8px;
    margin: 0 !important;
  }

  .d-flex.justify-content-between .alert.alert-warning i { color: var(--gold); flex-shrink: 0; }
  .d-flex.justify-content-between .alert.alert-warning #timer { font-weight: 700; color: var(--gold-dk); }

  /* accepted success */
  .d-flex.justify-content-between .alert.alert-success {
    background: #D1ECE4 !important;
    border: 1px solid #A7D7C5 !important;
    border-radius: var(--radius) !important;
    padding: 12px 16px !important;
    font-size: 0.83rem !important;
    color: #0D6B47 !important;
    display: inline-flex !important;
    align-items: center;
    gap: 8px;
    margin: 0 !important;
    font-weight: 600;
  }

  .d-flex.justify-content-between .alert.alert-success i { color: #0D6B47; }

  /* ── REVIEW MODAL ─────────────────────────────────────── */
  .modal-content {
    border: none !important;
    border-radius: var(--radius-lg) !important;
    overflow: hidden;
    box-shadow: var(--shadow-md) !important;
  }

  .modal-header {
    background: var(--charcoal) !important;
    border-bottom: none !important;
    padding: 22px 28px !important;
    position: relative;
    overflow: hidden;
  }

  .modal-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse 80% 120% at 100% 50%, rgba(201,145,58,0.16) 0%, transparent 65%);
    pointer-events: none;
  }

  .modal-header .modal-title {
    position: relative;
    z-index: 1;
    font-family: var(--serif);
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--white);
  }

  .modal-header .btn-close {
    position: relative;
    z-index: 1;
    filter: invert(1) opacity(0.6);
    transition: opacity var(--transition);
  }

  .modal-header .btn-close:hover { opacity: 1; }

  .modal-body {
    background: var(--white);
    padding: 26px 28px !important;
  }

  .modal-body .mb-3 { margin-bottom: 18px !important; }

  .modal-body label {
    display: block;
    font-size: 11px !important;
    font-weight: 700 !important;
    letter-spacing: 0.08em !important;
    text-transform: uppercase !important;
    color: var(--muted) !important;
    margin-bottom: 8px !important;
  }

  .modal-body .form-control {
    width: 100%;
    padding: 12px 14px !important;
    border-radius: var(--radius) !important;
    border: 1px solid var(--border) !important;
    background: var(--ivory) !important;
    color: var(--charcoal) !important;
    font-family: var(--sans) !important;
    font-size: 0.9rem !important;
    outline: none;
    transition: border-color var(--transition), box-shadow var(--transition) !important;
    box-shadow: none !important;
    appearance: none !important;
    -webkit-appearance: none !important;
  }

  .modal-body select.form-control {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236E6E73' d='M6 8L1 3h10z'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 13px center !important;
    padding-right: 34px !important;
  }

  .modal-body .form-control:focus {
    border-color: var(--teal) !important;
    background: var(--white) !important;
    box-shadow: 0 0 0 3px rgba(26,107,107,0.10) !important;
  }

  .modal-body textarea.form-control { resize: vertical; }

  .modal-footer {
    background: var(--ivory) !important;
    border-top: 1px solid var(--border) !important;
    padding: 16px 28px !important;
    gap: 10px;
  }

  /* Close button in footer */
  .modal-footer .btn.btn-secondary {
    padding: 10px 20px !important;
    border-radius: var(--radius) !important;
    background: transparent !important;
    border: 1.5px solid var(--border) !important;
    color: var(--muted) !important;
    font-family: var(--sans) !important;
    font-size: 0.85rem !important;
    font-weight: 600 !important;
    box-shadow: none !important;
    transition: all var(--transition) !important;
  }

  .modal-footer .btn.btn-secondary:hover {
    background: var(--cream) !important;
    color: var(--ink) !important;
  }

  /* Submit Review button */
  .modal-footer .btn.btn-primary {
    padding: 10px 22px !important;
    border-radius: var(--radius) !important;
    background: var(--teal) !important;
    border-color: var(--teal) !important;
    color: var(--white) !important;
    font-family: var(--sans) !important;
    font-size: 0.85rem !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 14px rgba(26,107,107,0.24) !important;
    transition: all var(--transition) !important;
  }

  .modal-footer .btn.btn-primary:hover {
    background: var(--teal-dk) !important;
    border-color: var(--teal-dk) !important;
    transform: translateY(-1px);
  }

  /* ── ANIMATION ────────────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* ── RESPONSIVE ───────────────────────────────────────── */
  @media (max-width: 768px) {
    .container.mt-4 { padding: 24px 16px 60px !important; }
    .col-md-8 > .card > .card-body { padding: 20px 16px !important; }
    .col-md-8 > .card > .card-header.bg-primary { padding: 22px 20px; }
    .d-flex.justify-content-between { flex-direction: column; align-items: flex-start; }
    .col-md-6 { width: 100%; }
  }
</style>

{{-- ============================================================
     ORIGINAL CODE — UNTOUCHED BELOW THIS LINE
     ============================================================ --}}
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-ticket-alt"></i> Booking Details</h4>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h5>Booking Number: <strong class="text-primary">{{ $booking->booking_number }}</strong></h5>
                        <span class="badge badge-{{ $booking->status == 'pending' ? 'warning' : ($booking->status == 'accepted' ? 'success' : 'danger') }} p-2">
                            Status: {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <strong><i class="fas fa-user"></i> Customer Details</strong>
                                </div>
                                <div class="card-body">
                                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                                    <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                                    <p><strong>Address:</strong> {{ $booking->address }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <strong><i class="fas fa-store"></i> Service Provider Details</strong>
                                </div>
                                <div class="card-body">
                                    <p><strong>Business:</strong> {{ $booking->serviceProvider->business_name }}</p>
                                    <p><strong>Service:</strong> {{ $booking->category->name }}</p>
                                    <p><strong>Phone:</strong> {{ $booking->serviceProvider->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <strong><i class="fas fa-calendar"></i> Service Details</strong>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Service Date:</strong> {{ date('l, d M Y', strtotime($booking->service_date)) }}</p>
                                    <p><strong>Service Time:</strong> {{ date('h:i A', strtotime($booking->service_time)) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Created:</strong> {{ $booking->created_at->format('d M Y, h:i A') }}</p>
                                    <p><strong>Expires:</strong> {{ $booking->expires_at ? $booking->expires_at->format('d M Y, h:i A') : 'N/A' }}</p>
                                </div>
                            </div>
                            @if($booking->description)
                                <p><strong>Description:</strong> {{ $booking->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        @if($booking->status == 'pending')
                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                    <i class="fas fa-times"></i> Cancel Booking
                                </button>
                            </form>
                            
                            @if($booking->expires_at && $booking->expires_at > now())
                                <div class="alert alert-warning">
                                    <i class="fas fa-hourglass-half"></i> 
                                    Booking expires in <span id="timer">{{ $booking->expires_at->diffInMinutes(now()) }}</span> minutes
                                </div>
                            @endif
                        @elseif($booking->status == 'accepted')
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Your booking has been accepted!
                            </div>
                        @elseif($booking->status == 'completed')
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <i class="fas fa-star"></i> Write a Review
                            </a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Write a Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('reviews.store', $booking) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Rating</label>
                        <select name="rating" class="form-control" required>
                            <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                            <option value="4">⭐⭐⭐⭐ - Good</option>
                            <option value="3">⭐⭐⭐ - Average</option>
                            <option value="2">⭐⭐ - Poor</option>
                            <option value="1">⭐ - Terrible</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Comment</label>
                        <textarea name="comment" class="form-control" rows="3" placeholder="Share your experience..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if($booking->status == 'pending' && $booking->expires_at)
<script>
    function updateTimer() {
        const expiresAt = new Date('{{ $booking->expires_at }}');
        const now = new Date();
        const diff = Math.floor((expiresAt - now) / 60000);
        
        if (diff > 0) {
            document.getElementById('timer').textContent = diff;
            setTimeout(updateTimer, 60000);
        } else {
            location.reload();
        }
    }
    updateTimer();
</script>
@endif
@endpush