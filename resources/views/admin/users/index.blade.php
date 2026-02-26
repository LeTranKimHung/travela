@extends('admin.layouts.app')
@section('title', 'Quản lý Tài khoản')
@section('page-title', 'Quản lý Tài khoản')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Danh sách tài khoản</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Thêm tài khoản
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Tên đăng nhập</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th class="pe-4 text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="ps-4 fw-bold">{{ $user->userId }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-user-circle text-secondary"></i>
                                {{ $user->userName }}
                            </div>
                        </td>
                        <td>{{ $user->fullName }}</td>
                        <td class="text-muted small">{{ $user->email }}</td>
                        <td>
                            @if($user->role === 'a')
                                <span class="badge bg-danger"><i class="fas fa-shield-alt me-1"></i>Admin</span>
                            @else
                                <span class="badge bg-info"><i class="fas fa-user me-1"></i>Người dùng</span>
                            @endif
                        </td>
                        <td>
                            @if($user->isActive === 'y')
                                <span class="badge bg-success">Hoạt động</span>
                            @else
                                <span class="badge bg-secondary">Bị khóa</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.users.edit', $user->userId) }}" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.users.destroy', $user->userId) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @if($users->isEmpty())
                    <tr><td colspan="7" class="text-center py-5 text-muted">Chưa có tài khoản nào.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
