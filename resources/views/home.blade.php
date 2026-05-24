@extends('layouts.app')

@section('title', 'Home')

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

  /* ── HERO ─────────────────────────────────────────────── */
  .hero {
    position: relative;
    min-height: 92vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--charcoal);
  }

  .hero-bg {
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 70% 60% at 80% 50%, rgba(201,145,58,0.18) 0%, transparent 70%),
      radial-gradient(ellipse 50% 80% at 10% 80%, rgba(26,107,107,0.22) 0%, transparent 65%),
      linear-gradient(135deg, #1C1C1E 0%, #2C2C30 60%, #1A2A2A 100%);
  }

  .hero-grain {
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
    opacity: 0.6;
  }

  /* decorative rings */
  .hero-ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(201,145,58,0.15);
  }
  .hero-ring-1 { width: 480px; height: 480px; top: -120px; right: -80px; }
  .hero-ring-2 { width: 280px; height: 280px; top: 20px; right: 80px; border-color: rgba(201,145,58,0.22); }
  .hero-ring-3 { width: 160px; height: 160px; bottom: 80px; left: 5%; border-color: rgba(26,107,107,0.35); }

  .hero-inner {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 100px 40px 80px;
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 80px;
    align-items: center;
  }

  .hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 20px;
  }
  .hero-eyebrow span { width: 28px; height: 1px; background: var(--gold); display: block; }

  .hero h1 {
    font-family: var(--serif);
    font-size: clamp(2.4rem, 5vw, 4rem);
    font-weight: 700;
    line-height: 1.18;
    color: var(--white);
    margin-bottom: 22px;
  }

  .hero h1 em {
    font-style: normal;
    color: var(--gold);
  }

  .hero-sub {
    font-size: 1.05rem;
    color: rgba(255,255,255,0.62);
    max-width: 480px;
    margin-bottom: 36px;
    font-weight: 300;
  }

  .hero-stats {
    display: flex;
    gap: 32px;
    margin-top: 40px;
  }

  .hero-stat-value {
    font-family: var(--serif);
    font-size: 2rem;
    font-weight: 600;
    color: var(--gold);
    display: block;
    line-height: 1.1;
  }

  .hero-stat-label {
    font-size: 12px;
    color: rgba(255,255,255,0.45);
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  /* search card */
  .search-card {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: var(--radius-lg);
    padding: 36px 32px;
    backdrop-filter: blur(12px);
  }

  .search-card-title {
    font-family: var(--serif);
    font-size: 1.25rem;
    color: var(--white);
    margin-bottom: 6px;
  }

  .search-card-sub {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.45);
    margin-bottom: 24px;
  }

  .search-field {
    margin-bottom: 14px;
  }

  .search-field label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.40);
    margin-bottom: 7px;
  }

  .search-field input {
    width: 100%;
    padding: 13px 16px;
    border-radius: var(--radius);
    border: 1px solid rgba(255,255,255,0.14);
    background: rgba(255,255,255,0.08);
    color: var(--white);
    font-family: var(--sans);
    font-size: 0.92rem;
    transition: border-color var(--transition), background var(--transition);
    outline: none;
  }

  .search-field input::placeholder { color: rgba(255,255,255,0.30); }

  .search-field input:focus {
    border-color: rgba(201,145,58,0.55);
    background: rgba(255,255,255,0.12);
  }

  .btn-search {
    width: 100%;
    padding: 14px;
    border-radius: var(--radius);
    background: var(--gold);
    color: var(--charcoal);
    font-family: var(--sans);
    font-size: 0.95rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    margin-top: 18px;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    box-shadow: 0 4px 18px rgba(201,145,58,0.30);
  }

  .btn-search:hover {
    background: #D9A44A;
    transform: translateY(-1px);
    box-shadow: 0 8px 28px rgba(201,145,58,0.42);
  }

  /* ── TRUST BAR ────────────────────────────────────────── */
  .trust-bar {
    background: var(--white);
    border-bottom: 1px solid var(--border);
    padding: 20px 40px;
  }

  .trust-bar-inner {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 48px;
    flex-wrap: wrap;
  }

  .trust-item {
    display: flex;
    align-items: center;
    gap: 9px;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--ink);
    white-space: nowrap;
  }

  .trust-item i {
    color: var(--teal);
    font-size: 1rem;
  }

  /* ── SECTION WRAPPER ──────────────────────────────────── */
  .section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 80px 40px;
  }

  .section-header {
    text-align: center;
    margin-bottom: 52px;
  }

  .section-eyebrow {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--teal);
    margin-bottom: 12px;
  }

  .section-title {
    font-family: var(--serif);
    font-size: clamp(1.8rem, 3.5vw, 2.6rem);
    font-weight: 600;
    color: var(--charcoal);
    line-height: 1.25;
    margin-bottom: 14px;
  }

  .section-sub {
    font-size: 1rem;
    color: var(--muted);
    max-width: 520px;
    margin: 0 auto;
  }

  /* ── SERVICES GRID ────────────────────────────────────── */
  .services-section { background: var(--cream); }

  .services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
  }

  .service-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 32px 24px 28px;
    text-align: center;
    cursor: pointer;
    transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
    position: relative;
    overflow: hidden;
  }

  .service-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(26,107,107,0.05), rgba(201,145,58,0.05));
    opacity: 0;
    transition: opacity var(--transition);
  }

  .service-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
    border-color: rgba(26,107,107,0.22);
  }

  .service-card:hover::before { opacity: 1; }

  .service-icon-wrap {
    width: 60px;
    height: 60px;
    border-radius: 18px;
    background: var(--teal-lt);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
    transition: background var(--transition), transform var(--transition);
  }

  .service-card:hover .service-icon-wrap {
    background: var(--teal);
    transform: scale(1.08) rotate(-4deg);
  }

  .service-icon-wrap i {
    font-size: 1.4rem;
    color: var(--teal);
    transition: color var(--transition);
  }

  .service-card:hover .service-icon-wrap i { color: var(--white); }

  .service-name {
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--charcoal);
    margin-bottom: 5px;
  }

  .service-desc {
    font-size: 0.78rem;
    color: var(--muted);
    line-height: 1.5;
  }

  /* ── HOW IT WORKS ─────────────────────────────────────── */
  .how-section { background: var(--ivory); }

  .steps-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 32px;
    position: relative;
  }

  .step-card {
    text-align: center;
    position: relative;
  }

  .step-number {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--gold-lt);
    border: 2px solid var(--gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--serif);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gold-dk);
    margin: 0 auto 20px;
  }

  .step-title {
    font-weight: 600;
    font-size: 1rem;
    color: var(--charcoal);
    margin-bottom: 8px;
  }

  .step-desc {
    font-size: 0.875rem;
    color: var(--muted);
    line-height: 1.6;
  }

  /* ── FEATURED PROVIDERS ───────────────────────────────── */
  .providers-section { background: var(--white); }

  .providers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 24px;
  }

  .provider-card {
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 26px;
    background: var(--white);
    transition: transform var(--transition), box-shadow var(--transition);
    position: relative;
    overflow: hidden;
  }

  .provider-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
  }

  .provider-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 14px;
  }

  .provider-avatar {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dk) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: var(--serif);
    font-size: 1rem;
    font-weight: 700;
    color: var(--white);
    flex-shrink: 0;
  }

  .provider-name {
    font-weight: 600;
    font-size: 1rem;
    color: var(--charcoal);
    margin-bottom: 2px;
  }

  .provider-meta {
    font-size: 0.8rem;
    color: var(--muted);
  }

  .provider-meta i {
    color: var(--teal);
    margin-right: 4px;
    font-size: 0.75rem;
  }

  .status-badge {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  .status-active, .status-verified {
    background: #D1ECE4;
    color: #0D6B47;
  }

  .status-pending {
    background: #FEF3C7;
    color: #92400E;
  }

  .status-inactive {
    background: #F3F4F6;
    color: var(--muted);
  }

  .provider-desc {
    font-size: 0.85rem;
    color: var(--muted);
    margin: 12px 0;
    line-height: 1.55;
  }

  .provider-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 14px;
    border-top: 1px solid var(--border);
    margin-top: 14px;
  }

  .rating-pill {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.82rem;
    color: var(--ink);
    font-weight: 500;
  }

  .rating-pill i { color: #F59E0B; }
  .rating-count { color: var(--muted); font-weight: 400; }

  .btn-book {
    padding: 8px 20px;
    border-radius: 10px;
    background: var(--charcoal);
    color: var(--white);
    font-family: var(--sans);
    font-size: 0.82rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background var(--transition), transform var(--transition);
  }

  .btn-book:hover {
    background: var(--teal);
    transform: translateY(-1px);
    color: var(--white);
  }

  .btn-login-book {
    padding: 8px 20px;
    border-radius: 10px;
    background: transparent;
    color: var(--teal);
    font-family: var(--sans);
    font-size: 0.82rem;
    font-weight: 600;
    border: 1.5px solid var(--teal);
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all var(--transition);
  }

  .btn-login-book:hover {
    background: var(--teal);
    color: var(--white);
  }

  /* ── WHY US ───────────────────────────────────────────── */
  .why-section { background: var(--charcoal); }
  .why-section .section-eyebrow { color: var(--gold); }
  .why-section .section-title { color: var(--white); }
  .why-section .section-sub { color: rgba(255,255,255,0.50); }

  .why-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 2px;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: var(--radius-lg);
    overflow: hidden;
  }

  .why-item {
    padding: 36px 32px;
    background: rgba(255,255,255,0.03);
    border-right: 1px solid rgba(255,255,255,0.06);
    border-bottom: 1px solid rgba(255,255,255,0.06);
    transition: background var(--transition);
  }

  .why-item:hover { background: rgba(255,255,255,0.06); }

  .why-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    background: rgba(201,145,58,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
  }

  .why-icon i {
    color: var(--gold);
    font-size: 1.25rem;
  }

  .why-title {
    font-weight: 600;
    font-size: 1rem;
    color: var(--white);
    margin-bottom: 8px;
  }

  .why-desc {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.45);
    line-height: 1.65;
  }

  /* ── TESTIMONIALS ─────────────────────────────────────── */
  .testimonials-section { background: var(--cream); }

  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
  }

  .testimonial-card {
    background: var(--white);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 28px;
    transition: box-shadow var(--transition);
  }

  .testimonial-card:hover { box-shadow: var(--shadow-sm); }

  .quote-mark {
    font-family: var(--serif);
    font-size: 3.5rem;
    line-height: 1;
    color: var(--gold-lt);
    margin-bottom: 10px;
  }

  .testimonial-text {
    font-size: 0.9rem;
    color: var(--ink);
    line-height: 1.65;
    margin-bottom: 20px;
    font-style: italic;
  }

  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 11px;
  }

  .author-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--teal-lt), var(--gold-lt));
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.8rem;
    color: var(--teal-dk);
    flex-shrink: 0;
  }

  .author-name {
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--charcoal);
  }

  .author-loc {
    font-size: 0.75rem;
    color: var(--muted);
  }

  /* ── CTA BANNER ───────────────────────────────────────── */
  .cta-section {
    background: linear-gradient(135deg, var(--teal-dk) 0%, var(--teal) 60%, #1E8080 100%);
    text-align: center;
    padding: 90px 40px;
  }

  .cta-section h2 {
    font-family: var(--serif);
    font-size: clamp(1.9rem, 4vw, 3rem);
    color: var(--white);
    margin-bottom: 14px;
    font-weight: 700;
  }

  .cta-section p {
    font-size: 1rem;
    color: rgba(255,255,255,0.65);
    max-width: 480px;
    margin: 0 auto 32px;
  }

  .cta-btn-group {
    display: flex;
    gap: 14px;
    justify-content: center;
    flex-wrap: wrap;
  }

  .btn-cta-primary {
    padding: 14px 32px;
    border-radius: var(--radius);
    background: var(--gold);
    color: var(--charcoal);
    font-family: var(--sans);
    font-size: 0.95rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    box-shadow: 0 6px 24px rgba(0,0,0,0.20);
  }

  .btn-cta-primary:hover {
    background: #D9A44A;
    transform: translateY(-2px);
    box-shadow: 0 10px 32px rgba(0,0,0,0.28);
    color: var(--charcoal);
  }

  .btn-cta-ghost {
    padding: 14px 32px;
    border-radius: var(--radius);
    background: transparent;
    color: var(--white);
    font-family: var(--sans);
    font-size: 0.95rem;
    font-weight: 600;
    border: 1.5px solid rgba(255,255,255,0.40);
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all var(--transition);
  }

  .btn-cta-ghost:hover {
    background: rgba(255,255,255,0.10);
    border-color: rgba(255,255,255,0.65);
    color: var(--white);
  }

  /* ── RESPONSIVE ───────────────────────────────────────── */
  @media (max-width: 960px) {
    .hero-inner {
      grid-template-columns: 1fr;
      padding: 80px 28px 60px;
      gap: 40px;
    }
    .hero-ring-1, .hero-ring-2 { display: none; }
    .hero-stats { gap: 24px; }
    .section { padding: 60px 24px; }
  }

  @media (max-width: 600px) {
    .trust-bar-inner { gap: 20px; }
    .hero h1 { font-size: 2rem; }
    .search-card { padding: 24px 18px; }
    .providers-grid { grid-template-columns: 1fr; }
    .cta-section { padding: 64px 20px; }
  }

  /* ── ANIMATIONS ───────────────────────────────────────── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(22px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  .hero-content > * {
    animation: fadeUp 0.7s both;
  }
  .hero-eyebrow { animation-delay: 0.05s; }
  .hero h1      { animation-delay: 0.15s; }
  .hero-sub     { animation-delay: 0.25s; }
  .hero-stats   { animation-delay: 0.40s; }
  .search-card  { animation: fadeUp 0.7s 0.2s both; }
</style>

{{-- ============================================================
     HERO
     ============================================================ --}}
<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-grain"></div>
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-inner">
    <div class="hero-content">
      <div class="hero-eyebrow"><span></span> Trusted Professionals Near You</div>
      <h1>Find the <em>Right Expert</em><br>for Every Job</h1>
      <p class="hero-sub">
        Connect with verified electricians, plumbers, carpenters & more.
        Quality service, transparent pricing — every time.
      </p>
      <div class="hero-stats">
        <div>
          <span class="hero-stat-value">3,200+</span>
          <span class="hero-stat-label">Professionals</span>
        </div>
        <div>
          <span class="hero-stat-value">98%</span>
          <span class="hero-stat-label">Satisfaction</span>
        </div>
        <div>
          <span class="hero-stat-value">50+</span>
          <span class="hero-stat-label">Cities Covered</span>
        </div>
      </div>
    </div>

    <!-- Search Card -->
    <div class="search-card">
      <p class="search-card-title">Find a Professional</p>
      <p class="search-card-sub">Book in under 2 minutes</p>
      <form action="{{ route('search') }}" method="GET">
        <div class="search-field">
          <label>Service Type</label>
          <input type="text" name="service" placeholder="e.g. Electrician, Plumber…">
        </div>
        <div class="search-field">
          <label>Your City</label>
          <input type="text" name="city" placeholder="e.g. Mumbai, Delhi…">
        </div>
        <button type="submit" class="btn-search">
          <i class="fas fa-search"></i> Search Professionals
        </button>
      </form>
    </div>
  </div>
</section>

{{-- ============================================================
     TRUST BAR
     ============================================================ --}}
<div class="trust-bar">
  <div class="trust-bar-inner">
    <div class="trust-item"><i class="fas fa-shield-halved"></i> Background Verified</div>
    <div class="trust-item"><i class="fas fa-certificate"></i> Licensed & Insured</div>
    <div class="trust-item"><i class="fas fa-clock"></i> On-Time Guarantee</div>
    <div class="trust-item"><i class="fas fa-rotate-left"></i> Hassle-Free Rebook</div>
    <div class="trust-item"><i class="fas fa-headset"></i> 24/7 Support</div>
  </div>
</div>

{{-- ============================================================
     POPULAR SERVICES
     ============================================================ --}}
<div class="services-section">
  <div class="section">
    <div class="section-header">
      <span class="section-eyebrow">What We Offer</span>
      <h2 class="section-title">Popular Services</h2>
      <p class="section-sub">From everyday repairs to specialized installations — we have a verified expert for every need.</p>
    </div>

    @php
      $iconMap = [
        'fa-bolt', 'fa-wrench', 'fa-hammer', 'fa-paint-brush',
        'fa-snowflake', 'fa-car', 'fa-broom', 'fa-leaf',
        'fa-plug', 'fa-faucet', 'fa-tools', 'fa-seedling',
      ];
    @endphp

    <div class="services-grid">
      @foreach($categories as $index => $category)
      <a href="{{ route('search', ['service' => $category->name]) }}" style="text-decoration:none;">
        <div class="service-card">
          <div class="service-icon-wrap">
            <i class="fas {{ $iconMap[$index % count($iconMap)] }}"></i>
          </div>
          <div class="service-name">{{ $category->name }}</div>
          <div class="service-desc">{{ $category->description ?? 'Skilled & verified professionals' }}</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>

{{-- ============================================================
     HOW IT WORKS
     ============================================================ --}}
<div class="how-section">
  <div class="section">
    <div class="section-header">
      <span class="section-eyebrow">Simple Process</span>
      <h2 class="section-title">How It Works</h2>
      <p class="section-sub">Getting help has never been easier. Three steps to a completed job.</p>
    </div>

    <div class="steps-grid">
      <div class="step-card">
        <div class="step-number">01</div>
        <div class="step-title">Search a Service</div>
        <p class="step-desc">Enter what you need and your city to browse local, pre-vetted professionals in seconds.</p>
      </div>
      <div class="step-card">
        <div class="step-number">02</div>
        <div class="step-title">Compare & Book</div>
        <p class="step-desc">Review ratings, experience, and pricing. Book a slot that works for your schedule.</p>
      </div>
      <div class="step-card">
        <div class="step-number">03</div>
        <div class="step-title">Get It Done</div>
        <p class="step-desc">Your professional arrives on time and completes the job. Pay only when satisfied.</p>
      </div>
      <div class="step-card">
        <div class="step-number">04</div>
        <div class="step-title">Rate & Review</div>
        <p class="step-desc">Share your experience to help the community and earn loyalty rewards for the next booking.</p>
      </div>
    </div>
  </div>
</div>

{{-- ============================================================
     FEATURED PROVIDERS
     ============================================================ --}}
@if(isset($featuredProviders) && $featuredProviders->count() > 0)
<div class="providers-section">
  <div class="section">
    <div class="section-header">
      <span class="section-eyebrow">Top Rated</span>
      <h2 class="section-title">Featured Professionals</h2>
      <p class="section-sub">Our highest-rated service providers, handpicked for reliability and excellence.</p>
    </div>

    <div class="providers-grid">
      @foreach($featuredProviders as $provider)
      <div class="provider-card">
        <div class="provider-card-header">
          <div style="display:flex;align-items:center;gap:13px;">
            <div class="provider-avatar">
              {{ strtoupper(substr($provider->business_name, 0, 2)) }}
            </div>
            <div>
              <div class="provider-name">{{ $provider->business_name }}</div>
              <div class="provider-meta">
                <i class="fas fa-user"></i>{{ $provider->user->name }}
                &nbsp;&nbsp;
                <i class="fas fa-tag"></i>{{ $provider->category->name }}
              </div>
            </div>
          </div>
         
        </div>

        <div class="provider-meta" style="margin-top:8px;">
          <i class="fas fa-map-marker-alt"></i>
          {{ $provider->city }}, {{ $provider->area }}
        </div>

        <p class="provider-desc">{{ Str::limit($provider->description, 110) }}</p>

        <div class="provider-footer">
          <div class="rating-pill">
            <i class="fas fa-star"></i>
            {{ number_format($provider->rating, 1) }}
            <span class="rating-count">({{ $provider->total_reviews }} reviews)</span>
          </div>
          @auth
            @if(auth()->user()->role == 'user')
              <a href="{{ route('bookings.create', $provider) }}" class="btn-book">
                Book Now <i class="fas fa-arrow-right"></i>
              </a>
            @endif
          @else
            <a href="{{ route('login') }}" class="btn-login-book">
              Login to Book
            </a>
          @endauth
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif

{{-- ============================================================
     WHY CHOOSE US
     ============================================================ --}}
<div class="why-section">
  <div class="section">
    <div class="section-header">
      <span class="section-eyebrow">Our Promise</span>
      <h2 class="section-title">Why Homeowners Trust Us</h2>
      <p class="section-sub">We built every feature around one goal: giving you peace of mind.</p>
    </div>

    <div class="why-grid">
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-user-shield"></i></div>
        <div class="why-title">Verified Professionals</div>
        <p class="why-desc">Every provider passes a background check, license verification, and skill assessment before listing.</p>
      </div>
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-indian-rupee-sign"></i></div>
        <div class="why-title">Transparent Pricing</div>
        <p class="why-desc">No hidden fees. Prices are shown upfront so you know exactly what you'll pay before booking.</p>
      </div>
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-calendar-check"></i></div>
        <div class="why-title">On-Time Commitment</div>
        <p class="why-desc">Professionals who miss appointments are penalized. We take punctuality as seriously as you do.</p>
      </div>
      <div class="why-item">
        <div class="why-icon"><i class="fas fa-comments"></i></div>
        <div class="why-title">Real Reviews</div>
        <p class="why-desc">Every rating comes from a verified booking — no fake reviews, no manipulation.</p>
      </div>
    </div>
  </div>
</div>

{{-- ============================================================
     TESTIMONIALS
     ============================================================ --}}
<div class="testimonials-section">
  <div class="section">
    <div class="section-header">
      <span class="section-eyebrow">Happy Customers</span>
      <h2 class="section-title">What People Are Saying</h2>
    </div>

    <div class="testimonials-grid">
      <div class="testimonial-card">
        <div class="quote-mark">"</div>
        <p class="testimonial-text">Found an excellent electrician the same afternoon I searched. He arrived on time, explained everything clearly, and the price matched what was shown. Couldn't ask for more.</p>
        <div class="testimonial-author">
          <div class="author-avatar">RK</div>
          <div>
            <div class="author-name">Rahul Kumar</div>
            <div class="author-loc"><i class="fas fa-map-marker-alt" style="color:var(--teal);font-size:10px;margin-right:3px;"></i> Bengaluru</div>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="quote-mark">"</div>
        <p class="testimonial-text">The plumber fixed a leaking pipe that two others had failed to solve. Professional, clean, and reasonably priced. This platform has changed how I find help at home.</p>
        <div class="testimonial-author">
          <div class="author-avatar">SP</div>
          <div>
            <div class="author-name">Sneha Pillai</div>
            <div class="author-loc"><i class="fas fa-map-marker-alt" style="color:var(--teal);font-size:10px;margin-right:3px;"></i> Kochi</div>
          </div>
        </div>
      </div>
      <div class="testimonial-card">
        <div class="quote-mark">"</div>
        <p class="testimonial-text">Booking was seamless and the carpenter was genuinely skilled. He finished ahead of schedule and cleaned up after himself. Will definitely use again.</p>
        <div class="testimonial-author">
          <div class="author-avatar">AM</div>
          <div>
            <div class="author-name">Ankit Mehta</div>
            <div class="author-loc"><i class="fas fa-map-marker-alt" style="color:var(--teal);font-size:10px;margin-right:3px;"></i> Mumbai</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ============================================================
     CTA
     ============================================================ --}}
<div class="cta-section">
  <h2>Ready to Get Started?</h2>
  <p>Join thousands of homeowners who've already discovered a better way to find trusted professionals.</p>
  <div class="cta-btn-group">
    <a href="{{ route('search') }}" class="btn-cta-primary">
      <i class="fas fa-search"></i> Find a Professional
    </a>
    @guest
    <a href="{{ route('register') }}" class="btn-cta-ghost">
      <i class="fas fa-user-plus"></i> Create an Account
    </a>
    @endguest
  </div>
</div>

@endsection