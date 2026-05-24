@extends('layouts.app')

@section('title', 'Book Service')

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
  .col-md-8 .card {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    animation: fadeUp 0.6s 0.05s both;
  }

  /* ── CARD HEADER ──────────────────────────────────────── */
  .card-header.bg-primary {
    background: var(--charcoal) !important;
    position: relative;
    overflow: hidden;
    padding: 28px 32px;
    border-bottom: none;
  }

  /* decorative radial glow behind header */
  .card-header.bg-primary::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 70% 120% at 95% 50%, rgba(201,145,58,0.18) 0%, transparent 65%),
      radial-gradient(ellipse 40% 100% at 5% 80%,  rgba(26,107,107,0.18) 0%, transparent 60%);
    pointer-events: none;
  }

  .card-header.bg-primary h4 {
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

  .card-header.bg-primary h4 i { color: var(--gold); }

  /* ── CARD BODY ────────────────────────────────────────── */
  .card .card-body {
    background: var(--white);
    padding: 32px !important;
  }

  /* ── PROVIDER INFO ALERT (alert-info) ─────────────────── */
  .alert.alert-info {
    background: var(--charcoal) !important;
    border: none !important;
    border-radius: var(--radius-lg) !important;
    padding: 24px 26px !important;
    margin-bottom: 28px !important;
    position: relative;
    overflow: hidden;
  }

  .alert.alert-info::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 120% at 100% 50%, rgba(201,145,58,0.14) 0%, transparent 65%),
      radial-gradient(ellipse 40% 100% at 0% 80%,   rgba(26,107,107,0.16) 0%, transparent 60%);
    pointer-events: none;
  }

  /* left accent stripe */
  .alert.alert-info::after {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--gold);
    border-radius: 2px 0 0 2px;
  }

  .alert.alert-info h5 {
    position: relative;
    z-index: 1;
    font-family: var(--serif);
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--white);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
  }

  .alert.alert-info h5 i { color: var(--gold); }

  .alert.alert-info hr {
    position: relative;
    z-index: 1;
    border: none;
    border-top: 1px solid rgba(255,255,255,0.12);
    margin: 0 0 16px;
  }

  .alert.alert-info .row {
    position: relative;
    z-index: 1;
  }

  .alert.alert-info .col-md-6 {
    font-size: 0.83rem;
    color: rgba(255,255,255,0.65);
    line-height: 2;
  }

  .alert.alert-info .col-md-6 strong { color: var(--white); font-weight: 600; }
  .alert.alert-info .col-md-6 i      { color: var(--gold); width: 16px; text-align: center; margin-right: 4px; }
  .alert.alert-info .text-warning     { color: #F59E0B !important; }

  /* ── FORM LABELS ──────────────────────────────────────── */
  .form-label {
    display: block;
    font-size: 11px !important;
    font-weight: 700 !important;
    letter-spacing: 0.08em !important;
    text-transform: uppercase !important;
    color: var(--muted) !important;
    margin-bottom: 8px !important;
  }

  .mb-3 { margin-bottom: 20px !important; }

  /* ── FORM CONTROLS ────────────────────────────────────── */
  .form-control {
    width: 100%;
    padding: 13px 16px !important;
    border-radius: var(--radius) !important;
    border: 1px solid var(--border) !important;
    background: var(--ivory) !important;
    color: var(--charcoal) !important;
    font-family: var(--sans) !important;
    font-size: 0.9rem !important;
    outline: none;
    transition: border-color var(--transition), background var(--transition), box-shadow var(--transition) !important;
    box-shadow: none !important;
  }

  .form-control::placeholder { color: rgba(110,110,115,0.6) !important; }

  .form-control:focus {
    border-color: var(--teal) !important;
    background: var(--white) !important;
    box-shadow: 0 0 0 3px rgba(26,107,107,0.10) !important;
  }

  /* select arrow */
  select.form-control {
    appearance: none !important;
    -webkit-appearance: none !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236E6E73' d='M6 8L1 3h10z'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 14px center !important;
    padding-right: 36px !important;
  }

  /* date input */
  input[type="date"].form-control {
    color-scheme: light;
  }

  /* textarea */
  textarea.form-control { resize: vertical; min-height: 90px; }

  /* validation */
  .form-control.is-invalid {
    border-color: #F87171 !important;
    background-image: none !important;
  }

  .invalid-feedback {
    font-size: 0.78rem !important;
    color: #B91C1C !important;
    margin-top: 6px !important;
    display: block;
  }

  /* ── WARNING ALERT (expiry note) ──────────────────────── */
  .alert.alert-warning {
    background: #FEF9EC !important;
    border: 1px solid var(--gold-lt) !important;
    border-radius: var(--radius) !important;
    padding: 14px 18px !important;
    font-size: 0.85rem !important;
    color: var(--gold-dk) !important;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 24px !important;
  }

  .alert.alert-warning i {
    color: var(--gold);
    margin-top: 2px;
    flex-shrink: 0;
  }

  .alert.alert-warning strong { color: var(--gold-dk); font-weight: 700; }

  /* ── BUTTONS ──────────────────────────────────────────── */
  .d-grid.gap-2 { display: flex !important; flex-direction: column; gap: 12px !important; }

  /* Confirm Booking */
  .btn.btn-primary.btn-lg {
    padding: 15px 28px !important;
    border-radius: var(--radius) !important;
    background: var(--teal) !important;
    border-color: var(--teal) !important;
    color: var(--white) !important;
    font-family: var(--sans) !important;
    font-size: 0.98rem !important;
    font-weight: 700 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    box-shadow: 0 5px 20px rgba(26,107,107,0.28) !important;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition) !important;
  }

  .btn.btn-primary.btn-lg:hover {
    background: var(--teal-dk) !important;
    border-color: var(--teal-dk) !important;
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(26,107,107,0.36) !important;
  }

  /* Back to Search */
  .btn.btn-secondary {
    padding: 13px 28px !important;
    border-radius: var(--radius) !important;
    background: transparent !important;
    border: 1.5px solid var(--border) !important;
    color: var(--muted) !important;
    font-family: var(--sans) !important;
    font-size: 0.88rem !important;
    font-weight: 600 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all var(--transition) !important;
    box-shadow: none !important;
  }

  .btn.btn-secondary:hover {
    background: var(--cream) !important;
    border-color: var(--border) !important;
    color: var(--ink) !important;
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
    .card .card-body { padding: 22px 18px !important; }
    .card-header.bg-primary { padding: 22px 20px; }
    .alert.alert-info .col-md-6 { width: 100%; margin-bottom: 6px; }
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
                    <h4 class="mb-0"><i class="fas fa-calendar-plus"></i> Book Service</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="fas fa-store"></i> {{ $provider->business_name }}</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <i class="fas fa-tag"></i> <strong>Service:</strong> {{ $provider->category->name }}<br>
                                <i class="fas fa-star text-warning"></i> <strong>Rating:</strong> {{ number_format($provider->rating, 1) }} ({{ $provider->total_reviews }} reviews)
                            </div>
                            <div class="col-md-6">
                                <i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $provider->city }}, {{ $provider->area }}<br>
                                <i class="fas fa-rupee-sign"></i> <strong>Base Price:</strong> ₹{{ number_format($provider->base_price ?? 0) }}
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('bookings.store', $provider) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="service_date" class="form-label">Service Date *</label>
                            <input type="date" class="form-control @error('service_date') is-invalid @enderror" 
                                   id="service_date" name="service_date" required>
                            @error('service_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="service_time" class="form-label">Preferred Time *</label>
                            <select class="form-control @error('service_time') is-invalid @enderror" 
                                    id="service_time" name="service_time" required>
                                <option value="">Select Time</option>
                                <option value="09:00">09:00 AM - 10:00 AM</option>
                                <option value="10:00">10:00 AM - 11:00 AM</option>
                                <option value="11:00">11:00 AM - 12:00 PM</option>
                                <option value="12:00">12:00 PM - 01:00 PM</option>
                                <option value="14:00">02:00 PM - 03:00 PM</option>
                                <option value="15:00">03:00 PM - 04:00 PM</option>
                                <option value="16:00">04:00 PM - 05:00 PM</option>
                                <option value="17:00">05:00 PM - 06:00 PM</option>
                            </select>
                            @error('service_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Service Address *</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="3" required 
                                      placeholder="Enter your full address with landmark"></textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Service Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Describe the service you need (optional)"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-clock"></i> 
                            <strong>Important Note:</strong> This booking request will expire in <strong>1 hour</strong> if not accepted by the service provider.
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle"></i> Confirm Booking
                            </button>
                            <a href="{{ route('search') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Search
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Set minimum date to tomorrow
    const dateInput = document.getElementById('service_date');
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    dateInput.min = tomorrow.toISOString().split('T')[0];
    
    // Disable past dates
    dateInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        if (selectedDate < tomorrow) {
            alert('Please select a future date');
            this.value = '';
        }
    });
</script>
@endpush