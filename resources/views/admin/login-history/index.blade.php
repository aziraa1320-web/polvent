@extends('layouts.app')

@section('title', 'Login History')
@section('page-title', 'Login History')
@section('page-breadcrumb')
    Admin / <span>Login History</span>
@endsection

@section('content')

<div class="page-header">
    <h1>Log Aktivitas Login</h1>
    <p>Monitoring semua riwayat percobaan akses masuk pengguna ke sistem</p>
</div>

<div class="table-wrapper">
    <div class="table-header">
        <h3>⚡ Catatan Akses Keamanan</h3>
    </div>

    @if($histories->count())
        <table>
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Pengguna</th>
                    <th>IP Address & Browser</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $log)
                    <tr>
                        <td style="font-size:0.82rem;color:#64748b;white-space:nowrap;">
                            {{ $log->created_at->format('d M Y, H:i:s') }}
                            <div style="font-size:0.7rem;margin-top:2px;">{{ $log->created_at->diffForHumans() }}</div>
                        </td>
                        <td style="font-size:0.845rem;color:#1e293b;font-weight:600;">
                            {{ $log->email }}
                        </td>
                        <td>
                            @php
                                $statusColor = $log->status === 'success' ? '#059669' : '#dc2626';
                                $statusBg = $log->status === 'success' ? '#d1fae5' : '#fee2e2';
                            @endphp
                            <span style="font-size:0.7rem;font-weight:700;padding:0.2rem 0.5rem;border-radius:4px;background:{{ $statusBg }};color:{{ $statusColor }};text-transform:uppercase;">
                                {{ $log->status }}
                            </span>
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
                                <span style="color:#94a3b8;font-size:0.8rem;font-style:italic;">User tidak ditemukan</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-size:0.78rem;color:#374151;font-family:monospace;margin-bottom:2px;">
                                IP: {{ $log->ip_address ?? '-' }}
                            </div>
                            <div style="font-size:0.7rem;color:#94a3b8;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $log->user_agent }}">
                                {{ $log->user_agent ?? '-' }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="padding:1rem 1.5rem;border-top:1px solid #f1f5f9;">
            {{ $histories->links() }}
        </div>
    @else
        <div class="empty-state" style="padding:4rem;">
            <div class="empty-state-icon">🛡️</div>
            <h3>Belum ada percobaan login tercatat</h3>
            <p>Sistem masih bersih, belum ada tindakan login yang terekam.</p>
        </div>
    @endif
</div>

@endsection
