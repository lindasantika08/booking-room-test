@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
    <style>
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            background: #f8fafc;
            min-height: 100vh;
        }

        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }

        .page-header {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            border-left: 4px solid #3b82f6;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .search-box {
            position: relative;
            margin-bottom: 0;
        }

        .search-box input {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.5rem 2.5rem 0.5rem 1rem;
            border-radius: 8px;
            width: 250px;
            font-size: 0.9rem;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-box input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.2);
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        .data-table thead th {
            background: #f8fafc;
            color: #374151;
            font-weight: 600;
            padding: 1rem;
            text-align: left;
            border-bottom: 2px solid #e5e7eb;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: all 0.2s ease;
        }

        .data-table tbody tr:hover {
            background: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .data-table tbody tr:last-child {
            border-bottom: none;
        }

        .data-table td {
            padding: 1rem;
            color: #4b5563;
            vertical-align: middle;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-details h4 {
            font-weight: 600;
            color: #1f2937;
            margin: 0;
            font-size: 0.95rem;
        }

        .user-details p {
            color: #6b7280;
            margin: 0;
            font-size: 0.85rem;
        }

        .role-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .role-admin {
            background: linear-gradient(135deg, #ec4899, #be185d);
            color: white;
        }

        .role-user {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .role-moderator {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-edit {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .btn-add {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .no-data img {
            max-width: 200px;
            opacity: 0.5;
            margin-bottom: 1rem;
        }

        .table-footer {
            padding: 1rem;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .data-table {
                font-size: 0.85rem;
            }

            .data-table th,
            .data-table td {
                padding: 0.75rem 0.5rem;
            }

            .user-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.3rem;
            }

            .btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.8rem;
            }

            .search-box input {
                width: 100%;
            }

            .table-header {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>

    <div class="table-container">
        <!-- Table Header -->
        <div class="table-header">
            <h2 class="text-lg font-semibold">Daftar Pengguna</h2>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <div class="search-box">
                    <input type="text" placeholder="Cari pengguna..." id="searchInput">
                    <i class="search-icon">🔍</i>
                </div>
                <button class="btn btn-add">
                    <span>➕</span> Tambah Pengguna
                </button>
            </div>
        </div>

        <!-- Table Content -->
        @if(isset($users) && count($users) > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th style="width: 120px;">Peran</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td style="text-align: center; font-weight: 600; color: #6b7280;">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div class="user-details">
                                        <h4>{{ $user->name ?? 'Nama tidak tersedia' }}</h4>
                                        <p>Bergabung {{ isset($user->created_at) ? $user->created_at->format('M Y') : '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="color: #3b82f6;">{{ $user->email ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="role-badge role-{{ strtolower($user->role ?? 'user') }}">
                                    {{ ucfirst($user->role ?? 'User') }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit" onclick="editUser({{ $user->id ?? 0 }})">
                                        <span>✏️</span> Edit
                                    </button>
                                    <button class="btn btn-delete" onclick="deleteUser({{ $user->id ?? 0 }})">
                                        <span>🗑️</span> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Table Footer -->
            <div class="table-footer">
                <span>Menampilkan {{ count($users) }} pengguna</span>
                <span>Total: {{ count($users) }} pengguna</span>
            </div>
        @else
            <div class="no-data">
                <div style="font-size: 3rem; margin-bottom: 1rem;">👥</div>
                <h3 style="color: #6b7280; margin-bottom: 0.5rem;">Tidak ada data pengguna</h3>
                <p>Belum ada pengguna yang terdaftar dalam sistem.</p>
            </div>
        @endif
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput')?.addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('.data-table tbody tr');

            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Action functions
        function editUser(userId) {
            // Implement edit functionality
            console.log('Edit user:', userId);
            // You can redirect to edit page or open modal
            // window.location.href = `/users/${userId}/edit`;
        }

        function deleteUser(userId) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                // Implement delete functionality
                console.log('Delete user:', userId);
                // You can make AJAX request or redirect
                // fetch(`/users/${userId}`, { method: 'DELETE' })...
            }
        }
    </script>

@endsection