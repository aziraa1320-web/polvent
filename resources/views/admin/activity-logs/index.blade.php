@extends('layouts.app')

@section('title', 'Activity Logs')
@section('page-title', 'Activity Logs')
@section('page-breadcrumb', 'Admin / <span>Activity Logs</span>')

@section('content')

<div class="page-header">
    <h1>Log Aktivitas Sistem</h1>
    <p>Monitoring semua tindakan yang dilakukan oleh pengguna di dalam sistem POLVENT</p>
</div>

<div class="table-wrapper">
    <div class="table-header">
        <h3>⚡ Catatan Aktivitas</h3>
        
        <form method="GET" action="{{ route('admin.activity-logs.index') }}" style="display:flex;gap:0.5rem;align-items:center;">
            <select name="action_type" class="form-input" style="padding:0.4rem 0.75rem;width:auto;" onchange="this.form.submit()">
                <option value="">Semua Aktivitas</option>
                <option value="create" {{ request('action_type') === 'create' ? 'selected' : '' }}>Create (Tambah Data)</option>
                <option value="update" {{ request('action_type') === 'update' ? 'selected' : '' }}>Update (Ubah Data)</option>
                <option value="delete" {{ request('action_type') === 'delete' ? 'selected' : '' }}>Delete (Hapus Data)</option>
                <option value="login" {{ request('action_type') === 'login' ? 'selected' : '' }}>Login</option>
                <option value="register" {{ request('action_type') === 'register' ? 'selected' : '' }}>Register</option>
                <option value="approve" {{ request('action_type') === 'approve' ? 'selected' : '' }}>Approve</option>
                <option value="reject" {{ request('action_type') === 'reject' ? 'selected' : '' }}>Reject</option>
            </select>
        </form>
    </div>

    @if($logs->count())
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Pengguna</th>
                    <th>Tindakan</th>
                    <th>Deskripsi Aktivitas</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td style="font-size:0.82rem;color:#64748b;white-space:nowrap;">
                            {{ $log->created_at->format('d M Y, H:i:s') }}
                            <div style="font-size:0.7rem;margin-top:2px;">{{ $log->created_at->diffForHumans() }}</div>
                        </td>
                        <td>
                            @if($log->user)
                                <div style="display:flex;align-items:center;gap:0.5rem;">
                                    <div style="width:28px;height:28px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.65rem;color:#374151;flex-shrink:0;">
                                        {{ strtoupper(substr($log->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:600;color:#1e293b;font-size:0.845rem;">{{ $log->user->name }}</div>
                                        <div style="font-size:0.72rem;color:#64748b;">Role: {{ $log->user->role }}</div>
                                    </div>
                                </div>
                            @else
                                <span style="color:#94a3b8;font-size:0.8rem;font-style:italic;">System / Guest</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $actionStr = strtolower($log->action);
                                $actionColor = '#64748b'; $actionBg = '#f1f5f9';
                                if (str_contains($actionStr, 'create') || str_contains($actionStr, 'register') || str_contains($actionStr, 'approve')) {
                                    $actionColor = '#059669'; $actionBg = '#d1fae5';
                                } elseif (str_contains($actionStr, 'update')) {
                                    $actionColor = '#2563eb'; $actionBg = '#dbeafe';
                                } elseif (str_contains($actionStr, 'delete') || str_contains($actionStr, 'reject')) {
                                    $actionColor = '#dc2626'; $actionBg = '#fee2e2';
                                } elseif (str_contains($actionStr, 'login')) {
                                    $actionColor = '#0f766e'; $actionBg = '#ccfbf1';
                                }
                            @endphp
                            <span style="font-size:0.7rem;font-weight:700;padding:0.2rem 0.5rem;border-radius:4px;background:{{ $actionBg }};color:{{ $actionColor }};text-transform:uppercase;">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td style="font-size:0.845rem;color:#374151;">
                            {{ $log->description }}
                        </td>
                        <td style="font-size:0.78rem;color:#94a3b8;font-family:monospace;">
                            {{ $log->ip_address ?? '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
            {{ $logs->links() }}
        </div>
    @else
        <div class="empty-state" style="padding:4rem;">
            <div class="empty-state-icon">⚡</div>
            <h3>Belum ada aktivitas tercatat</h3>
            @if(request('action_type'))
                <p>Tidak ditemukan log aktivitas dengan filter tersebut.</p>
                <a href="{{ route('admin.activity-logs.index') }}" class="btn btn-secondary btn-sm" style="margin-top:1rem;">Reset Filter</a>
            @else
                <p>Sistem masih bersih, belum ada tindakan yang terekam.</p>
            @endif
        </div>
    @endif
</div>

@endsection
