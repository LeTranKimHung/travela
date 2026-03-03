@extends('admin.layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Quản lý Mã Giảm Giá</h6>
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Thêm mới</a>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">Code</th>
                                <th scope="col">Loại / Giá trị</th>
                                <th scope="col">Đơn tối thiểu</th>
                                <th scope="col">Đã dùng / Giới hạn</th>
                                <th scope="col">Thời hạn</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $item)
                            <tr>
                                <td><strong>{{ $item->code }}</strong></td>
                                <td>
                                    @if($item->type == 'percent')
                                        {{ floatval($item->value) }}%
                                    @else
                                        {{ number_format($item->value, 0, ',', '.') }} đ
                                    @endif
                                </td>
                                <td>{{ number_format($item->min_order_value, 0, ',', '.') }} đ</td>
                                <td>{{ $item->used_count }} / {{ $item->usage_limit ?: '∞' }}</td>
                                <td>
                                    <div>Từ: {{ $item->starts_at ? \Carbon\Carbon::parse($item->starts_at)->format('d/m/Y H:i') : '---' }}</div>
                                    <div>Đến: {{ $item->expires_at ? \Carbon\Carbon::parse($item->expires_at)->format('d/m/Y H:i') : '---' }}</div>
                                </td>
                                <td>
                                    @if($item->is_active)
                                        <span class="badge bg-success">Hoạt động</span>
                                    @else
                                        <span class="badge bg-danger">Khóa</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.coupons.edit', $item->couponId) }}">Sửa</a>
                                    <form action="{{ route('admin.coupons.destroy', $item->couponId) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa mã này?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
