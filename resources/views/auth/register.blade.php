<x-guest-layout>

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
    --serif:      'Playfair Display', Georgia, serif;
    --sans:       'DM Sans', system-ui, sans-serif;
    --transition: 0.26s cubic-bezier(0.4, 0, 0.2, 1);
  }

  html, body { height: 100%; font-family: var(--sans); }

  /* ── FULL-PAGE SPLIT ─────────────────────────────── */
  .register-page {
    min-height: 100vh;
    display: grid;
    grid-template-columns: 1fr 1fr;
  }

  /* ── LEFT: BRAND PANEL ───────────────────────────── */
  .reg-brand {
    position: relative;
    background: var(--charcoal);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 52px 56px;
    overflow: hidden;
  }

  .brand-bg {
    position: absolute; inset: 0;
    background:
      radial-gradient(ellipse 65% 55% at 90% 15%, rgba(201,145,58,0.17) 0%, transparent 65%),
      radial-gradient(ellipse 55% 75% at 5% 85%, rgba(26,107,107,0.20) 0%, transparent 65%),
      linear-gradient(145deg, #1C1C1E 0%, #22272A 100%);
  }

  .brand-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(201,145,58,0.11);
    pointer-events: none;
  }
  .br1 { width: 400px; height: 400px; top: -150px; right: -90px; }
  .br2 { width: 210px; height: 210px; top: -30px;  right:  60px; border-color: rgba(201,145,58,0.20); }
  .br3 { width: 170px; height: 170px; bottom: 50px; left: -40px; border-color: rgba(26,107,107,0.28); }

  .brand-top { position: relative; z-index: 2; }

  .brand-logo {
    display: flex;
    align-items: center;
    gap: 11px;
    margin-bottom: 56px;
  }

  .brand-logo-icon {
    width: 42px; height: 42px;
    border-radius: 12px;
    background: var(--gold);
    display: flex; align-items: center; justify-content: center;
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
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 14px;
    display: flex; align-items: center; gap: 8px;
  }
  .brand-eyebrow::before {
    content: ''; display: block;
    width: 22px; height: 1px; background: var(--gold);
  }

  .brand-heading {
    font-family: var(--serif);
    font-size: clamp(1.9rem, 3vw, 2.6rem);
    font-weight: 700;
    color: var(--white);
    line-height: 1.2;
    margin-bottom: 16px;
  }
  .brand-heading em { font-style: normal; color: var(--gold); }

  .brand-sub {
    font-size: 0.88rem;
    color: rgba(255,255,255,0.45);
    line-height: 1.7;
    max-width: 340px;
    margin-bottom: 40px;
    font-weight: 300;
  }

  .brand-perks { display: flex; flex-direction: column; gap: 15px; }

  .brand-perk {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    border-radius: 11px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    transition: background var(--transition);
  }

  .brand-perk:hover { background: rgba(255,255,255,0.07); }

  .perk-icon {
    width: 34px; height: 34px;
    border-radius: 9px;
    background: rgba(201,145,58,0.13);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .perk-icon i { color: var(--gold); font-size: 0.82rem; }

  .perk-text { font-size: 0.84rem; color: rgba(255,255,255,0.68); font-weight: 400; }
  .perk-text strong { color: var(--white); font-weight: 600; display: block; font-size: 0.86rem; }

  .brand-bottom {
    position: relative; z-index: 2;
    display: flex;
    align-items: center;
    gap: 8px;
    padding-top: 28px;
    border-top: 1px solid rgba(255,255,255,0.08);
    font-size: 0.78rem;
    color: rgba(255,255,255,0.30);
  }

  .brand-bottom i { color: var(--teal); font-size: 0.75rem; }

  /* ── RIGHT: FORM PANEL ───────────────────────────── */
  .reg-form-side {
    background: var(--ivory);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px 40px;
    overflow-y: auto;
  }

  .reg-form-wrap {
    width: 100%;
    max-width: 440px;
  }

  /* form header */
  .form-header { margin-bottom: 28px; }

  .form-eyebrow {
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.11em; text-transform: uppercase;
    color: var(--teal);
    margin-bottom: 10px;
  }

  .form-title {
    font-family: var(--serif);
    font-size: 1.9rem;
    font-weight: 700;
    color: var(--charcoal);
    line-height: 1.2;
    margin-bottom: 8px;
  }

  .form-sub { font-size: 0.875rem; color: var(--muted); }
  .form-sub a { color: var(--teal); font-weight: 500; text-decoration: none; }
  .form-sub a:hover { text-decoration: underline; }

  /* progress dots */
  .form-progress {
    display: flex;
    gap: 6px;
    margin-bottom: 24px;
  }

  .prog-dot {
    height: 3px;
    border-radius: 2px;
    background: var(--border);
    flex: 1;
    transition: background var(--transition);
  }
  .prog-dot.active { background: var(--teal); }

  /* validation errors */
  .errors-box {
    background: #FEE2E2;
    border: 1px solid #FECACA;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 0.82rem;
    color: #991B1B;
    margin-bottom: 20px;
  }

  /* field */
  .field { margin-bottom: 18px; }

  .field label {
    display: block;
    font-size: 11px; font-weight: 600;
    letter-spacing: 0.08em; text-transform: uppercase;
    color: var(--ink);
    margin-bottom: 7px;
  }

  .field-wrap { position: relative; }

  .field-icon {
    position: absolute;
    left: 13px; top: 50%;
    transform: translateY(-50%);
    color: #C0BDB8;
    font-size: 0.8rem;
    pointer-events: none;
    transition: color var(--transition);
  }

  .field input {
    width: 100%;
    padding: 12px 14px 12px 38px;
    border-radius: 11px;
    border: 1.5px solid var(--border);
    background: var(--white);
    color: var(--charcoal);
    font-family: var(--sans);
    font-size: 0.9rem;
    transition: border-color var(--transition), box-shadow var(--transition);
    outline: none;
    -webkit-appearance: none;
  }

  .field input::placeholder { color: #C0BDB8; }

  .field input:focus {
    border-color: var(--teal);
    box-shadow: 0 0 0 3px rgba(26,107,107,0.09);
  }

  .field-wrap:focus-within .field-icon { color: var(--teal); }

  /* terms */
  .terms-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 22px;
    padding: 14px 16px;
    background: var(--cream);
    border-radius: 11px;
    border: 1px solid var(--border);
    font-size: 0.82rem;
    color: var(--muted);
    line-height: 1.55;
  }

  .terms-row input[type="checkbox"] {
    width: 16px; height: 16px;
    margin-top: 2px;
    accent-color: var(--teal);
    cursor: pointer;
    flex-shrink: 0;
  }

  .terms-row a { color: var(--teal); font-weight: 500; }

  /* submit */
  .btn-register {
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
    margin-bottom: 16px;
  }

  .btn-register:hover {
    background: var(--teal);
    transform: translateY(-1px);
    box-shadow: 0 8px 28px rgba(26,107,107,0.28);
  }

  .btn-register:active { transform: translateY(0); }

  .login-link {
    text-align: center;
    font-size: 0.875rem;
    color: var(--muted);
  }

  .login-link a { color: var(--teal); font-weight: 600; text-decoration: none; }
  .login-link a:hover { text-decoration: underline; }

  /* ── RESPONSIVE ──────────────────────────────────── */
  @media (max-width: 900px) {
    .register-page { grid-template-columns: 1fr; }
    .reg-brand { display: none; }
    .reg-form-side { min-height: 100vh; }
  }

  @media (max-width: 480px) {
    .reg-form-side { padding: 36px 20px; }
    .form-title { font-size: 1.6rem; }
  }

  /* ── ANIMATIONS ──────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .reg-form-wrap > * {
    animation: fadeUp 0.5s both;
  }
  .form-header         { animation-delay: 0.05s; }
  .form-progress       { animation-delay: 0.10s; }
  .field:nth-child(1)  { animation-delay: 0.13s; }
  .field:nth-child(2)  { animation-delay: 0.17s; }
  .field:nth-child(3)  { animation-delay: 0.21s; }
  .field:nth-child(4)  { animation-delay: 0.25s; }
  .terms-row           { animation-delay: 0.29s; }
  .btn-register        { animation-delay: 0.33s; }
</style>

<div class="register-page">

  {{-- ── LEFT: BRAND PANEL ──────────────────────────── --}}
  <div class="reg-brand">
    <div class="brand-bg"></div>
    <div class="brand-ring br1"></div>
    <div class="brand-ring br2"></div>
    <div class="brand-ring br3"></div>

    <div class="brand-top">
      <div class="brand-logo">
        <div class="brand-logo-icon"><i class="fas fa-tools"></i></div>
        <div class="brand-logo-text">Serv<span>Pro</span></div>
      </div>

      <div class="brand-eyebrow">Join thousands of users</div>
      <h2 class="brand-heading">Your Home,<br><em>In Safe Hands</em></h2>
      <p class="brand-sub">
        Create a free account and instantly access thousands of verified, background-checked professionals in your city.
      </p>

      <div class="brand-perks">
        <div class="brand-perk">
          <div class="perk-icon"><i class="fas fa-bolt"></i></div>
          <div class="perk-text">
            <strong>Book in 2 Minutes</strong>
            Find, compare, and book a professional without any phone calls.
          </div>
        </div>
        <div class="brand-perk">
          <div class="perk-icon"><i class="fas fa-shield-halved"></i></div>
          <div class="perk-text">
            <strong>Verified Professionals</strong>
            Every provider is background-checked, licensed, and insured.
          </div>
        </div>
        <div class="brand-perk">
          <div class="perk-icon"><i class="fas fa-star"></i></div>
          <div class="perk-text">
            <strong>Earn Loyalty Rewards</strong>
            Collect points on every booking and redeem them for discounts.
          </div>
        </div>
        <div class="brand-perk">
          <div class="perk-icon"><i class="fas fa-headset"></i></div>
          <div class="perk-text">
            <strong>24/7 Customer Support</strong>
            Real help whenever you need it — chat, call, or email.
          </div>
        </div>
      </div>
    </div>

    <div class="brand-bottom">
      <i class="fas fa-lock"></i>
      Your data is encrypted and never sold to third parties.
    </div>
  </div>

  {{-- ── RIGHT: FORM PANEL ───────────────────────────── --}}
  <div class="reg-form-side">
    <div class="reg-form-wrap">

      <div class="form-header">
        <div class="form-eyebrow">Free Account</div>
        <h1 class="form-title">Create your account</h1>
        <p class="form-sub">
          Already have one? <a href="{{ route('login') }}">Sign in instead</a>
        </p>
      </div>

      {{-- progress bar decoration --}}
      <div class="form-progress">
        <div class="prog-dot active"></div>
        <div class="prog-dot active"></div>
        <div class="prog-dot"></div>
      </div>

      {{-- Validation Errors --}}
      <x-validation-errors class="errors-box" />

      <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="field">
          <label for="name">Full Name</label>
          <div class="field-wrap">
            <input id="name" type="text" name="name" :value="old('name')"
                   placeholder="John Doe" required autofocus autocomplete="name">
            <i class="fas fa-user field-icon"></i>
          </div>
        </div>

        {{-- Email --}}
        <div class="field">
          <label for="email">Email Address</label>
          <div class="field-wrap">
            <input id="email" type="email" name="email" :value="old('email')"
                   placeholder="you@example.com" required autocomplete="username">
            <i class="fas fa-envelope field-icon"></i>
          </div>
        </div>

        {{-- Password --}}
        <div class="field">
          <label for="password">Password</label>
          <div class="field-wrap">
            <input id="password" type="password" name="password"
                   placeholder="Min. 8 characters" required autocomplete="new-password">
            <i class="fas fa-lock field-icon"></i>
          </div>
        </div>

        {{-- Confirm Password --}}
        <div class="field">
          <label for="password_confirmation">Confirm Password</label>
          <div class="field-wrap">
            <input id="password_confirmation" type="password" name="password_confirmation"
                   placeholder="Repeat your password" required autocomplete="new-password">
            <i class="fas fa-lock field-icon"></i>
          </div>
        </div>

        {{-- Terms --}}
        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
          <div class="terms-row">
            <x-checkbox name="terms" id="terms" required />
            <label for="terms">
              {!! __('I agree to the :terms_of_service and :privacy_policy', [
                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                'privacy_policy'   => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
              ]) !!}
            </label>
          </div>
        @endif

        <button type="submit" class="btn-register">
          <i class="fas fa-user-plus"></i> Create Free Account
        </button>

        <div class="login-link">
          Already have an account? <a href="{{ route('login') }}">Sign in</a>
        </div>

      </form>
    </div>
  </div>

</div>

</x-guest-layout>