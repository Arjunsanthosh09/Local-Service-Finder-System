<x-guest-layout>

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
    --border:    rgba(0,0,0,0.10);
    --serif:     'Playfair Display', Georgia, serif;
    --sans:      'DM Sans', system-ui, sans-serif;
    --transition: 0.28s cubic-bezier(0.4, 0, 0.2, 1);
  }

  html, body {
    height: 100%;
    font-family: var(--sans);
  }

  /* ── FULL-PAGE LAYOUT ───────────────────────────────── */
  .login-page {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
  }

  /* ── LEFT PANEL (brand side) ───────────────────────── */
  .login-brand {
    position: relative;
    background: var(--charcoal);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 56px 60px;
    overflow: hidden;
  }

  .brand-bg {
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 70% 55% at 90% 20%, rgba(201,145,58,0.18) 0%, transparent 65%),
      radial-gradient(ellipse 60% 70% at 5% 90%, rgba(26,107,107,0.22) 0%, transparent 65%),
      linear-gradient(145deg, #1C1C1E 0%, #22272A 100%);
  }

  /* decorative rings */
  .brand-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(201,145,58,0.12);
    pointer-events: none;
  }
  .br1 { width: 420px; height: 420px; top: -140px; right: -100px; }
  .br2 { width: 220px; height: 220px; top: -30px; right:  60px; border-color: rgba(201,145,58,0.20); }
  .br3 { width: 180px; height: 180px; bottom: 60px; left: -40px; border-color: rgba(26,107,107,0.30); }

  .brand-content { position: relative; z-index: 2; }

  /* logo mark */
  .brand-logo {
    display: flex;
    align-items: center;
    gap: 11px;
    margin-bottom: 64px;
  }

  .brand-logo-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    color: var(--charcoal);
  }

  .brand-logo-text {
    font-family: var(--serif);
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--white);
    letter-spacing: -0.01em;
  }

  .brand-logo-text span { color: var(--gold); }

  .brand-eyebrow {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .brand-eyebrow::before {
    content: '';
    display: block;
    width: 24px;
    height: 1px;
    background: var(--gold);
  }

  .brand-heading {
    font-family: var(--serif);
    font-size: clamp(2rem, 3.5vw, 2.9rem);
    font-weight: 700;
    color: var(--white);
    line-height: 1.2;
    margin-bottom: 20px;
  }

  .brand-heading em {
    font-style: normal;
    color: var(--gold);
  }

  .brand-sub {
    font-size: 0.92rem;
    color: rgba(255,255,255,0.48);
    line-height: 1.7;
    max-width: 360px;
    margin-bottom: 48px;
    font-weight: 300;
  }

  /* feature list */
  .brand-features { display: flex; flex-direction: column; gap: 18px; }

  .brand-feature {
    display: flex;
    align-items: flex-start;
    gap: 14px;
  }

  .feature-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: rgba(201,145,58,0.13);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .feature-icon i { color: var(--gold); font-size: 0.85rem; }

  .feature-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--white);
    margin-bottom: 2px;
  }

  .feature-desc {
    font-size: 0.78rem;
    color: rgba(255,255,255,0.40);
    line-height: 1.5;
  }

  /* bottom stat strip */
  .brand-stats {
    position: relative;
    z-index: 2;
    display: flex;
    gap: 36px;
    padding-top: 36px;
    border-top: 1px solid rgba(255,255,255,0.08);
  }

  .brand-stat-value {
    font-family: var(--serif);
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--gold);
    display: block;
    line-height: 1.1;
  }

  .brand-stat-label {
    font-size: 11px;
    color: rgba(255,255,255,0.35);
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  /* ── RIGHT PANEL (form side) ────────────────────────── */
  .login-form-side {
    background: var(--ivory);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 60px 40px;
  }

  .login-form-wrap {
    width: 100%;
    max-width: 420px;
  }

  .form-header {
    margin-bottom: 36px;
  }

  .form-eyebrow {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    color: var(--teal);
    margin-bottom: 10px;
  }

  .form-title {
    font-family: var(--serif);
    font-size: 2rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.2;
    margin-bottom: 8px;
  }

  .form-sub {
    font-size: 0.88rem;
    color: var(--muted);
  }

  .form-sub a {
    color: var(--teal);
    font-weight: 500;
    text-decoration: none;
  }

  .form-sub a:hover { text-decoration: underline; }

  /* status/success message */
  .form-status {
    background: #D1F0E0;
    color: #0D6B47;
    border-radius: 10px;
    padding: 11px 16px;
    font-size: 0.84rem;
    font-weight: 500;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  /* validation errors */
  .validation-errors-wrap {
    background: #FEE2E2;
    color: #991B1B;
    border-radius: 10px;
    padding: 11px 16px;
    font-size: 0.84rem;
    margin-bottom: 20px;
  }

  /* field */
  .field {
    margin-bottom: 20px;
  }

  .field label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    color: var(--ink);
    margin-bottom: 8px;
  }

  .field-input-wrap {
    position: relative;
  }

  .field-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 0.85rem;
    pointer-events: none;
    transition: color var(--transition);
  }

  .field input {
    width: 100%;
    padding: 13px 16px 13px 42px;
    border-radius: 11px;
    border: 1.5px solid var(--border);
    background: var(--white);
    color: var(--charcoal);
    font-family: var(--sans);
    font-size: 0.92rem;
    transition: border-color var(--transition), box-shadow var(--transition);
    outline: none;
    -webkit-appearance: none;
  }

  .field input::placeholder { color: #B0AEA8; }

  .field input:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 3px rgba(26,107,107,0.10);
  }

  .field input:focus + .field-icon,
  .field-input-wrap:focus-within .field-icon {
    color: var(--teal);
  }

  /* remember me */
  .remember-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
  }

  .remember-label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-size: 0.85rem;
    color: var(--muted);
    font-weight: 400;
  }

  .remember-label input[type="checkbox"] {
    width: 17px;
    height: 17px;
    accent-color: var(--teal);
    cursor: pointer;
  }

  .forgot-link {
    font-size: 0.85rem;
    color: var(--teal);
    font-weight: 500;
    text-decoration: none;
  }

  .forgot-link:hover { text-decoration: underline; }

  /* submit button */
  .btn-login {
    width: 100%;
    padding: 14px;
    border-radius: 11px;
    background: var(--charcoal);
    color: var(--white);
    font-family: var(--sans);
    font-size: 0.95rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    box-shadow: 0 4px 18px rgba(28,28,30,0.18);
    letter-spacing: 0.02em;
  }

  .btn-login:hover {
    background: var(--teal);
    transform: translateY(-1px);
    box-shadow: 0 8px 28px rgba(26,107,107,0.28);
  }

  .btn-login:active { transform: translateY(0); }

  /* divider */
  .divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 24px 0;
    color: var(--muted);
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
  }

  .divider::before, .divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
  }

  /* register link */
  .register-prompt {
    text-align: center;
    font-size: 0.875rem;
    color: var(--muted);
  }

  .register-prompt a {
    color: var(--teal);
    font-weight: 600;
    text-decoration: none;
  }

  .register-prompt a:hover { text-decoration: underline; }

  /* ── ANIMATIONS ─────────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .login-form-wrap > * {
    animation: fadeUp 0.55s both;
  }
  .form-header       { animation-delay: 0.05s; }
  .field:nth-child(1){ animation-delay: 0.12s; }
  .field:nth-child(2){ animation-delay: 0.18s; }
  .remember-row      { animation-delay: 0.24s; }
  .btn-login         { animation-delay: 0.30s; }

  /* ── RESPONSIVE ─────────────────────────────────────── */
  @media (max-width: 900px) {
    .login-page { grid-template-columns: 1fr; }
    .login-brand { display: none; }
    .login-form-side { min-height: 100vh; }
  }

  @media (max-width: 480px) {
    .login-form-side { padding: 40px 22px; }
    .form-title { font-size: 1.6rem; }
  }
</style>

<div class="login-page">

  {{-- ── LEFT: BRAND PANEL ──────────────────────────── --}}
  <div class="login-brand">
    <div class="brand-bg"></div>
    <div class="brand-ring br1"></div>
    <div class="brand-ring br2"></div>
    <div class="brand-ring br3"></div>

    <div class="brand-content">
      <div class="brand-logo">
        <div class="brand-logo-icon"><i class="fas fa-tools"></i></div>
        <div class="brand-logo-text">Serv<span>Pro</span></div>
      </div>

      <div class="brand-eyebrow">Welcome back</div>
      <h2 class="brand-heading">Your Home,<br><em>Expertly Cared For</em></h2>
      <p class="brand-sub">
        Thousands of verified professionals are ready to help — log in to manage bookings, track jobs, and connect with trusted experts in your city.
      </p>

      <div class="brand-features">
        <div class="brand-feature">
          <div class="feature-icon"><i class="fas fa-user-shield"></i></div>
          <div>
            <div class="feature-title">Verified Professionals Only</div>
            <div class="feature-desc">Every provider is background-checked and license-verified.</div>
          </div>
        </div>
        <div class="brand-feature">
          <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
          <div>
            <div class="feature-title">Manage All Your Bookings</div>
            <div class="feature-desc">Track status, reschedule, or review completed jobs in one place.</div>
          </div>
        </div>
        <div class="brand-feature">
          <div class="feature-icon"><i class="fas fa-star"></i></div>
          <div>
            <div class="feature-title">Earn & Redeem Rewards</div>
            <div class="feature-desc">Loyalty points on every booking you make.</div>
          </div>
        </div>
      </div>
    </div>

    <div class="brand-stats">
      <div>
        <span class="brand-stat-value">3,200+</span>
        <span class="brand-stat-label">Professionals</span>
      </div>
      <div>
        <span class="brand-stat-value">98%</span>
        <span class="brand-stat-label">Satisfaction</span>
      </div>
      <div>
        <span class="brand-stat-value">50+</span>
        <span class="brand-stat-label">Cities</span>
      </div>
    </div>
  </div>

  {{-- ── RIGHT: FORM PANEL ───────────────────────────── --}}
  <div class="login-form-side">
    <div class="login-form-wrap">

      <div class="form-header">
        <div class="form-eyebrow">Secure Login</div>
        <h1 class="form-title">Sign in to your account</h1>
        <p class="form-sub">
          Don't have an account?
          @if (Route::has('register'))
            <a href="{{ route('register') }}">Create one free</a>
          @endif
        </p>
      </div>

      {{-- Validation Errors --}}
      <x-validation-errors class="validation-errors-wrap" />

      {{-- Session Status --}}
      @session('status')
        <div class="form-status">
          <i class="fas fa-circle-check"></i> {{ $value }}
        </div>
      @endsession

      <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="field">
          <label for="email">Email Address</label>
          <div class="field-input-wrap">
            <input
              id="email"
              type="email"
              name="email"
              placeholder="you@example.com"
              :value="old('email')"
              required
              autofocus
              autocomplete="username"
            />
            <i class="fas fa-envelope field-icon"></i>
          </div>
        </div>

        {{-- Password --}}
        <div class="field">
          <label for="password">Password</label>
          <div class="field-input-wrap">
            <input
              id="password"
              type="password"
              name="password"
              placeholder="••••••••••"
              required
              autocomplete="current-password"
            />
            <i class="fas fa-lock field-icon"></i>
          </div>
        </div>

        {{-- Remember + Forgot --}}
        <div class="remember-row">
          <label class="remember-label">
            <x-checkbox id="remember_me" name="remember" />
            Remember me
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
          @endif
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login">
          <i class="fas fa-arrow-right-to-bracket"></i>
          Sign In
        </button>
      </form>

    </div>
  </div>

</div>

</x-guest-layout>