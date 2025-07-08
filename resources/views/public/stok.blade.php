@extends('layouts.public')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold text-dark mb-1">
                        <i class="bi bi-capsule text-primary me-2"></i>
                        Stok Obat Tersedia
                    </h2>
                    <p class="text-muted mb-0">Temukan obat yang Anda butuhkan dengan mudah</p>
                </div>
                <a href="{{ route('public.home') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm">
                    <i class="bi bi-house-door me-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Search & Filter Section -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">
            <form method="GET" class="row g-3">
                <div class="col-lg-5 col-md-6">
                    <div class="position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                        <input type="text" 
                               name="search" 
                               class="form-control ps-5 py-3 border-0 bg-light rounded-3" 
                               placeholder="Ketik nama obat yang dicari..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <select name="kategori" class="form-select py-3 border-0 bg-light rounded-3">
                        <option value="">🏷️ Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                {{ ucfirst($kategori) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-primary w-100 py-3 fw-semibold rounded-3 shadow-sm">
                        <i class="bi bi-funnel me-2"></i>
                        Cari Obat
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Section -->
    <div class="row g-4">
        @forelse ($obats as $barang)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden position-relative">
                    <!-- Stock Badge -->
                    @if($barang->stok > 10)
                        <span class="badge bg-success position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill z-index-2">
                            <i class="bi bi-check-circle me-1"></i>Tersedia
                        </span>
                    @elseif($barang->stok > 0)
                        <span class="badge bg-warning position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill z-index-2">
                            <i class="bi bi-exclamation-triangle me-1"></i>Terbatas
                        </span>
                    @else
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill z-index-2">
                            <i class="bi bi-x-circle me-1"></i>Habis
                        </span>
                    @endif

                    <!-- Product Image -->
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('storage/foto_obat/' . $barang->foto) }}"
                             class="card-img-top w-100"
                             style="height: 220px; object-fit: cover; transition: transform 0.3s ease;"
                             alt="{{ $barang->barang }}"
                             onerror="this.src='{{ asset('images/no-image.png') }}'">
                        <div class="position-absolute bottom-0 start-0 end-0 bg-gradient" style="height: 50px; background: linear-gradient(transparent, rgba(0,0,0,0.1));"></div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <!-- Product Name -->
                        <h5 class="card-title fw-bold mb-3 text-dark lh-sm" style="min-height: 50px;">
                            {{ $barang->barang }}
                        </h5>

                        <!-- Product Details -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="bg-light rounded-circle p-2 me-3">
                                    <i class="bi bi-tag text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Kategori</small>
                                    <span class="fw-medium">{{ ucfirst($barang->kategori) }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-light rounded-circle p-2 me-3">
                                    <i class="bi bi-box text-info"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Stok Tersedia</small>
                                    <span class="fw-bold {{ $barang->stok > 10 ? 'text-success' : ($barang->stok > 0 ? 'text-warning' : 'text-danger') }}">
                                        {{ $barang->stok }} unit
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Price -->
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">Harga</small>
                                    <h4 class="text-success fw-bold mb-0">
                                        Rp{{ number_format((float)$barang->harga_jual, 0, ',', '.') }}
                                    </h4>
                                </div>
                                <button class="btn btn-outline-primary rounded-pill px-4" 
                                        {{ $barang->stok == 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-info-circle me-1"></i>
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-search display-1 text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">Obat Tidak Ditemukan</h4>
                    <p class="text-muted mb-4">
                        Maaf, tidak ada obat yang sesuai dengan pencarian Anda.<br>
                        Coba gunakan kata kunci yang berbeda atau pilih kategori lain.
                    </p>
                    <a href="{{ route('public.obat') }}" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-arrow-clockwise me-2"></i>
                        Lihat Semua Obat
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination (if needed) -->
    @if(method_exists($obats, 'links'))
        <div class="d-flex justify-content-center mt-5">
            {{ $obats->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<style>
.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.card:hover img {
    transform: scale(1.05);
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.bg-gradient {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem !important;
    }
    
    .card-title {
        font-size: 1.1rem;
        min-height: auto !important;
    }
}
</style>
@endsection