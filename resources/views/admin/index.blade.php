@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<h4 class="mb-4 fw-bold">Tổng quan hệ thống</h4>

<!-- Statistics Cards -->
<div class="row mb-4 g-3">
    <div class="col-md-6 col-lg-4">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Tổng số Tour</p>
                    <h2 class="fw-bold mb-0">{{ $tourCount }}</h2>
                </div>
                <div style="width:52px;height:52px;border-radius:14px;background:rgba(14,165,233,0.12);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#0ea5e9;">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Đơn đặt tour (Thành công)</p>
                    <h2 class="fw-bold mb-0">{{ $bookingCount }}</h2>
                </div>
                <div style="width:52px;height:52px;border-radius:14px;background:rgba(34,197,94,0.12);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#22c55e;">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted small mb-1">Tổng Doanh thu</p>
                    <h2 class="fw-bold mb-0">{{ format_currency($totalRevenue) }}</h2>
                </div>
                <div style="width:52px;height:52px;border-radius:14px;background:rgba(245,158,11,0.12);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#f59e0b;">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row mb-4 g-3">
    <!-- Revenue Chart -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header-custom">
                <h6 class="fw-bold mb-0"><i class="fas fa-chart-bar text-primary me-2"></i>Doanh thu theo tháng (Năm hiện tại)</h6>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>

    <!-- Booking Status Chart -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header-custom">
                <h6 class="fw-bold mb-0"><i class="fas fa-chart-pie text-success me-2"></i>Trạng thái đơn hàng</h6>
            </div>
            <div class="card-body d-flex justify-content-center align-items-center">
                <canvas id="bookingStatusChart" style="max-height: 250px;"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-3"><i class="fas fa-bolt text-warning me-2"></i>Thao tác nhanh</h6>
        <div class="row g-3">
            <div class="col-md-3">
                <a href="{{ route('admin.tours.create') }}" class="btn btn-primary w-100 py-3">
                    <i class="fas fa-plus-circle me-2"></i> Thêm Tour mới
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.tours.index') }}" class="btn btn-info w-100 py-3 text-white">
                    <i class="fas fa-list me-2"></i> Xem tất cả Tour
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.bookings.index') }}" class="btn btn-success w-100 py-3">
                    <i class="fas fa-check-circle me-2"></i> Quản lý Booking
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary w-100 py-3">
                    <i class="fas fa-eye me-2"></i> Xem Website
                </a>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Biểu đồ doanh thu
        const revCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($revenueMonths ?? []) !!},
                datasets: [{
                    label: 'Doanh thu (VNĐ)',
                    data: {!! json_encode($revenueData ?? []) !!},
                    backgroundColor: 'rgba(14, 165, 233, 0.5)',
                    borderColor: 'rgba(14, 165, 233, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.raw.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                }
            }
        });

        // Biểu đồ trạng thái đơn hàng
        const statusCtx = document.getElementById('bookingStatusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Thành công', 'Đang chờ', 'Đã hủy'],
                datasets: [{
                    data: [
                        {{ $bookingStatusData['confirmed'] ?? 0 }},
                        {{ $bookingStatusData['pending'] ?? 0 }},
                        {{ $bookingStatusData['cancelled'] ?? 0 }}
                    ],
                    backgroundColor: [
                        '#22c55e', // Success
                        '#f59e0b', // Pending
                        '#ef4444'  // Cancelled
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script>
@endsection