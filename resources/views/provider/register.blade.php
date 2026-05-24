@extends('layouts.app')

@section('title', 'Become a Service Provider')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --ivory:      #FAF8F3;
    --cream:      #F3EFE6;
    --charcoal:   #1C1C1E;
    --ink:        #3A3A3C;
    --muted:      #6E6E73;
    --gold:       #C9913A;
    --gold-lt:    #F0D9B3;
    --gold-dk:    #8B6120;
    --teal:       #1A6B6B;
    --teal-lt:    #D1ECEC;
    --teal-dk:    #0D4444;
    --white:      #FFFFFF;
    --border:     rgba(0,0,0,0.10);
    --shadow-sm:  0 2px 12px rgba(0,0,0,0.07);
    --shadow-md:  0 8px 32px rgba(0,0,0,0.10);
    --radius:     11px;
    --radius-lg:  18px;
    --serif:      'Playfair Display', Georgia, serif;
    --sans:       'DM Sans', system-ui, sans-serif;
    --transition: 0.26s cubic-bezier(0.4, 0, 0.2, 1);
  }

  body {
    font-family: var(--sans);
    background: var(--ivory);
    color: var(--charcoal);
    line-height: 1.7;
  }

  /* ── PAGE HERO ───────────────────────────────────── */
  .page-hero {
    background: var(--charcoal);
    position: relative;
    overflow: hidden;
    padding: 64px 40px 56px;
    text-align: center;
  }

  .page-hero-bg {
    position: absolute; inset: 0;
    background:
      radial-gradient(ellipse 60% 80% at 85% 50%, rgba(201,145,58,0.15) 0%, transparent 65%),
      radial-gradient(ellipse 50% 70% at 10% 60%, rgba(26,107,107,0.18) 0%, transparent 65%),
      linear-gradient(135deg, #1C1C1E 0%, #22272A 100%);
  }

  .hero-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(201,145,58,0.10);
    pointer-events: none;
  }
  .hr1 { width: 380px; height: 380px; top: -160px; right: -60px; }
  .hr2 { width: 200px; height: 200px; top: -50px; right: 80px; border-color: rgba(201,145,58,0.18); }
  .hr3 { width: 160px; height: 160px; bottom: -60px; left: 40px; border-color: rgba(26,107,107,0.25); }

  .page-hero-inner { position: relative; z-index: 2; }

  .hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 14px;
  }
  .hero-eyebrow span { width: 22px; height: 1px; background: var(--gold); display: block; }

  .page-hero h1 {
    font-family: var(--serif);
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 700;
    color: var(--white);
    line-height: 1.2;
    margin-bottom: 12px;
  }

  .page-hero h1 em { font-style: normal; color: var(--gold); }

  .page-hero p {
    font-size: 0.95rem;
    color: rgba(255,255,255,0.50);
    max-width: 460px;
    margin: 0 auto;
    font-weight: 300;
  }

  /* trust pills */
  .hero-pills {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 24px;
  }

  .hero-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.12);
    font-size: 0.75rem;
    font-weight: 500;
    color: rgba(255,255,255,0.60);
    background: rgba(255,255,255,0.04);
  }

  .hero-pill i { color: var(--gold); font-size: 0.7rem; }

  /* ── LAYOUT ──────────────────────────────────────── */
  .page-body {
    max-width: 1100px;
    margin: 0 auto;
    padding: 52px 24px 80px;
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 40px;
    align-items: start;
  }

  /* ── SIDEBAR ─────────────────────────────────────── */
  .form-sidebar {
    position: sticky;
    top: 30px;
  }

  .sidebar-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 28px 22px;
    margin-bottom: 18px;
  }

  .sidebar-title {
    font-family: var(--serif);
    font-size: 1rem;
    font-weight: 600;
    color: var(--charcoal);
    margin-bottom: 16px;
  }

  .sidebar-steps { display: flex; flex-direction: column; gap: 14px; }

  .sidebar-step {
    display: flex;
    align-items: flex-start;
    gap: 12px;
  }

  .step-dot {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: var(--cream);
    border: 1.5px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.72rem;
    font-weight: 700;
    color: var(--muted);
    flex-shrink: 0;
    margin-top: 1px;
  }

  .step-dot.active {
    background: var(--teal);
    border-color: var(--teal);
    color: var(--white);
  }

  .step-label { font-size: 0.82rem; font-weight: 500; color: var(--charcoal); }
  .step-sub   { font-size: 0.75rem; color: var(--muted); line-height: 1.45; }

  .sidebar-note {
    background: #FEF3C7;
    border: 1px solid #FDE68A;
    border-radius: var(--radius);
    padding: 14px 16px;
    font-size: 0.8rem;
    color: #78350F;
    line-height: 1.55;
    display: flex;
    gap: 10px;
    align-items: flex-start;
  }

  .sidebar-note i { color: #D97706; margin-top: 2px; flex-shrink: 0; }

  /* ── FORM CARD ───────────────────────────────────── */
  .form-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
  }

  /* section header */
  .form-section-head {
    padding: 20px 32px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--cream);
  }

  .form-section-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: var(--teal-lt);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .form-section-icon i { color: var(--teal); font-size: 0.85rem; }

  .form-section-label {
    font-weight: 600;
    font-size: 0.92rem;
    color: var(--charcoal);
  }

  .form-section-sub {
    font-size: 0.75rem;
    color: var(--muted);
    margin-top: 1px;
  }

  /* form body */
  .form-body { padding: 32px; }

  .form-row {
    display: grid;
    gap: 20px;
    margin-bottom: 20px;
  }

  .form-row.cols-2 { grid-template-columns: 1fr 1fr; }
  .form-row.cols-3 { grid-template-columns: 1fr 1fr 1fr; }
  .form-row.cols-1 { grid-template-columns: 1fr; }

  /* field */
  .field { display: flex; flex-direction: column; }

  .field label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--ink);
    margin-bottom: 7px;
  }

  .field label .req { color: var(--gold); margin-left: 2px; }

  .field-wrap { position: relative; }

  .field-icon {
    position: absolute;
    left: 13px;
    top: 50%;
    transform: translateY(-50%);
    color: #C0BDB8;
    font-size: 0.8rem;
    pointer-events: none;
    transition: color var(--transition);
  }

  .field-icon.top { top: 14px; transform: none; }

  .field input,
  .field select,
  .field textarea {
    width: 100%;
    padding: 12px 14px 12px 38px;
    border-radius: var(--radius);
    border: 1.5px solid var(--border);
    background: var(--ivory);
    color: var(--charcoal);
    font-family: var(--sans);
    font-size: 0.9rem;
    transition: border-color var(--transition), box-shadow var(--transition), background var(--transition);
    outline: none;
    -webkit-appearance: none;
  }

  .field textarea { padding-left: 38px; resize: vertical; }
  .field select    { padding-right: 36px; cursor: pointer; }

  .field input::placeholder,
  .field textarea::placeholder { color: #C0BDB8; }

  .field input:focus,
  .field select:focus,
  .field textarea:focus {
    border-color: var(--teal);
    background: var(--white);
    box-shadow: 0 0 0 3px rgba(26,107,107,0.09);
  }

  .field input:focus ~ .field-icon,
  .field select:focus ~ .field-icon,
  .field textarea:focus ~ .field-icon,
  .field-wrap:focus-within .field-icon { color: var(--teal); }

  /* error state */
  .field input.is-invalid,
  .field select.is-invalid,
  .field textarea.is-invalid {
    border-color: #E24B4A;
    background: #FFF5F5;
  }

  .invalid-msg {
    font-size: 0.76rem;
    color: #C0392B;
    margin-top: 5px;
    display: flex;
    align-items: center;
    gap: 4px;
  }

  /* section divider */
  .form-divider {
    border: none;
    border-top: 1px solid var(--border);
    margin: 28px 0;
  }

  /* review note */
  .review-note {
    background: var(--teal-lt);
    border: 1px solid rgba(26,107,107,0.20);
    border-radius: var(--radius);
    padding: 14px 18px;
    font-size: 0.83rem;
    color: var(--teal-dk);
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 28px;
    line-height: 1.55;
  }

  .review-note i { margin-top: 2px; flex-shrink: 0; }

  /* validation errors */
  .errors-box {
    background: #FEE2E2;
    border: 1px solid #FECACA;
    border-radius: var(--radius);
    padding: 14px 18px;
    margin-bottom: 24px;
    font-size: 0.83rem;
    color: #991B1B;
  }

  .errors-box ul { padding-left: 16px; margin: 0; }
  .errors-box li { margin-bottom: 3px; }

  /* submit area */
  .form-actions {
    display: flex;
    gap: 14px;
    padding: 24px 32px;
    border-top: 1px solid var(--border);
    background: var(--cream);
    align-items: center;
    flex-wrap: wrap;
  }

  .btn-submit {
    padding: 13px 32px;
    border-radius: var(--radius);
    background: var(--charcoal);
    color: var(--white);
    font-family: var(--sans);
    font-size: 0.92rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    box-shadow: 0 4px 16px rgba(28,28,30,0.18);
    text-decoration: none;
  }

  .btn-submit:hover {
    background: var(--teal);
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(26,107,107,0.25);
    color: var(--white);
  }

  .btn-cancel {
    padding: 13px 24px;
    border-radius: var(--radius);
    background: transparent;
    color: var(--muted);
    font-family: var(--sans);
    font-size: 0.9rem;
    font-weight: 500;
    border: 1.5px solid var(--border);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    text-decoration: none;
    transition: all var(--transition);
  }

  .btn-cancel:hover {
    border-color: #C0BDB8;
    color: var(--ink);
    background: var(--ivory);
  }

  .action-note {
    margin-left: auto;
    font-size: 0.78rem;
    color: var(--muted);
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .action-note i { color: var(--teal); }

  /* ── RESPONSIVE ──────────────────────────────────── */
  @media (max-width: 860px) {
    .page-body { grid-template-columns: 1fr; }
    .form-sidebar { position: static; }
    .form-sidebar .sidebar-card { display: none; }
  }

  @media (max-width: 600px) {
    .form-row.cols-2,
    .form-row.cols-3 { grid-template-columns: 1fr; }
    .form-body { padding: 22px 18px; }
    .form-actions { padding: 18px; flex-direction: column; }
    .btn-submit, .btn-cancel { width: 100%; justify-content: center; }
    .action-note { margin: 0; }
    .page-hero { padding: 48px 20px 40px; }
  }

  /* ── ANIMATIONS ──────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .form-card { animation: fadeUp 0.5s 0.1s both; }
  .form-sidebar { animation: fadeUp 0.5s 0.05s both; }
</style>

{{-- PAGE HERO --}}
<div class="page-hero">
  <div class="page-hero-bg"></div>
  <div class="hero-ring hr1"></div>
  <div class="hero-ring hr2"></div>
  <div class="hero-ring hr3"></div>
  <div class="page-hero-inner">
    <div class="hero-eyebrow"><span></span> Join Our Network</div>
    <h1>Become a <em>Service Provider</em></h1>
    <p>Register your business, get verified, and start receiving bookings from thousands of homeowners near you.</p>
    <div class="hero-pills">
      <div class="hero-pill"><i class="fas fa-shield-halved"></i> Free to Register</div>
      <div class="hero-pill"><i class="fas fa-bolt"></i> Quick Approval</div>
      <div class="hero-pill"><i class="fas fa-indian-rupee-sign"></i> No Commission Fees</div>
      <div class="hero-pill"><i class="fas fa-users"></i> 10,000+ Customers</div>
    </div>
  </div>
</div>

<div class="page-body">

  {{-- SIDEBAR --}}
  <aside class="form-sidebar">
    <div class="sidebar-card">
      <div class="sidebar-title">Application Steps</div>
      <div class="sidebar-steps">
        <div class="sidebar-step">
          <div class="step-dot active">1</div>
          <div>
            <div class="step-label">Fill this form</div>
            <div class="step-sub">Provide your business and personal details.</div>
          </div>
        </div>
        <div class="sidebar-step">
          <div class="step-dot">2</div>
          <div>
            <div class="step-label">Admin review</div>
            <div class="step-sub">We verify your credentials, usually within 24 hrs.</div>
          </div>
        </div>
        <div class="sidebar-step">
          <div class="step-dot">3</div>
          <div>
            <div class="step-label">Get approved</div>
            <div class="step-sub">Your profile goes live and bookings begin.</div>
          </div>
        </div>
        <div class="sidebar-step">
          <div class="step-dot">4</div>
          <div>
            <div class="step-label">Grow your business</div>
            <div class="step-sub">Manage jobs, collect reviews, earn more.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="sidebar-note">
      <i class="fas fa-circle-info"></i>
      Your application is reviewed by our admin team. You'll receive an email notification once your account is approved.
    </div>
  </aside>

  {{-- FORM CARD --}}
  <div class="form-card">

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="form-body" style="padding-bottom:0;">
      <div class="errors-box">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    @endif

    <form action="{{ route('provider.register.submit') }}" method="POST" enctype="multipart/form-data">
      @csrf

      {{-- ── SECTION: ACCOUNT ── --}}
      <div class="form-section-head">
        <div class="form-section-icon"><i class="fas fa-user"></i></div>
        <div>
          <div class="form-section-label">Account Details</div>
          <div class="form-section-sub">Your personal login information</div>
        </div>
      </div>
      <div class="form-body">
        <div class="form-row cols-2">
          <div class="field">
            <label>Full Name <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required
                     class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
              <i class="fas fa-user field-icon"></i>
            </div>
            @error('name')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label>Email Address <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" required
                     class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
              <i class="fas fa-envelope field-icon"></i>
            </div>
            @error('email')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-row cols-2">
          <div class="field">
            <label>Password <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="password" name="password" placeholder="••••••••" required
                     class="{{ $errors->has('password') ? 'is-invalid' : '' }}">
              <i class="fas fa-lock field-icon"></i>
            </div>
            @error('password')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label>Confirm Password <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="password" name="password_confirmation" placeholder="••••••••" required>
              <i class="fas fa-lock field-icon"></i>
            </div>
          </div>
        </div>
      </div>

      {{-- ── SECTION: BUSINESS ── --}}
      <div class="form-section-head">
        <div class="form-section-icon"><i class="fas fa-briefcase"></i></div>
        <div>
          <div class="form-section-label">Business Information</div>
          <div class="form-section-sub">Details about your service and pricing</div>
        </div>
      </div>
      <div class="form-body">
        <div class="form-row cols-2">
          <div class="field">
            <label>Business Name <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="text" name="business_name" value="{{ old('business_name') }}" placeholder="e.g. Bright Spark Electricals" required
                     class="{{ $errors->has('business_name') ? 'is-invalid' : '' }}">
              <i class="fas fa-building field-icon"></i>
            </div>
            @error('business_name')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label>Service Category <span class="req">*</span></label>
            <div class="field-wrap">
              <select name="service_category_id" required
                      class="{{ $errors->has('service_category_id') ? 'is-invalid' : '' }}">
                <option value="">Select a category…</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ old('service_category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
              <i class="fas fa-tag field-icon"></i>
            </div>
            @error('service_category_id')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-row cols-2">
          <div class="field">
            <label>Phone Number <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+91 98765 43210" required
                     class="{{ $errors->has('phone') ? 'is-invalid' : '' }}">
              <i class="fas fa-phone field-icon"></i>
            </div>
            @error('phone')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label>Base Price (₹) <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="number" step="0.01" name="base_price" value="{{ old('base_price') }}" placeholder="500" required
                     class="{{ $errors->has('base_price') ? 'is-invalid' : '' }}">
              <i class="fas fa-indian-rupee-sign field-icon"></i>
            </div>
            @error('base_price')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-row cols-2">
          <div class="field">
            <label>Business Description <span class="req">*</span></label>
            <div class="field-wrap">
              <textarea name="description" rows="4" required placeholder="Describe your services, specializations, equipment used…"
                        class="{{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description') }}</textarea>
              <i class="fas fa-align-left field-icon top"></i>
            </div>
            @error('description')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label>Years of Experience</label>
            <div class="field-wrap">
              <input type="text" name="experience" value="{{ old('experience') }}" placeholder="e.g. 5 years">
              <i class="fas fa-clock field-icon"></i>
            </div>
          </div>
        </div>
      </div>

      {{-- ── SECTION: LOCATION ── --}}
      <div class="form-section-head">
        <div class="form-section-icon"><i class="fas fa-map-marker-alt"></i></div>
        <div>
          <div class="form-section-label">Location & Service Area</div>
          <div class="form-section-sub">Where you operate and can be found</div>
        </div>
      </div>
      <div class="form-body">
        <div class="form-row cols-3">
          <div class="field">
            <label>City <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="text" name="city" value="{{ old('city') }}" placeholder="Mumbai" required
                     class="{{ $errors->has('city') ? 'is-invalid' : '' }}">
              <i class="fas fa-city field-icon"></i>
            </div>
            @error('city')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label>Area / Locality <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="text" name="area" value="{{ old('area') }}" placeholder="Andheri West" required
                     class="{{ $errors->has('area') ? 'is-invalid' : '' }}">
              <i class="fas fa-location-dot field-icon"></i>
            </div>
            @error('area')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
          <div class="field">
            <label>Pincode <span class="req">*</span></label>
            <div class="field-wrap">
              <input type="text" name="pincode" value="{{ old('pincode') }}" placeholder="400053" required
                     class="{{ $errors->has('pincode') ? 'is-invalid' : '' }}">
              <i class="fas fa-hashtag field-icon"></i>
            </div>
            @error('pincode')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="form-row cols-1">
          <div class="field">
            <label>Full Address <span class="req">*</span></label>
            <div class="field-wrap">
              <textarea name="address" rows="2" required placeholder="Shop No. / Building name, Street, Locality…"
                        class="{{ $errors->has('address') ? 'is-invalid' : '' }}">{{ old('address') }}</textarea>
              <i class="fas fa-map field-icon top"></i>
            </div>
            @error('address')<div class="invalid-msg"><i class="fas fa-circle-exclamation"></i>{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="review-note">
          <i class="fas fa-circle-info"></i>
          Your application will be reviewed by our admin team. You'll be notified via email once your account is approved — usually within 24 hours.
        </div>
      </div>

      {{-- ACTIONS --}}
      <div class="form-actions">
        <button type="submit" class="btn-submit">
          <i class="fas fa-paper-plane"></i> Submit Application
        </button>
        <a href="{{ route('home') }}" class="btn-cancel">
          <i class="fas fa-xmark"></i> Cancel
        </a>
        <div class="action-note">
          <i class="fas fa-lock"></i> Secure & encrypted
        </div>
      </div>

    </form>
  </div>

</div>

@endsection