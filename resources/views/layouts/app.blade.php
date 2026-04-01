<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LaKost - Platform pencarian kos terpercaya di Indonesia">
    <title>@yield('title', 'LaKost') | Temukan Kos Impianmu</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* =============================================
           CUSTOM CSS - LaKost Global Styles
           ============================================= */

        :root {
            --kf-primary:      #1A56DB;
            --kf-primary-dark: #1447C0;
            --kf-accent:       #F59E0B;
            --kf-dark:         #0F172A;
            --kf-gray:         #64748B;
            --kf-light:        #F8FAFC;
            --kf-border:       #E2E8F0;
            --kf-pink:         #EC4899;
            --kf-radius:       12px;
            --kf-shadow:       0 4px 24px rgba(26, 86, 219, 0.10);
            --kf-shadow-lg:    0 8px 40px rgba(26, 86, 219, 0.15);
            --kf-transition:   all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--kf-dark);
            background-color: #fff;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'DM Serif Display', serif;
        }

        .text-primary   { color: var(--kf-primary) !important; }
        .bg-primary     { background-color: var(--kf-primary) !important; }
        .btn-primary    { background-color: var(--kf-primary); border-color: var(--kf-primary); }
        .btn-primary:hover { background-color: var(--kf-primary-dark); border-color: var(--kf-primary-dark); }

        .kf-badge {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: rgba(26, 86, 219, 0.08);
            color: var(--kf-primary);
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            line-height: 1.2;
            font-weight: 400;
        }

        .kf-card {
            border: 1px solid var(--kf-border);
            border-radius: var(--kf-radius);
            transition: var(--kf-transition);
            background: #fff;
        }
        .kf-card:hover {
            box-shadow: var(--kf-shadow-lg);
            transform: translateY(-4px);
            border-color: transparent;
        }

        .icon-box {
            width: 56px; height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .icon-box.primary { background: rgba(26,86,219,0.10); color: var(--kf-primary); }
        .icon-box.success { background: rgba(16,185,129,0.10); color: #10B981; }
        .icon-box.warning { background: rgba(245,158,11,0.10); color: var(--kf-accent); }
        .icon-box.info    { background: rgba(6,182,212,0.10);  color: #06B6D4; }
        .icon-box.danger  { background: rgba(239,68,68,0.10);  color: #EF4444; }
        .icon-box.pink    { background: rgba(236,72,153,0.10); color: var(--kf-pink); }

        .avatar-initials {
            width: 72px; height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            flex-shrink: 0;
            margin: 0 auto 1rem;
        }
        .avatar-initials.primary { background: rgba(26,86,219,0.12); color: var(--kf-primary); }
        .avatar-initials.success { background: rgba(16,185,129,0.12); color: #10B981; }
        .avatar-initials.warning { background: rgba(245,158,11,0.12); color: var(--kf-accent); }
        .avatar-initials.info    { background: rgba(6,182,212,0.12);  color: #06B6D4; }
        .avatar-initials.danger  { background: rgba(239,68,68,0.12);  color: #EF4444; }
        .avatar-initials.pink    { background: rgba(236,72,153,0.12); color: var(--kf-pink); }

        .btn {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            border-radius: 8px;
            transition: var(--kf-transition);
        }
        .btn-primary { background: var(--kf-primary); border-color: var(--kf-primary); padding: 10px 28px; }
        .btn-outline-primary { border-color: var(--kf-primary); color: var(--kf-primary); padding: 10px 28px; }
        .btn-outline-primary:hover { background: var(--kf-primary); border-color: var(--kf-primary); }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up   { animation: fadeInUp 0.6s ease both; }
        .fade-in-up-1 { animation-delay: 0.1s; }
        .fade-in-up-2 { animation-delay: 0.2s; }
        .fade-in-up-3 { animation-delay: 0.3s; }
        .fade-in-up-4 { animation-delay: 0.4s; }

        html { scroll-behavior: smooth; }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1.5px solid var(--kf-border);
            padding: 12px 16px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.92rem;
            transition: var(--kf-transition);
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--kf-primary);
            box-shadow: 0 0 0 3px rgba(26, 86, 219, 0.10);
        }

        .section-py { padding-top: 80px; padding-bottom: 80px; }
        .section-bg { background-color: var(--kf-light); }

        .dot-divider {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--kf-primary);
            display: inline-block;
            margin: 0 8px;
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
