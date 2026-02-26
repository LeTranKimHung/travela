@extends('admin.layouts.app')
@section('title', 'Quản lý Đơn đặt tour')
@section('page-title', 'Quản lý Đơn đặt tour')

@section('content')
<h4 class="fw-bold mb-4">Danh sách Đơn đặt tour</h4>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Khách hàng</th>
                        <th>Tour</th>
                        <th class="d-none d-md-table-cell">Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $booking->bookingId }}</td>
                        <td>{{ $booking->userName }}</td>
                        <td class="text-truncate" style="max-width:160px;">{{ $booking->tourTitle }}</td>
                        <td class="d-none d-md-table-cell text-muted small">{{ $booking->bookingDate }}</td>
                        <td class="fw-bold">{{ number_format($booking->totalPrice) }} đ</td>
                        <td>
                            @if(in_array($booking->bookingStatus, ['cancelled', 'canceled']))
                                <span class="badge bg-danger">Đã hủy</span>
                            @elseif($booking->bookingStatus == 'confirmed')
                                <span class="badge bg-success">Đã xác nhận</span>
                            @elseif($booking->bookingStatus == 'completed')
                                <span class="badge bg-primary">Hoàn thành</span>
                            @else
                                <span class="badge bg-warning text-dark">Chờ duyệt</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                @if(!in_array($booking->bookingStatus, ['cancelled', 'canceled', 'confirmed', 'completed']))
                                    <form action="{{ route('admin.bookings.update-status', [$booking->bookingId, 'confirmed']) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-success" title="Xác nhận"><i class="fas fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.bookings.update-status', [$booking->bookingId, 'cancelled']) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm btn-danger" title="Hủy"><i class="fas fa-times"></i></button>
                                    </form>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($bookings->isEmpty())
                    <tr><td colspan="7" class="text-center py-5 text-muted">Chưa có đơn đặt tour nào.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
