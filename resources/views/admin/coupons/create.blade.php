@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4 justify-content-center">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Thêm Mã Giảm Giá Mới</h6>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.coupons.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Mã Code (VD: SUMMER2026)</label>
                        <input type="text" class="form-control" name="code" value="{{ old('code') }}" required style="text-transform: uppercase;">
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Loại giảm giá</label>
                            <select class="form-select" name="type">
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Giảm theo phần trăm (%)</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Giảm số tiền cố định (VNĐ)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giá trị giảm</label>
                            <input type="number" class="form-control" name="value" value="{{ old('value') }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Giá trị Đơn hàng tối thiểu (VNĐ)</label>
                            <input type="number" class="form-control" name="min_order_value" value="{{ old('min_order_value', 0) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giới hạn số lần sử dụng tổng (Để trống nếu ko giới hạn)</label>
                            <input type="number" class="form-control" name="usage_limit" value="{{ old('usage_limit') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Ngày bắt đầu áp dụng</label>
                            <input type="datetime-local" class="form-control" name="starts_at" value="{{ old('starts_at') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ngày hết hạn</label>
                            <input type="datetime-local" class="form-control" name="expires_at" value="{{ old('expires_at') }}">
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                        <label class="form-check-label" for="is_active">Kích hoạt mã</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Lưu mã giảm giá</button>
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
