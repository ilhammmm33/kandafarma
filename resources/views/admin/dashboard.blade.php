@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold text-dark mb-1">Dashboard Admin</h4>
                    <p class="text-muted mb-0">Selamat datang di panel admin Apotek Kanda Farma</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-download me-1"></i>Export
                    </button>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <!-- Total Obat -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 shadow-sm h-100" data-aos="fade-up">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon bg-primary-subtle text-primary">
                                <i class="bi bi-capsule fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="text-muted small mb-1">Total Obat</div>
                            <h4 class="fw-bold mb-0">{{ $totalObat }}</h4>
                            <small class="text-success">
                                <i class="bi bi-arrow-up"></i> 12% dari bulan lalu
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi Hari Ini -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 shadow-sm h-100" data-aos="fade-up" data-aos-delay="100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon bg-success-subtle text-success">
                                <i class="bi bi-cart-check fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="text-muted small mb-1">Transaksi Hari Ini</div>
                            <h4 class="fw-bold mb-0">{{ $transaksiHariIni }}</h4>
                            <small class="text-success">
                                <i class="bi bi-arrow-up"></i> 8% dari kemarin
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan Hari Ini -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 shadow-sm h-100" data-aos="fade-up" data-aos-delay="200">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon bg-info-subtle text-info">
                                <i class="bi bi-cash-stack fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="text-muted small mb-1">Pendapatan Hari Ini</div>
                            <h4 class="fw-bold mb-0">Rp{{ number_format($pendapatanHariIni) }}</h4>
                            <small class="text-success">
                                <i class="bi bi-arrow-up"></i> 15% dari kemarin
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Obat Hampir Habis -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-card border-0 shadow-sm h-100" data-aos="fade-up" data-aos-delay="300">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="stats-icon bg-warning-subtle text-warning">
                                <i class="bi bi-exclamation-triangle fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="text-muted small mb-1">Obat Hampir Habis</div>
                            <h4 class="fw-bold mb-0">{{ $obatHampirHabis }}</h4>
                            <small class="text-danger">
                                <i class="bi bi-exclamation-circle"></i> Perlu perhatian
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Chart Section -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-header bg-transparent border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title fw-bold mb-1">Grafik Pendapatan</h5>
                            <p class="text-muted small mb-0">7 hari terakhir</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                7 Hari
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">7 Hari</a></li>
                                <li><a class="dropdown-item" href="#">30 Hari</a></li>
                                <li><a class="dropdown-item" href="#">3 Bulan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="chartPendapatan" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100" data-aos="fade-up" data-aos-delay="100">
                <div class="card-header bg-transparent border-0 pb-0">
                    <h5 class="card-title fw-bold">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('obat.create') }}" class="btn btn-outline-primary d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i>
                            <div class="text-start">
                                <div class="fw-semibold">Tambah Obat</div>
                                <small class="text-muted">Tambah data obat baru</small>
                            </div>
                        </a>
                        <a href="{{ route('kasir.index') }}" class="btn btn-outline-success d-flex align-items-center">
                            <i class="bi bi-cart-plus me-2"></i>
                            <div class="text-start">
                                <div class="fw-semibold">Kasir</div>
                                <small class="text-muted">Proses transaksi</small>
                            </div>
                        </a>
                        <a href="{{ route('laporan.index') }}" class="btn btn-outline-info d-flex align-items-center">
                            <i class="bi bi-file-earmark-text me-2"></i>
                            <div class="text-start">
                                <div class="fw-semibold">Lihat Laporan</div>
                                <small class="text-muted">Laporan penjualan</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-header bg-transparent border-0 pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title fw-bold mb-1">Aktivitas Terbaru</h5>
                            <p class="text-muted small mb-0">Transaksi dan update data terkini</p>
                        </div>
                        <a href="{{ route('kasir.riwayat') }}" class="btn btn-outline-primary btn-sm">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="activity-item">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="activity-icon bg-success-subtle text-success me-3">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Transaksi Berhasil</div>
                                        <small class="text-muted">Penjualan obat batuk - Rp 25,000</small>
                                        <div class="text-muted small">2 menit yang lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="activity-item">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="activity-icon bg-primary-subtle text-primary me-3">
                                        <i class="bi bi-plus-circle"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">Obat Ditambahkan</div>
                                        <small class="text-muted">Paracetamol 500mg - Stock: 100</small>
                                        <div class="text-muted small">1 jam yang lalu</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($statHarian->pluck('tanggal'));
    const data = @json($statHarian->pluck('total'));

    const ctx = document.getElementById('chartPendapatan').getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(13, 110, 253, 0.3)');
    gradient.addColorStop(1, 'rgba(13, 110, 253, 0.05)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan Harian',
                data: data,
                borderColor: '#0d6efd',
                backgroundColor: gradient,
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#0d6efd',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: '#0d6efd',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    border: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    border: {
                        display: false
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString();
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
</script>

{{-- AOS --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ 
        duration: 600, 
        once: true,
        easing: 'ease-out-cubic'
    });

    // Counter animation
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString();
        }, 20);
    }

    // Animate counters when page loads
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.stats-card h4');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
            if (target > 0) {
                animateCounter(counter, target);
            }
        });
    });
</script>
@endsection

<style>
/* Material Design inspired styles */
.stats-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 12px !important;
}

.stats-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.stats-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    border-radius: 12px !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn:hover {
    transform: translateY(-1px);
}

.activity-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Responsive improvements */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    
    .stats-card .card-body {
        padding: 1rem;
    }
    
    .stats-icon {
        width: 40px;
        height: 40px;
    }
    
    .stats-icon i {
        font-size: 1.2rem !important;
    }
}

/* Animation keyframes */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card[data-aos="fade-up"] {
    animation: fadeInUp 0.6s ease-out;
}
</style>