@extends('layouts.app')

@section('title', 'Kelola Ruangan')

@section('content')
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
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

        .activity-card,
        .quick-actions-card {
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

        /* Room Card Hover Effects */
        .room-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .book-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .book-btn[style*="background: #10b981"]:hover {
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .book-btn[style*="background: #8b5cf6"]:hover {
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .rooms-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 1rem !important;
            }
        }

        @media (max-width: 768px) {
            .rooms-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }

            .room-info {
                padding: 1rem !important;
            }

            .room-image {
                height: 150px !important;
            }
        }
    </style>

    <!-- Statistics Grid -->
    <div class="stats-grid">
        @if(Auth::user()->role === 'admin')

            <!-- Rooms Grid -->
            <!-- Rooms Grid -->
            <div class="rooms-grid"
                style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-top: 1.5rem;">
                @forelse($rooms as $room)
                    <div class="room-card"
                        style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e2e8f0; transition: all 0.3s ease; cursor: pointer;">

                        {{-- Gambar --}}
                        <img src="{{ asset($room->image) }}" alt="{{ $room->name }}"
                            style="width: 100%; height: 200px; object-fit: cover;">

                        {{-- Info --}}
                        <div class="room-info" style="padding: 1.5rem;">
                            <h3 style="font-size: 1.125rem; font-weight: 600; color: #1e293b; margin-bottom: 0.75rem;">
                                {{ $room->name }}
                            </h3>
                            <div class="room-details"
                                style="display: flex; flex-direction: column; gap: 0.5rem; margin-bottom: 1rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: #64748b; font-size: 0.875rem;">
                                    <i class="fas fa-user-friends" style="width: 16px;"></i>
                                    <span>Kapasitas: {{ $room->capacity }} orang</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: #64748b; font-size: 0.875rem;">
                                    <i class="fas fa-tools" style="width: 16px;"></i>
                                    <span>{{ $room->property }}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.5rem; color: #64748b; font-size: 0.875rem;">
                                    <i class="fas fa-map-marker-alt" style="width: 16px;"></i>
                                    <span>{{ $room->location }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <a href="{{ route('user.show', $room->id) }}" class="book-btn"
                            style="width: 100%; display:inline-block; text-align:center; background: #667eea; color: white; border: none; padding: 0.75rem; border-radius: 8px; font-weight: 500; cursor: pointer; transition: all 0.3s ease;">
                            <i class="fas fa-calendar-plus"></i> Lihat Detail
                        </a>
                    </div>
                @empty
                    <p class="no-data">Belum ada data ruangan tersedia.</p>
                @endforelse
            </div>



        @else
            <!-- Original user stats section -->
            <div class="stats-grid">
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
            </div>
        @endif
    </div>

    <!-- Content Grid -->

    <script>

        function bookRoom(roomId) {
            // Redirect to booking form with pre-selected room
            // window.location.href = `/booking/create?room=${roomId}`;

            // Or show a booking modal
            alert(`Booking form untuk ${roomId} akan segera dibuka!`);

            // Example: Open booking modal
            // $('#bookingModal').modal('show');
            // $('#roomSelect').val(roomId);
        }
    </script>
@endsection