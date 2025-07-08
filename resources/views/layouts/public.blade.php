<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Apotek Kanda Farma - Solusi kesehatan dengan keanggunan modern.">
    <meta name="keywords" content="apotek, kesehatan, obat, Kanda Farma, farmasi">
    <title>Apotek Kanda Farma</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #007bff; /* Medicare blue */
            --secondary-color: #f8f9fa; /* Light gray/white background */
            --accent-color: #0056b3; /* Darker blue for hover */
            --text-dark: #333333;
            --text-light: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--secondary-color);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        /* Decorative Background Line */
        .decor-line {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .decor-line svg {
            width: 100%;
            height: 100%;
            position: absolute;
        }

        .decor-line path {
            fill: none;
            stroke: var(--primary-color);
            stroke-width: 0.8;
            stroke-dasharray: 1200;
            stroke-dashoffset: 1200;
            animation: drawLine 10s infinite linear;
        }

        @keyframes drawLine {
            to {
                stroke-dashoffset: 0;
            }
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar.sticky-top {
            box-shadow: var(--shadow);
        }

        .navbar-brand {
            font-family: 'Roboto', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color) !important;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--accent-color) !important;
        }

        .nav-link {
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            color: var(--text-dark) !important;
            padding: 0.5rem 1.2rem;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background: var(--primary-color);
            transition: width 0.3s ease, left 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
            left: 0;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* Floating WhatsApp Button */
        .floating-wa {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: var(--primary-color);
            color: var(--text-light);
            border-radius: 50%;
            padding: 12px;
            font-size: 1.5rem;
            z-index: 1000;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
        }

        .floating-wa:hover {
            transform: scale(1.1);
           叶子: var(--shadow-hover);
            background: var(--accent-color);
        }

        /* Footer */
        .footer {
            background: #343a40;
            color: var(--text-light);
            padding: 1.5rem 0;
            text-align: center;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('images/apotek.jpg') }}') no-repeat center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .footer .container {
            position: relative;
            z-index: 1;
        }

        .footer h5 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            color: var(--text-light);
            margin-bottom: 0.8rem;
            font-size: 1.4rem;
        }

        .social-icons {
            margin-bottom: 1rem;
        }

        .social-icons a {
            font-size: 1.2rem;
            margin: 0 0.6rem;
            color: var(--text-light);
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--primary-color);
        }

        .footer a {
            color: var(--text-light);
            text-decoration: none;
            margin: 0 0.5rem;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-color);
        }

        .footer p {
            margin: 0.5rem 0;
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .nav-link {
                font-size: 0.85rem;
                padding: 0.5rem 0.8rem;
            }

            .floating-wa {
                padding: 8px;
                font-size: 1.2rem;
                bottom: 15px;
                right: 15px;
            }

            .footer h5 {
                font-size: 1.2rem;
            }

            .social-icons a {
                font-size: 1rem;
                margin: 0 0.4rem;
            }

            .footer a {
                font-size: 0.8rem;
                margin: 0 0.3rem;
            }

            .footer p {
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .nav-link {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Decorative Line Background -->
    <div class="decor-line">
        <svg viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice">
            <path d="M0 200 Q 300 100, 600 300 T 1200 200 T 1800 400" />
            <path d="M0 400 Q 200 600, 500 400 T 1000 600 T 1500 300" />
        </svg>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('public.home') }}">Kanda Farma</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.stok') }}">Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('public.rekomendasi') }}">Rekomendasi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Bottom Navbar -->
    <nav class="navbar navbar-light bg-white shadow-sm fixed-bottom d-md-none">
        <div class="container d-flex justify-content-around">
            <a href="{{ route('public.home') }}" class="text-dark text-center" aria-label="Home">
                <i class="bi bi-house-door fs-4"></i><div>Home</div>
            </a>
            <a href="{{ route('public.stok') }}" class="text-dark text-center" aria-label="Obat">
                <i class="bi bi-capsule fs-4"></i><div>Obat</div>
            </a>
            <a href="{{ route('public.rekomendasi') }}" class="text-dark text-center" aria-label="Rekomendasi">
                <i class="bi bi-search-heart fs-4"></i><div>Rekomendasi</div>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <h5 class="fw-bold mb-3">Kanda Farma</h5>
            <p class="mb-3">Keanggunan dalam setiap langkah kesehatan Anda.</p>
            <div class="social-icons mb-3">
                <a href="https://wa.me/6281234567890" target="_blank" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            </div>
            <p class="mb-1">
                <a href="#">Kebijakan Privasi</a> | 
                <a href="#">Syarat & Ketentuan</a> | 
                <a href="https://wa.me/6281234567890" target="_blank">Kontak Kami</a>
            </p>
            <p>© {{ date('Y') }} Kanda Farma. All rights reserved.</p>
        </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/6281234567890" target="_blank" class="floating-wa" aria-label="Hubungi via WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
            easing: 'ease-in-out'
        });

        // GSAP Animations for Navbar
        gsap.from(".navbar-brand", {
            y: -20,
            opacity: 0,
            duration: 1,
            ease: "power3.out"
        });

        gsap.from(".nav-link", {
            y: -20,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            delay: 0.5,
            ease: "power3.out"
        });
    </script>
</body>
</html>