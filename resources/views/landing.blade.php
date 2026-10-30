<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Le Goût du Délice — Restaurant</title>

    <link href="https://fonts.googleapis.com/css2?family=Redressed&family=Merriweather:wght@300;400;700;900&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --or: #ffd700;
            --or-fonce: #C9A227;
            --brun: #7B3F00;
            --noir: #0F0F0F;
            --noir2: #1a1a1a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        .redressed { font-family: 'Redressed', cursive; }
        .merriweather { font-family: 'Merriweather', serif; }
        .playfair { font-family: 'Playfair Display', serif; }

        body {
            background-color: rgba(0,0,0,0.02);
            font-family: 'Merriweather', serif;
            color: #1a1a1a;
            overflow-x: hidden;
        }

        /* ══════ NAVBAR ══════ */
        .cc-navbar {
            background-color: rgba(15,15,15,0.7);
            backdrop-filter: blur(8px);
            font-family: 'Merriweather', serif;
            box-shadow: 0 1px 8px rgba(255,255,255,0.1);
            z-index: 999;
            transition: all 0.3s;
        }

        .cc-navbar.scrolled {
            background-color: rgba(15,15,15,0.95);
        }

        .navbar-brand {
            font-family: 'Redressed', cursive;
            font-size: 28px;
        }

        .cc-navbar .nav-link {
            color: rgba(255,255,255,0.85) !important;
            border-bottom: 1px solid transparent;
            transition: padding-bottom .4s ease, border-color .3s ease;
        }

        .cc-navbar .nav-link:hover {
            padding-bottom: 16px;
            border-bottom-color: var(--or);
            color: var(--or) !important;
        }

        .btn-order {
            color: var(--or);
            border: 1.5px solid var(--or);
            border-radius: 50px;
            padding: 8px 22px;
            transition: 0.3s;
            font-size: 14px;
        }
        .btn-order:hover {
            color: var(--noir);
            background-color: var(--or);
        }

        /* ══════ HERO ══════ */
        .banner {
            background:
                linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.55)),
                url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1600&auto=format') center/cover fixed no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }

        .banner-desc {
            font-size: clamp(28px, 5vw, 48px);
            font-weight: 400;
            color: #fff;
            min-height: 1.4em;
        }

        .typing-cursor::after {
            content: '|';
            animation: blink 0.8s infinite;
            color: var(--or);
        }

        @keyframes blink { 50% { opacity: 0; } }

        .btn-ordere {
            color: var(--or);
            border: 1.5px solid var(--or);
            border-radius: 50px;
            padding: 12px 32px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-ordere:hover {
            color: var(--brun);
            background-color: var(--or);
        }

        .btn-ordere2 {
            color: var(--brun);
            background-color: var(--or);
            border: 1.5px solid var(--or);
            border-radius: 50px;
            padding: 12px 32px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-ordere2:hover {
            background-color: transparent;
            color: var(--or);
        }

        /* QR badge flottant */
        .qr-floating {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,215,0,0.3);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 24px;
            text-align: center;
        }

        .qr-floating .qr-icon {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 40px;
            color: var(--noir);
        }

        /* ══════ COMMENT CA MARCHE ══════ */
        .comment-section {
            background: white;
            padding: 80px 0;
        }

        .titre {
            color: var(--or-fonce);
        }

        .step-box {
            text-align: center;
            padding: 24px;
        }

        .step-circle {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--or), #f0c419);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 28px;
            color: var(--noir);
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(255,215,0,0.3);
        }

        /* ══════ QUI SOMMES-NOUS ══════ */
        .available { background: white; padding: 60px 0; }

        .card-text.justify { text-align: justify; }

        /* ══════ MENU ══════ */
        .cc-menu {
            background:
                linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1600&auto=format') center/cover fixed no-repeat;
            padding: 80px 0;
            color: #fff;
        }

        .cc-menu .nav-tabs {
            border: none;
        }

        .cc-menu .nav-link {
            color: rgba(255,255,255,0.7);
            border: none;
            border-radius: 0;
        }

        .cc-menu .nav-link.active {
            background: transparent;
            color: var(--or) !important;
            border-bottom: 2px solid var(--or);
        }

        .menu-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            color: #1a1a1a;
            transition: transform 0.3s;
        }
        .menu-card:hover { transform: translateY(-6px); }

        .menu-card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }

        .prix-tag {
            color: var(--or-fonce);
            font-weight: 700;
            font-size: 18px;
        }

        /* ══════ SPECIALITES CAROUSEL ══════ */
        .cc-carousel {
            background: var(--noir);
            padding: 70px 0;
            color: #fff;
        }

        /* ══════ NEWSLETTER ══════ */
        .newsletter-section {
            background: linear-gradient(135deg, var(--noir) 0%, var(--noir2) 100%);
            padding: 60px 0;
            text-align: center;
        }

        .newsletter-form {
    flex-wrap: nowrap !important;
}
.newsletter-form input {
    border-radius: 50px 0 0 50px;
    border: 1.5px solid var(--or);
    padding: 12px 20px;
    min-width: 0;
}
.newsletter-form button {
    border-radius: 0 50px 50px 0;
    white-space: nowrap;
    flex-shrink: 0;
}

@media (max-width: 480px) {
    .newsletter-form {
        flex-direction: column !important;
        gap: 10px !important;
    }
    .newsletter-form input {
        border-radius: 50px;
        width: 100%;
    }
    .newsletter-form button {
        border-radius: 50px;
        width: 100%;
    }
}

        /* ══════ FOOTER ══════ */
        footer {
            background-color: black;
            font-family: 'Merriweather', serif;
            box-shadow: 0 -1px 8px rgba(255,255,255,0.1);
            padding-top: 50px;
        }

        footer h4 { color: #fff; }
        footer .footer-link {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            transition: color 0.2s;
        }
        footer .footer-link:hover { color: var(--or); }

        .social-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: 0.2s;
        }
        .social-icon:hover { background: var(--or); color: var(--noir); }

        @media (max-width: 768px) {
            .banner { min-height: 90vh; padding-top: 70px; }
            .qr-floating { margin-top: 30px; }
        }
    </style>
</head>

<body>

    {{-- ══════════ NAVBAR ══════════ --}}
    <nav class="cc-navbar navbar navbar-expand-lg position-fixed navbar-dark w-100" id="mainNav">
        <div class="container-fluid">
            <a class="navbar-brand text-uppercase fw-bolder mx-2 mx-md-4 py-2" href="#">
    <span style="color: var(--or);">Le Goût du Délice</span>
</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item pe-4"><a class="nav-link active" href="#hero">Accueil</a></li>
                    <li class="nav-item pe-4"><a class="nav-link" href="#apropos">À Propos</a></li>
                    <li class="nav-item pe-4"><a class="nav-link" href="#menu">Notre Menu</a></li>
                    <li class="nav-item pe-4"><a class="nav-link" href="#comment">Comment ça marche</a></li>
                    <li class="nav-item ps-lg-3">
                        <a class="btn btn-order" href="{{ route('login') }}">Espace Personnel</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ══════════ HERO ══════════ --}}
    <section class="banner d-flex align-items-center" id="hero">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    
                    <h1 id="typing-text" class="typing-cursor text-capitalize redressed banner-desc"></h1>
                    <p class="mt-4 merriweather" style="color:rgba(255,255,255,0.8);font-size:16px;max-width:500px">
                        Scannez, commandez, dégustez. Découvrez notre carte numérique et savourez l'excellence culinaire, sur place ou en livraison.
                    </p>
                    <div class="mt-4 d-flex gap-3 flex-wrap">
                        <a href="#menu" class="btn btn-ordere btn-lg merriweather">
                            <i class="bi bi-qr-code me-2"></i>Voir le Menu
                        </a>
                        <a href="#comment" class="btn btn-ordere2 btn-lg merriweather">
                            Commander en ligne
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="qr-floating">
                        <div class="qr-icon">
                            <i class="bi bi-qr-code-scan"></i>
                        </div>
                        <h6 class="merriweather text-white mb-2">Scannez à table</h6>
                        <p style="color:rgba(255,255,255,0.6);font-size:13px" class="merriweather">
                            Chaque table dispose d'un QR code unique pour accéder instantanément à notre carte, même sans connexion internet.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════ COMMENT ÇA MARCHE ══════════ --}}
    <section class="comment-section" id="comment">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="redressed titre" style="font-size:36px">Comment ça marche ?</h2>
                <p class="merriweather text-muted">Une expérience simple, rapide et moderne</p>
            </div>
            <div class="row g-4">
                @php
                    $steps = [
                        ['bi-qr-code-scan', 'Scannez le QR', 'Scannez le code QR à votre table pour accéder à notre menu, même hors connexion.'],
                        ['bi-basket3', 'Composez votre commande', 'Parcourez nos catégories et ajoutez vos plats favoris à votre panier.'],
                        ['bi-wallet2', 'Payez en toute liberté', 'Mobile Money, ou règlement à la caisse — vous choisissez ce qui vous convient.'],
                        ['bi-emoji-smile', 'Savourez', 'Votre commande est envoyée en cuisine avec une estimation du temps de préparation.'],
                    ];
                @endphp
                @foreach($steps as $i => $step)
                    <div class="col-6 col-lg-3">
                        <div class="step-box">
                            <div class="step-circle">{{ $i + 1 }}</div>
                            <i class="bi {{ $step[0] }}" style="font-size:28px;color:var(--or-fonce)"></i>
                            <h6 class="merriweather mt-3 mb-2">{{ $step[1] }}</h6>
                            <p class="text-muted" style="font-size:13px">{{ $step[2] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════ QUI SOMMES-NOUS ══════════ --}}
    <section class="available merriweather" id="apropos">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&auto=format"
                        class="img-fluid rounded-3" alt="Restaurant">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <span class="titre redressed" style="font-size:14px;letter-spacing:1px">QUI SOMMES-NOUS</span>
                        <h3 class="card-title merriweather mt-2">L'art de la gastronomie</h3>
                        <p class="card-text justify mt-3" style="color:#444">
                            Bienvenue au restaurant "Le Goût du Délice", votre établissement qui transcende au quotidien
                            les limites du réel avec une panoplie de plats mis à votre disposition. À votre service
                            depuis plusieurs années, nous nous efforçons de proposer rien que des saveurs hors du commun,
                            préparées avec passion par notre équipe de chefs expérimentés.
                        </p>
                        <a href="#menu" class="btn btn-order mt-2">Découvrir le menu</a>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=800&auto=format"
                        class="img-fluid rounded-3" alt="Chef">
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="card-body">
                        <span class="titre redressed" style="font-size:14px;letter-spacing:1px">NOTRE ÉQUIPE</span>
                        <h3 class="card-title merriweather mt-2">Des chefs passionnés</h3>
                        <p class="card-text justify mt-3" style="color:#444">
                            Notre image irréprochable auprès de nos clients se doit à la qualité et aux compétences
                            hors du commun dont fait preuve notre brigade. Tous experts et diplômés dans l'art
                            culinaire, ils maîtrisent parfaitement les ficelles de leur métier, ce qui vous assure
                            une alimentation saine et savoureuse.
                        </p>
                        <a href="#contact" class="btn btn-order mt-2">Nous contacter</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════ MENU ══════════ --}}
    <section class="cc-menu merriweather" id="menu">
        <div class="container">
            <div class="row mb-4">
                <h3 class="text-center redressed"><span style="color:var(--or)">Notre Carte</span></h3>
                <p class="text-center" style="color:rgba(255,255,255,0.7)">
                    Découvrez nos spécialités, mises à jour selon les arrivages du jour
                </p>
            </div>

            <ul class="nav nav-tabs justify-content-center mb-4" id="menuTabs">
                @foreach($categories as $index => $cat)
                    <li class="nav-item">
                        <button class="nav-link {{ $index === 0 ? 'active' : '' }}"
                            data-bs-toggle="tab" data-bs-target="#cat-{{ $cat->id }}" type="button">
                            {{ $cat->icone }} {{ $cat->nom }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach($categories as $index => $cat)
                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="cat-{{ $cat->id }}">
                        <div class="row g-4">
                            @forelse($cat->platsDisponibles as $plat)
                                <div class="col-md-6 col-lg-4">
                                    <div class="menu-card">
                                        <div style="height:200px;background:linear-gradient(135deg,#1a1a1a,#333);display:flex;align-items:center;justify-content:center">
                                            <i class="bi bi-egg-fried" style="font-size:48px;color:var(--or)"></i>
                                        </div>
                                        <div class="p-3">
                                            <h6 class="merriweather fw-bold">{{ $plat->nom }}</h6>
                                            <p class="small text-muted">{{ Str::limit($plat->description, 70) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="prix-tag">{{ number_format($plat->prix, 0, ',', ' ') }} FCFA</span>
                                                <span class="badge" style="background:#F0F0F0;color:#666">{{ $plat->temps_preparation }} min</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center" style="color:rgba(255,255,255,0.5)">Aucun plat disponible dans cette catégorie.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════ CAROUSEL SPÉCIALITÉS ══════════ --}}
    <section class="cc-carousel merriweather text-center">
        <div class="container">
            <h2 class="text-uppercase redressed mb-3"><span style="color:var(--or)">Nos Délices Exquis</span></h2>
            <p class="mb-4" style="color:rgba(255,255,255,0.7);max-width:600px;margin:0 auto">
                Ces plats sont les plus demandés au quotidien par nos clients. Essayez-les et rejoignez ceux qui
                gardent un goût exquis en mémoire !
            </p>

            <div id="specialitesCarousel" class="carousel slide carousel-fade">
                <div class="carousel-inner rounded-3" style="height:450px">
                    @forelse($plats_vedettes as $i => $plat)
                        <div class="carousel-item {{ $i === 0 ? 'active' : '' }}" style="height:450px">
                            <div style="height:100%;background:linear-gradient(135deg,#2a2a2a,#0a0a0a);display:flex;flex-direction:column;align-items:center;justify-content:center">
                                <i class="bi bi-stars" style="font-size:60px;color:var(--or)"></i>
                                <h4 class="mt-3 merriweather">{{ $plat->nom }}</h4>
                                <p class="prix-tag mt-2" style="color:var(--or)">{{ number_format($plat->prix, 0, ',', ' ') }} FCFA</p>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active" style="height:450px">
                            <div style="height:100%;display:flex;align-items:center;justify-content:center">
                                <p style="color:rgba(255,255,255,0.5)">Aucune spécialité à afficher pour le moment.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
                @if($plats_vedettes->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#specialitesCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#specialitesCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                @endif
            </div>
        </div>
    </section>

    {{-- ══════════ NEWSLETTER ══════════ --}}
    <section class="newsletter-section">
        <div class="container">
            <i class="bi bi-envelope-heart" style="font-size:36px;color:var(--or)"></i>
            <h3 class="redressed mt-3" style="color:#fff;font-size:30px">Restez informé(e) !</h3>
            <p class="merriweather mb-4" style="color:rgba(255,255,255,0.7);max-width:500px;margin:0 auto">
                Inscrivez-vous à notre newsletter pour recevoir nos promotions, nouveaux plats et offres exclusives.
            </p>
            <form action="{{ route('newsletter.subscribe') }}" method="POST"
    class="newsletter-form d-flex justify-content-center" style="max-width:450px;margin:0 auto;gap:0">
                @csrf
                <input type="email" name="email" required placeholder="Votre adresse email"
                    class="form-control merriweather" style="flex:1;min-width:200px">
                <button type="submit" class="btn btn-ordere2 merriweather">S'abonner</button>
            </form>
            @if(session('newsletter_success'))
                <p class="mt-3" style="color:#4ade80">{{ session('newsletter_success') }}</p>
            @endif
        </div>
    </section>

    {{-- ══════════ FOOTER ══════════ --}}
<footer id="contact">
    <div class="container">
        <div class="row py-4">
            <div class="col-md-4 mb-3">
                <h4 class="redressed" style="font-size:22px"><span style="color:var(--or)">Le Goût</span> du Délice</h4>
                <p style="color:rgba(255,255,255,0.5);font-size:12px" class="mt-2 mb-0">
                    Nous vous assurons de bonnes saveurs, jour après jour.
                </p>
            </div>
            <div class="col-6 col-md-4 mb-3">
                <h6 class="merriweather mb-2" style="font-size:13px;color:var(--or)">Navigation</h6>
                <div class="d-flex flex-column gap-1">
                    <a href="#hero" class="footer-link" style="font-size:12px;margin:0">Accueil</a>
                    <a href="#menu" class="footer-link" style="font-size:12px;margin:0">Notre Menu</a>
                    <a href="#comment" class="footer-link" style="font-size:12px;margin:0">Comment ça marche</a>
                </div>
            </div>
            <div class="col-6 col-md-4 mb-3">
                <h6 class="merriweather mb-2" style="font-size:13px;color:var(--or)">Contact</h6>
                <p class="footer-link" style="font-size:12px;margin:0"><i class="bi bi-geo-alt me-1"></i>Cotonou, Bénin</p>
                <p class="footer-link" style="font-size:12px;margin:4px 0"><i class="bi bi-telephone me-1"></i>+229 00 00 00 00</p>
                <div class="d-flex gap-2 mt-2">
                    <a href="#" class="social-icon" style="width:30px;height:30px;font-size:13px"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon" style="width:30px;height:30px;font-size:13px"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon" style="width:30px;height:30px;font-size:13px"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
        <div style="height:1px;background:rgba(255,255,255,0.1)"></div>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-3 gap-1">
            <p class="merriweather mb-0" style="color:rgba(255,255,255,0.4);font-size:11px">
                © {{ date('Y') }} Le Goût du Délice. Tous droits réservés.
            </p>
            <p class="merriweather mb-0" style="color:rgba(255,255,255,0.4);font-size:11px">
                Conçu avec <span style="color:var(--or)">♥</span> par <span style="color:var(--or);font-weight:600">Code Crafted</span>
            </p>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ══ NAVBAR SCROLL ══
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 50);
        });

        // ══ TYPING EFFECT ══
        const text = 'Découvrez des saveurs exquises chez "Le Goût du Délice" !';
        const typingText = document.getElementById('typing-text');
        let i = 0;
        let isDeleting = false;

        function typeWriter() {
            if (!isDeleting && i < text.length) {
                typingText.innerHTML = text.substring(0, i + 1);
                i++;
                setTimeout(typeWriter, 80);
            } else if (!isDeleting && i === text.length) {
                isDeleting = true;
                setTimeout(typeWriter, 4000);
            } else if (isDeleting && i > 0) {
                i--;
                typingText.innerHTML = text.substring(0, i);
                setTimeout(typeWriter, 40);
            } else {
                isDeleting = false;
                setTimeout(typeWriter, 500);
            }
        }

        window.onload = typeWriter;

        // ══ SMOOTH SCROLL ══
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const target = document.querySelector(a.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>

</body>
</html>