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
                    <p class="text-muted small mb-1">Đơn đặt tour</p>
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
                    <p class="text-muted small mb-1">Doanh thu tháng</p>
                    <h2 class="fw-bold mb-0">{{ format_currency($totalRevenue) }}</h2>
                </div>
                <div style="width:52px;height:52px;border-radius:14px;background:rgba(245,158,11,0.12);display:flex;align-items:center;justify-content:center;font-size:1.3rem;color:#f59e0b;">
                    <i class="fas fa-dollar-sign"></i>
                </div>
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
@endsection