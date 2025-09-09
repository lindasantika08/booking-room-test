@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Ringkasan aktivitas dan informasi sistem')

@section('content')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .welcome-content {
        position: relative;
        z-index: 2;
    }

    .welcome-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .welcome-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 1rem;
    }

    .welcome-time {
        font-size: 0.875rem;
        opacity: 0.8;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-color, #667eea);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: white;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .trend-up {
        color: #10b981;
    }

    .trend-down {
        color: #ef4444;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }

    .main-content {
        margin-left: 280px; 
        padding: 2rem;
    }


    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }

    .activity-card, .quick-actions-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.875rem;
        color: white;
        flex-shrink: 0;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 500;
        color: #1e293b;
        font-size: 0.875rem;
    }

    .activity-time {
        font-size: 0.75rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .quick-action {
        display: block;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        text-decoration: none;
        color: #334155;
        transition: all 0.3s ease;
    }

    .quick-action:hover {
        background: #667eea;
        color: white;
        transform: translateX(4px);
    }

    .quick-action:last-child {
        margin-bottom: 0;
    }

    .action-title {
        font-weight: 500;
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .action-desc {
        font-size: 0.75rem;
        opacity: 0.8;
    }

    .no-data {
        text-align: center;
        color: #64748b;
        font-style: italic;
        padding: 2rem 0;
    }
</style>

<!-- Welcome Card -->
<div class="welcome-card">
    <div class="welcome-content">
        <h2 class="welcome-title">
            <i class="fas fa-hand-wave" style="color: #fbbf24;"></i>
            Selamat datang, {{ Auth::user()->name }}!
        </h2>
        <p class="welcome-subtitle">
            Semoga hari Anda menyenangkan. Mari mulai bekerja dengan semangat!
        </p>
        <div class="welcome-time">
            <i class="fas fa-clock"></i>
            <span id="current-time">Loading...</span>
        </div>
    </div>
</div>

<!-- Statistics Grid -->
<div class="stats-grid">
    @if(Auth::user()->role === 'admin')
        <div class="stat-card" style="--card-color: #3b82f6;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-value">127</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        +12% dari bulan lalu
                    </div>
                </div>
                <div class="stat-icon" style="background: #3b82f6;">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="--card-color: #10b981;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Booking Hari Ini</div>
                    <div class="stat-value">24</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        +8% dari kemarin
                    </div>
                </div>
                <div class="stat-icon" style="background: #10b981;">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="--card-color: #f59e0b;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Ruangan Tersedia</div>
                    <div class="stat-value">18</div>
                    <div class="stat-trend trend-down">
                        <i class="fas fa-arrow-down"></i>
                        -3 dari kemarin
                    </div>
                </div>
                <div class="stat-icon" style="background: #f59e0b;">
                    <i class="fas fa-door-open"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="--card-color: #ef4444;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Laporan Pending</div>
                    <div class="stat-value">5</div>
                    <div class="stat-trend trend-down">
                        <i class="fas fa-arrow-down"></i>
                        -2 dari kemarin
                    </div>
                </div>
                <div class="stat-icon" style="background: #ef4444;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
        </div>
    @else
        <div class="stat-card" style="--card-color: #3b82f6;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Booking Aktif</div>
                    <div class="stat-value">3</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        +1 booking baru
                    </div>
                </div>
                <div class="stat-icon" style="background: #3b82f6;">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="--card-color: #10b981;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Booking Selesai</div>
                    <div class="stat-value">15</div>
                    <div class="stat-trend trend-up">
                        <i class="fas fa-arrow-up"></i>
                        Bulan ini
                    </div>
                </div>
                <div class="stat-icon" style="background: #10b981;">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <div class="stat-card" style="--card-color: #f59e0b;">
            <div class="stat-header">
                <div>
                    <div class="stat-label">Booking Pending</div>
                    <div class="stat-value">2</div>
                    <div class="stat-trend">
                        <i class="fas fa-clock"></i>
                        Menunggu approval
                    </div>
                </div>
                <div class="stat-icon" style="background: #f59e0b;">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Content Grid -->
<div class="content-grid">
    <!-- Recent Activity -->
    <div class="activity-card">
        <h3 class="card-title">
            <i class="fas fa-history"></i>
            Aktivitas Terbaru
        </h3>
        
        @if(Auth::user()->role === 'admin')
            <div class="activity-item">
                <div class="activity-icon" style="background: #3b82f6;">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">User baru mendaftar</div>
                    <div class="activity-time">John Doe - 2 jam yang lalu</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon" style="background: #10b981;">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Booking ruangan disetujui</div>
                    <div class="activity-time">Meeting Room A - 3 jam yang lalu</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon" style="background: #f59e0b;">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Data ruangan diupdate</div>
                    <div class="activity-time">Conference Hall - 5 jam yang lalu</div>
                </div>
            </div>
        @else
            <div class="activity-item">
                <div class="activity-icon" style="background: #10b981;">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Booking ruangan berhasil</div>
                    <div class="activity-time">Meeting Room B - 1 jam yang lalu</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon" style="background: #3b82f6;">
                    <i class="fas fa-check"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Booking selesai</div>
                    <div class="activity-time">Training Room - Kemarin</div>
                </div>
            </div>
            
            <div class="activity-item">
                <div class="activity-icon" style="background: #8b5cf6;">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Profile diupdate</div>
                    <div class="activity-time">2 hari yang lalu</div>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions-card">
        <h3 class="card-title">
            <i class="fas fa-bolt"></i>
            Aksi Cepat
        </h3>
        
        @if(Auth::user()->role === 'admin')
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-user-plus"></i>
                    Tambah User Baru
                </div>
                <div class="action-desc">Daftarkan user baru ke sistem</div>
            </a>
            
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-chart-bar"></i>
                    Lihat Laporan
                </div>
                <div class="action-desc">Analisis data booking dan penggunaan</div>
            </a>
            
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-door-open"></i>
                    Kelola Ruangan
                </div>
                <div class="action-desc">Tambah atau edit data ruangan</div>
            </a>
            
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-cog"></i>
                    Pengaturan Sistem
                </div>
                <div class="action-desc">Konfigurasi aplikasi</div>
            </a>
        @else
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-plus"></i>
                    Booking Ruangan
                </div>
                <div class="action-desc">Buat reservasi ruangan baru</div>
            </a>
            
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-calendar"></i>
                    Jadwal Booking
                </div>
                <div class="action-desc">Lihat jadwal booking Anda</div>
            </a>
            
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-history"></i>
                    Riwayat Booking
                </div>
                <div class="action-desc">Lihat semua booking sebelumnya</div>
            </a>
            
            <a href="#" class="quick-action">
                <div class="action-title">
                    <i class="fas fa-user"></i>
                    Edit Profile
                </div>
                <div class="action-desc">Update informasi personal</div>
            </a>
        @endif
    </div>
</div>

<script>
    // Update waktu real-time
    function updateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        document.getElementById('current-time').textContent = now.toLocaleDateString('id-ID', options);
    }

    // Update waktu setiap detik
    updateTime();
    setInterval(updateTime, 1000);
</script>
@endsection