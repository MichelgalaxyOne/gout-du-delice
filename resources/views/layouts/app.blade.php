<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Le Goût du Délice — {{ $title ?? 'Tableau de bord' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --noir: #0F0F0F;
            --noir2: #1C1C1C;
            --or: #C9A227;
            --or-light: #E8C547;
            --gray-bg: #F5F5F3;
            --text-dark: #1A1A1A;
            --text-muted: #6B7280;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-bg);
            color: var(--text-dark);
            min-height: 100vh;
            padding-bottom: 70px; /* place pour bottom nav mobile */
        }

        /* ── TOPBAR ── */
        .topbar {
            background: linear-gradient(135deg, var(--noir) 0%, var(--noir2) 100%);
            padding: 14px 16px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.3);
        }

        .topbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-brand span { color: var(--or-light); }

        .topbar .badge-role {
            background: rgba(201,162,39,0.15);
            border: 1px solid rgba(201,162,39,0.4);
            color: var(--or-light);
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .topbar .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--or), var(--or-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--noir);
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
        }

        .topbar .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            border-radius: 12px;
            padding: 6px;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            padding: 16px;
            background: white;
            border-bottom: 1px solid #E5E7EB;
        }

        .page-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(18px, 4vw, 24px);
            font-weight: 700;
            color: var(--noir);
            margin: 0;
        }

        /* ── CARDS ── */
        .card-stat {
            background: white;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border-left: 4px solid var(--or);
            height: 100%;
        }

        .card-stat .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: clamp(20px, 4vw, 28px);
            font-weight: 700;
            color: var(--noir);
        }

        .card-stat .stat-label {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .order-card {
            background: white;
            border-radius: 14px;
            padding: 14px 16px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            margin-bottom: 10px;
            transition: all 0.2s;
        }

        .order-card:active { transform: scale(0.98); }

        /* ── BADGES STATUTS ── */
        .badge-statut {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .badge-en_attente { background: #FEF3C7; color: #92400E; }
        .badge-confirmee { background: #DBEAFE; color: #1E40AF; }
        .badge-en_preparation { background: #FED7AA; color: #9A3412; }
        .badge-prete { background: #D1FAE5; color: #065F46; }
        .badge-livree { background: #E5E7EB; color: #374151; }
        .badge-annulee { background: #FEE2E2; color: #991B1B; }

        /* ── BOTTOM NAV (mobile) ── */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--noir);
            display: flex;
            justify-content: space-around;
            padding: 8px 0;
            z-index: 1000;
            box-shadow: 0 -2px 15px rgba(0,0,0,0.3);
        }

        .bottom-nav a {
            color: rgba(255,255,255,0.5);
            text-decoration: none;
            text-align: center;
            font-size: 10px;
            flex: 1;
            padding: 4px;
        }

        .bottom-nav a.active { color: var(--or-light); }
        .bottom-nav a i { display: block; font-size: 20px; margin-bottom: 2px; }

        /* ── SIDEBAR (desktop/tablette large) ── */
        @media (min-width: 992px) {
            body { padding-bottom: 0; padding-left: 220px; }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 220px;
                height: 100vh;
                background: linear-gradient(180deg, var(--noir) 0%, var(--noir2) 100%);
                padding: 24px 0;
                z-index: 1100;
            }

            .sidebar-brand {
                font-family: 'Playfair Display', serif;
                font-size: 20px;
                font-weight: 700;
                color: white;
                text-align: center;
                margin-bottom: 32px;
                padding: 0 16px;
            }

            .sidebar-brand span { color: var(--or-light); }

            .sidebar-link {
                display: flex;
                align-items: center;
                gap: 12px;
                color: rgba(255,255,255,0.6);
                text-decoration: none;
                padding: 12px 24px;
                font-size: 14px;
                transition: all 0.2s;
            }

            .sidebar-link:hover, .sidebar-link.active {
                color: var(--or-light);
                background: rgba(201,162,39,0.1);
                border-left: 3px solid var(--or);
            }

            .bottom-nav { display: none; }
            .topbar { display: none; }

            .topbar-desktop {
                display: flex;
                background: white;
                padding: 16px 24px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                justify-content: space-between;
                align-items: center;
            }
        }

        @media (max-width: 991px) {
            .sidebar { display: none; }
            .topbar-desktop { display: none; }
        }

        /* ── BUTTONS ── */
        .btn-or {
            background: linear-gradient(135deg, var(--or), var(--or-light));
            color: var(--noir);
            border: none;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .btn-or:hover { color: var(--noir); transform: translateY(-1px); }

        .btn-noir {
            background: var(--noir);
            color: white;
            border: none;
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-noir:hover { color: white; background: var(--noir2); }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-thumb { background: var(--or); border-radius: 3px; }
    </style>
</head>
<body>

    {{-- SIDEBAR DESKTOP --}}
    <nav class="sidebar">
        <div class="sidebar-brand">
            Le Goût du <span>Délice</span>
        </div>

        @auth
            @if(auth()->user()->role === 'gerant')
    <a href="{{ route('gerant.dashboard') }}" class="sidebar-link {{ request()->routeIs('gerant.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Tableau de bord
    </a>
    <a href="{{ route('gerant.categories.index') }}" class="sidebar-link {{ request()->routeIs('gerant.categories.*') ? 'active' : '' }}">
        <i class="bi bi-folder2"></i> Catégories
    </a>

    <a href="{{ route('gerant.plats.index') }}" class="sidebar-link {{ request()->routeIs('gerant.plats.*') ? 'active' : '' }}">
    <i class="bi bi-egg-fried"></i> Plats
</a>

<a href="{{ route('gerant.tables.index') }}" class="sidebar-link {{ request()->routeIs('gerant.tables.*') ? 'active' : '' }}">
    <i class="bi bi-grid-3x3-gap"></i> Tables
</a>
@endif
            @if(in_array(auth()->user()->role, ['serveuse', 'gerant']))
                <a href="{{ route('serveuse.dashboard') }}" class="sidebar-link {{ request()->routeIs('serveuse.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> Commandes
                </a>
            @endif
            @if(in_array(auth()->user()->role, ['cuisine', 'gerant']))
                <a href="{{ route('cuisine.dashboard') }}" class="sidebar-link {{ request()->routeIs('cuisine.*') ? 'active' : '' }}">
                    <i class="bi bi-fire"></i> Cuisine
                </a>
            @endif
            <a href="{{ route('profile.edit') }}" class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Mon profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        @endauth
    </nav>

    {{-- TOPBAR DESKTOP --}}
    <div class="topbar-desktop">
        <div>
            <span style="color:#6B7280;font-size:13px">{{ now()->translatedFormat('l d F Y') }}</span>
        </div>
        @auth
            <div class="d-flex align-items-center gap-3">
                <span class="badge-role" style="background:#F5F5F3;color:#0F0F0F;border:1px solid #E5E7EB;padding:4px 12px;border-radius:20px;font-size:12px">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        @endauth
    </div>

    {{-- TOPBAR MOBILE --}}
    <div class="topbar d-flex justify-content-between align-items-center">
        <a href="#" class="topbar-brand">
            🍽️ Le Goût du <span>Délice</span>
        </a>
        @auth
            <div class="dropdown">
                <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="px-3 py-2 border-bottom">
                        <div style="font-weight:600;font-size:13px">{{ auth()->user()->name }}</div>
                        <div style="font-size:11px;color:#6B7280">{{ ucfirst(auth()->user()->role) }}</div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Mon profil</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>

    {{-- HEADER PAGE --}}
    @isset($header)
        <div class="page-header">{{ $header }}</div>
    @endisset

    {{-- CONTENU --}}
    <main>
        {{ $slot }}
    </main>

    {{-- BOTTOM NAV MOBILE --}}
    @auth
        <nav class="bottom-nav">
            @if(auth()->user()->role === 'gerant')
                <a href="{{ route('gerant.dashboard') }}" class="{{ request()->routeIs('gerant.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Accueil
                </a>
            @endif
            @if(in_array(auth()->user()->role, ['serveuse', 'gerant']))
                <a href="{{ route('serveuse.dashboard') }}" class="{{ request()->routeIs('serveuse.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> Commandes
                </a>
            @endif
            @if(in_array(auth()->user()->role, ['cuisine', 'gerant']))
                <a href="{{ route('cuisine.dashboard') }}" class="{{ request()->routeIs('cuisine.*') ? 'active' : '' }}">
                    <i class="bi bi-fire"></i> Cuisine
                </a>
            @endif
            <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-person"></i> Profil
            </a>
        </nav>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>