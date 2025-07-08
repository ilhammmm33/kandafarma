<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Apotek Kanda Farma</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Material Icons Outlined -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family= полуInter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #673ab7;
            --primary-light: #9575cd;
            --primary-dark: #512da8;
            --secondary-color: #f8fafc;
            --accent-color: #00acc1;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --error-color: #f44336;
            --card-bg: #ffffff;
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px rgba(0, 0, 0, 0.1);
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            background: var(--secondary-color);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
        }

        /* Layout Container */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: var(--shadow-lg);
            will-change: width;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }



        /* Logo Section */
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: var(--header-height);
        }

        .sidebar-header .logo-icon {
            font-size: 2rem;
            color: var(--accent-color);
        }

        .sidebar-header .logo-text {
            font-size: 1.3rem;
            font-weight: 600;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .logo-text {
            opacity: 0;
            width: 0;
        }

        /* Navigation */
        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            margin: 4px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            font-weight: 500;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 24px;
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-right: 3px solid var(--accent-color);
        }

        .nav-link .nav-icon {
            font-size: 1.3rem;
            width: 24 AUTOMATICpx;
            text-align: center;
        }

        .nav-link .nav-text {
            font-size: 0.95rem;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-text {
            opacity: 0;
            width: 0;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            padding: 12px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content.collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Header */
        .app-header {
            background: white;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            box-shadow: var(--shadow-sm);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: var(--secondary-color);
            color: var(--primary-color);
        }

        .breadcrumb-container {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .user-profile:hover {
            background: var(--secondary-color);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        /* Content Area */
        .content-area {
            padding-top: 24px;
            height: calc(100vh - var(--header-height));
            overflow-y: auto;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 20px;
            border-radius: 12px 12px 0 0 !important;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        /* Pagination Arrow Styles */
        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--primary-light);
            color: white;
            border-color: var(--primary-light);
        }

        .pagination .page-link.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .pagination .page-item.disabled .page-link {
            color: var(--text-secondary);
            background: transparent;
            border-color: var(--border-color);
            cursor: not-allowed;
        }

        .pagination .page-link i.material-icons {
            font-size: 1.2rem;
        }

        .pagination .page-link span {
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                width: var(--sidebar-width);
                transform: translateX(-100%);
                position: fixed;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: var(--sidebar-width);
                height: 100vh;
                overflow-y: auto;
            }

            .main-content.collapsed {
                margin-left: 0;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .content-area {
                padding: 16px;
            }

            .app-header {
                padding: 0 16px;
            }

            .breadcrumb-container {
                display: none;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Animation for page transitions */
        .page-enter {
            opacity: 0;
            transform: translateY(20px);
        }

        .page-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.3s ease;
        }

        /* Custom scrollbar for main content */
        .content-area::-webkit-scrollbar {
            width: 6px;
        }

        .content-area::-webkit-scrollbar-track {
            background: transparent;
        }

        .content-area::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .content-area::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }
    </style>
</head>
<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <div class="app-container">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <i class="material-icons logo-icon">local_pharmacy</i>
                <span class="logo-text">Apotek Kanda Farma</span>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="material-icons-outlined nav-icon">dashboard</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('obat.index') }}" class="nav-link {{ request()->routeIs('obat.*') ? 'active' : '' }}">
                        <i class="material-icons-outlined nav-icon">medication</i>
                        <span class="nav-text">Data Obat</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('kasir.index') }}" class="nav-link {{ request()->routeIs('kasir.index') ? 'active' : '' }}">
                        <i class="material-icons-outlined nav-icon">point_of_sale</i>
                        <span class="nav-text">Kasir</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('kasir.riwayat') }}" class="nav-link {{ request()->routeIs('kasir.riwayat') ? 'active' : '' }}">
                        <i class="material-icons-outlined nav-icon">history</i>
                        <span class="nav-text">Riwayat</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                        <i class="material-icons-outlined nav-icon">assessment</i>
                        <span class="nav-text">Laporan</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="material-icons-outlined nav-icon">logout</i>
                        <span class="nav-text">Keluar</span>
                    </a>
                </div>
            </div>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </nav>

        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Header -->
            <header class="app-header">
                <div class="header-left">
                    <button class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle Sidebar">
                        <i class="material-icons">menu</i>
                    </button>
                    
                    <div class="breadcrumb-container">
                        <div class="breadcrumb-item">
                            <i class="material-icons-outlined" style="font-size: 1rem;">home</i>
                            <span>Dashboard</span>
                        </div>
                        <i class="material-icons-outlined" style="font-size: 1rem; color: var(--border-color);">chevron_right</i>
                        <div class="breadcrumb-item active">
                            <span>@yield('page-title', 'Dashboard')</span>
                        </div>
                    </div>
                </div>
                
                <div class="header-right">
                    <div class="user-profile">
                        <div class="user-avatar">
                            AD
                        </div>
                        <div class="user-info">
                            <div class="user-name">Admin</div>
                            <div class="user-role">Administrator</div>
                        </div>
                        <i class="material-icons-outlined" style="font-size: 1.2rem; color: var(--text-secondary);">expand_more</i>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="content-area">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.2/dist/gsap.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({ 
            duration: 600, 
            once: true, 
            easing: 'ease-out-cubic',
            offset: 50
        });

        // Animate navigation items on load
        gsap.utils.toArray(".nav-item").forEach((item, index) => {
            gsap.from(item, {
                x: -30,
                opacity: 0,
                duration: 0.6,
                delay: index * 0.1,
                ease: "power3.out"
            });
        });

        // Animate content on load
        gsap.from(".content-area", {
            opacity: 0,
            y: 20,
            duration: 0.8,
            delay: 0.3,
            ease: "power3.out"
        });

        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (window.innerWidth <= 1024) {
                // Mobile behavior
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
                document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : 'auto';
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
            }
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (window.innerWidth > 1024) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = 'auto';
            } else {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('collapsed');
            }
        });

        // Close sidebar when clicking on overlay
        document.querySelector('.sidebar-overlay').addEventListener('click', function() {
            if (window.innerWidth <= 1024) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.querySelector('.sidebar-overlay');
                
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                document.body.style.overflow = 'auto';
            }
        });

        // Add smooth scroll behavior
        document.documentElement.style.scrollBehavior = 'smooth';

        // Add page transition effect
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('page-enter-active');
        });

        // Handle navigation link animations
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('mouseenter', function() {
                if (!this.classList.contains('active')) {
                    gsap.to(this, {
                        x: 4,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                }
            });
            
            link.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    gsap.to(this, {
                        x: 0,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                }
            });
        });

        // Card hover animations
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                gsap.to(this, {
                    y: -4,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
            
            card.addEventListener('mouseleave', function() {
                gsap.to(this, {
                    y: 0,
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>