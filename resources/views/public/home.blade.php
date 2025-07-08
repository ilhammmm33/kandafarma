@extends('layouts.public')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center position-relative">
            <div class="floating-element-left">
                <img src="{{ asset('storage/images/pill1.png') ?: 'https://via.placeholder.com/90' }}" alt="Pill 1" class="img-fluid rounded-circle" style="width: 90px;">
            </div>
            <div class="floating-element-right">
                <img src="{{ asset('storage/images/pill2.png') ?: 'https://via.placeholder.com/90' }}" alt="Pill 2" class="img-fluid rounded-circle" style="width: 90px;">
            </div>
            <h1 class="display-3 fw-bold">Kanda Farma</h1>
            <p class="lead">Keanggunan dalam Solusi Kesehatan Anda</p>
            <div class="mt-4">
                <a href="{{ route('public.stok') }}" class="btn btn-primary btn-lg me-3">Lihat Obat</a>
                <a href="{{ route('public.rekomendasi') }}" class="btn btn-outline-primary btn-lg">Cek Rekomendasi</a>
            </div>
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="py-5 category-section">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">Jelajahi Kategori</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="category-card text-center p-3 h-100">
                        <i class="bi bi-capsule fs-2 text-primary mb-3"></i>
                        <h6 class="fw-bold mb-2">Alergi</h6>
                        <a href="{{ route('public.stok', ['kategori' => 'alergi']) }}" class="btn btn-outline-primary btn-sm">Lihat</a>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="category-card text-center p-3 h-100">
                        <i class="bi bi-heart-pulse fs-2 text-primary mb-3"></i>
                        <h6 class="fw-bold mb-2">Suplemen</h6>
                        <a href="{{ route('public.stok', ['kategori' => 'suplemen']) }}" class="btn btn-outline-primary btn-sm">Lihat</a>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="category-card text-center p-3 h-100">
                        <i class="bi bi-tools fs-2 text-primary mb-3"></i>
                        <h6 class="fw-bold mb-2">Kulit</h6>
                        <a href="{{ route('public.stok', ['kategori' => 'kulit']) }}" class="btn btn-outline-primary btn-sm">Lihat</a>
                    </div>
                </div>
                <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="category-card text-center p-3 h-100">
                        <i class="bi bi-droplet-fill fs-2 text-primary mb-3"></i>
                        <h6 class="fw-bold mb-2">Perawatan Kulit</h6>
                        <a href="{{ route('public.stok', ['category' => 'perawatan-kulit']) }}" class="btn btn-outline-primary btn-sm">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Kesehatan -->
    <section class="py-5 info-section">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">Artikel & Tips Kesehatan</h2>
            <div class="row g-4 align-items-stretch">
                <div class="col-md-5 offset-md-1">
                    <div class="info-card p-4 h-100">
                        <h5 class="fw-bold mb-3">Tips Turunkan Demam</h5>
                        <p class="text-muted">Pendekatan alami dan medis untuk meredakan demam dengan aman.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm mt-2">Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-5 offset-md-1">
                    <div class="info-card p-4 h-100">
                        <h5 class="fw-bold mb-3">Atasi Batuk & Flu</h5>
                        <p class="text-muted">Langkah sederhana untuk mencegah dan mengobati batuk serta flu.</p>
                        <a href="#" class="btn btn-outline-primary btn-sm mt-2">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Produk Unggulan (Carousel) -->
    <section class="py-5 product-section">
        <div class="container">
            <h2 class="fw-bold text-center mb-5">Produk Unggulan</h2>
            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach (\App\Models\Obat::take(6)->get()->chunk(3) as $chunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row g-4 justify-content-center">
                                @foreach ($chunk as $obat)
                                    <div class="col-md-4">
                                        <div class="product-card text-center p-3 h-100">
                                            <div class="image-wrapper">
                                                <img src="{{ asset('storage/foto_obat/' . $obat->foto) ?: 'https://via.placeholder.com/150' }}"
                                                     class="card-img-top mb-3"
                                                     style="width: 150px; height: 150px; object-fit: cover; margin: 0 auto;"
                                                     alt="{{ $obat->barang }}">
                                            </div>
                                            <h5 class="fw-bold mb-2">{{ $obat->barang }}</h5>
                                            <span class="badge bg-light text-dark mb-2 border">Rp{{ number_format($obat->harga_jual) }}</span>
                                            <a href="{{ route('public.stok') }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark bg-opacity-50 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark bg-opacity-50 rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <style>
        /* Hero Section */
        .hero-section {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: url('{{ asset("storage/images/apotek.jpg") }}') no-repeat center/cover;
            animation: backgroundMove 10s ease-in-out infinite alternate;
            background-color: var(--secondary-color);
        }

        /* Alternative: Menggunakan ::before untuk lebih fleksibel */
        .hero-section-alt {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            background: var(--secondary-color);
        }

        .hero-section-alt::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset("storage/images/apotek.jpg") }}') no-repeat center/cover;
            opacity: 0.3;
            z-index: 0;
        }

        .hero-section-alt::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.1), rgba(80, 200, 120, 0.1));
            z-index: 1;
        }

        .hero-section .container,
        .hero-section-alt .container {
            position: relative;
            z-index: 2;
        }

        /* Styling untuk konten hero */
        .hero-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem 2rem;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 600px;
        }

        .hero-section h1 {
            font-family: 'Roboto', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .hero-section .lead {
            font-family: 'Roboto', sans-serif;
            font-size: 1.2rem;
            color: white;
            margin-bottom: 2rem;
        }

        .floating-element-left, .floating-element-right {
            position: absolute;
            z-index: 3;
            opacity: 0.7;
            border-radius: 50%;
        }

        .floating-element-left {
            top: 15%;
            left: 5%;
            animation: floatLeft 6s ease-in-out infinite;
        }

        .floating-element-right {
            bottom: 15%;
            right: 5%;
            animation: floatRight 7s ease-in-out infinite;
        }

        @keyframes floatLeft {
            0% { transform: translate(0, 0); }
            50% { transform: translate(10px, -10px); }
            100% { transform: translate(0, 0); }
        }

        @keyframes floatRight {
            0% { transform: translate(0, 0); }
            50% { transform: translate(-10px, 10px); }
            100% { transform: translate(0, 0); }
        }
        @keyframes backgroundMove {
            0% { background-position: center; }
            100% { background-position: center 20%; }
        }


        /* Category Section */
        .category-section {
            background: var(--secondary-color);
            padding: 4rem 0;
        }

        .category-card {
            background: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .category-card i {
            color: var(--primary-color);
        }

        .category-card h6 {
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Info Section */
        .info-section {
            background: #f1f3f5;
            padding: 4rem 0;
        }

        .info-card {
            background: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        /* Product Section */
        .product-section {
            background: var(--secondary-color);
            padding: 4rem 0;
        }

        .product-card {
            background: #ffffff;
            border: none;
            border-radius: 10px;
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .image-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }

        .image-wrapper img {
            border-radius: 10px;
            border: none;
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover img {
            transform: scale(1.05);
        }

        /* Buttons */
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 0.75rem 2rem;
            color: var(--text-light);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover, .btn-outline-primary:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: var(--text-light);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .hero-section .lead {
                font-size: 1rem;
            }

            .floating-element-left, .floating-element-right {
                width: 60px;
            }

            .category-card h6 {
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        // GSAP Animations for Hero Section
        gsap.from(".hero-section h1", {
            y: 50,
            opacity: 0,
            duration: 1.2,
            ease: "power3.out"
        });

        gsap.from(".hero-section .lead", {
            y: 30,
            opacity: 0,
            duration: 1.2,
            delay: 0.6,
            ease: "power3.out"
        });

        gsap.from(".hero-section .btn", {
            y: 20,
            opacity: 0,
            duration: 1,
            stagger: 0.2,
            delay: 1.2,
            ease: "power3.out"
        });

        // GSAP Animation for Category Cards
        gsap.utils.toArray(".category-card").forEach(card => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 85%",
                },
                y: 40,
                opacity: 0,
                duration: 1,
                ease: "power3.out"
            });
        });

        // GSAP Animation for Info Cards
        gsap.utils.toArray(".info-card").forEach(card => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 85%",
                },
                y: 40,
                opacity: 0,
                duration: 1,
                ease: "power3.out"
            });
        });

        // GSAP Animation for Product Cards
        gsap.utils.toArray(".product-card").forEach(card => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 85%",
                },
                y: 40,
                opacity: 0,
                duration: 1,
                ease: "power3.out"
            });
        });
    </script>
@endsection