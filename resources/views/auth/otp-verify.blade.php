<x-guest-layout>
<style>
    .form-title {
        font-size: 1.625rem; font-weight: 800; color: #1e293b;
        margin-bottom: 0.375rem; text-align: center;
    }
    .form-sub {
        font-size: 0.875rem; color: #64748b; margin-bottom: 2rem;
        text-align: center; line-height: 1.65;
    }

    /* ===== OTP INPUT BOXES ===== */
    .otp-boxes {
        display: flex;
        gap: 0.625rem;
        justify-content: center;
        margin-bottom: 0.5rem;
    }
    .otp-box {
        width: 52px; height: 60px;
        border: 2px solid #e2e8f0;
        border-radius: 0.75rem;
        font-size: 1.5rem; font-weight: 800;
        color: #1e293b; text-align: center;
        outline: none; background: #f9fafb;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        caret-color: #0056B3;
    }
    .otp-box:focus {
        border-color: #0056B3;
        background: white;
        box-shadow: 0 0 0 3px rgba(0,86,179,0.12);
    }
    .otp-box.filled {
        border-color: #0056B3;
        background: #eff6ff;
    }
    .otp-box.error { border-color: #dc2626; background: #fef2f2; }
    @media (max-width: 400px) {
        .otp-box { width: 44px; height: 52px; font-size: 1.3rem; }
        .otp-boxes { gap: 0.5rem; }
    }

    /* Hidden real input for form submit */
    #otp-hidden { display: none; }

    /* ===== TIMER ===== */
    .otp-timer-wrap {
        text-align: center;
        margin-bottom: 1.25rem;
    }
    .otp-timer-badge {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: #fef3c7; border: 1px solid #fde68a;
        color: #92400e; border-radius: 9999px;
        padding: 0.35rem 1rem; font-size: 0.8rem; font-weight: 600;
    }
    .otp-timer-badge.expired { background: #fee2e2; border-color: #fecaca; color: #991b1b; }

    /* ===== ALERTS ===== */
    .status-alert {
        display: flex; align-items: center; gap: 0.6rem;
        background: #d1fae5; border: 1px solid #a7f3d0;
        color: #065f46; padding: 0.75rem 1rem;
        border-radius: 0.625rem; font-size: 0.875rem; margin-bottom: 1.25rem;
        text-align: left;
    }
    .warning-alert {
        display: flex; align-items: center; gap: 0.6rem;
        background: #fef3c7; border: 1px solid #fde68a;
        color: #92400e; padding: 0.65rem 1rem;
        border-radius: 0.625rem; font-size: 0.82rem; margin-bottom: 1rem;
        text-align: left;
    }
    .error-alert {
        display: flex; align-items: center; gap: 0.6rem;
        background: #fef2f2; border: 1px solid #fecaca;
        color: #991b1b; padding: 0.65rem 1rem;
        border-radius: 0.625rem; font-size: 0.82rem; margin-bottom: 1rem;
    }
    .form-error { color: #dc2626; font-size: 0.78rem; text-align: center; margin-top: 0.4rem; }

    /* ===== SUBMIT ===== */
    .btn-verify {
        width: 100%; padding: 0.875rem;
        background: linear-gradient(135deg, #0056B3 0%, #003d80 100%);
        color: white; border: none; border-radius: 0.625rem;
        font-size: 0.95rem; font-weight: 700;
        cursor: pointer; transition: all 0.2s;
        display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        margin-top: 1.5rem;
        box-shadow: 0 4px 14px rgba(0,86,179,0.28);
        letter-spacing: 0.02em;
    }
    .btn-verify:hover {
        background: linear-gradient(135deg, #004494 0%, #001f4d 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(0,86,179,0.38);
    }
    .btn-verify:active { transform: translateY(0); }
    .btn-verify:disabled { opacity: 0.65; cursor: not-allowed; transform: none; }

    /* ===== DIVIDER ===== */
    .form-divider {
        display: flex; align-items: center; gap: 0.75rem;
        margin: 1.5rem 0 1.25rem;
        color: #cbd5e1; font-size: 0.78rem;
    }
    .form-divider::before,
    .form-divider::after { content: ''; flex: 1; height: 1px; background: #e5e7eb; }

    /* ===== RESEND ===== */
    .resend-section { text-align: center; }
    .resend-btn {
        background: none; border: 1.5px solid #0056B3;
        color: #0056B3; font-weight: 600; font-size: 0.875rem;
        padding: 0.6rem 1.5rem; border-radius: 0.625rem;
        cursor: pointer; text-decoration: none;
        display: inline-flex; align-items: center; gap: 0.4rem;
        transition: all 0.2s;
    }
    .resend-btn:hover { background: #eff6ff; }
    .resend-btn:disabled {
        color: #9ca3af; border-color: #e5e7eb;
        cursor: not-allowed; background: none;
    }
    .resend-info { font-size: 0.78rem; color: #64748b; margin-top: 0.625rem; }
    .resend-info.danger { color: #dc2626; }

    @keyframes spin { to { transform: rotate(360deg); } }
</style>

{{-- Email badge --}}
<div style="text-align:center;margin-bottom:1rem;">
    <div style="display:inline-flex;align-items:center;gap:0.5rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:9999px;padding:0.35rem 1rem;font-size:0.8rem;color:#1d4ed8;font-weight:600;">
        <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        Kode OTP telah dikirim ke email Anda
    </div>
</div>

<div class="form-title">Verifikasi Keamanan 🔐</div>
<div class="form-sub">
    Masukkan 6 digit kode OTP yang kami kirimkan ke email Anda untuk menyelesaikan proses login.
</div>

@if(session('status'))
    <div class="status-alert">
        <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('status') }}
    </div>
@endif

@if(session('mail_error'))
    <div class="warning-alert">
        <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        {{ session('mail_error') }}
    </div>
@endif

@if($errors->any())
    <div class="error-alert">
        <svg style="width:16px;height:16px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ $errors->first() }}
    </div>
@endif

{{-- Timer --}}
<div class="otp-timer-wrap">
    <div class="otp-timer-badge" id="timer-badge">
        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Berlaku: <span id="timer-countdown">5:00</span>
    </div>
</div>

<form method="POST" action="{{ route('otp.verify') }}" id="otp-form">
    @csrf

    {{-- OTP Boxes --}}
    <div class="otp-boxes" id="otp-boxes">
        <input class="otp-box {{ $errors->has('otp') || $errors->has('email') ? 'error' : '' }}" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-idx="0" autocomplete="off">
        <input class="otp-box {{ $errors->has('otp') || $errors->has('email') ? 'error' : '' }}" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-idx="1" autocomplete="off">
        <input class="otp-box {{ $errors->has('otp') || $errors->has('email') ? 'error' : '' }}" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-idx="2" autocomplete="off">
        <input class="otp-box {{ $errors->has('otp') || $errors->has('email') ? 'error' : '' }}" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-idx="3" autocomplete="off">
        <input class="otp-box {{ $errors->has('otp') || $errors->has('email') ? 'error' : '' }}" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-idx="4" autocomplete="off">
        <input class="otp-box {{ $errors->has('otp') || $errors->has('email') ? 'error' : '' }}" type="text" maxlength="1" inputmode="numeric" pattern="[0-9]" data-idx="5" autocomplete="off">
    </div>
    {{-- Hidden field for real submission --}}
    <input type="hidden" name="otp" id="otp-hidden" value="{{ old('otp') }}">

    @error('otp')   <div class="form-error">{{ $message }}</div> @enderror
    @error('email') <div class="form-error">{{ $message }}</div> @enderror

    <button type="submit" class="btn-verify" id="btn-verify">
        <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Verifikasi &amp; Masuk
    </button>
</form>

<div class="form-divider">Belum menerima kode?</div>

<div class="resend-section">
    @if($canResend)
        <form method="POST" action="{{ route('otp.resend') }}" style="display:inline;" id="resend-form">
            @csrf
            <button type="submit" class="resend-btn" id="btn-resend">
                <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Kirim Ulang OTP
            </button>
        </form>
        <div class="resend-info">
            Sisa: <strong>{{ 3 - $resendCount }}x</strong> dari 3x (dalam 15 menit)
        </div>
    @else
        <button type="button" class="resend-btn" disabled>
            <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Kirim Ulang OTP
        </button>
        <div class="resend-info danger">
            Batas pengiriman OTP tercapai (3x).
            @if($lockedUntil)
                <span id="resend-countdown"></span>
            @endif
        </div>
    @endif
</div>

<div style="margin-top:1.5rem;text-align:center;">
    <a href="{{ route('login') }}" style="font-size:0.8rem;color:#94a3b8;text-decoration:none;display:inline-flex;align-items:center;gap:0.3rem;">
        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Kembali ke halaman Login
    </a>
</div>

<script>
(function() {
    /* ===== OTP BOX NAVIGATION ===== */
    const boxes    = Array.from(document.querySelectorAll('.otp-box'));
    const hiddenOtp = document.getElementById('otp-hidden');

    function syncHidden() {
        hiddenOtp.value = boxes.map(b => b.value).join('');
    }

    boxes.forEach((box, idx) => {
        box.addEventListener('input', function () {
            // Allow only digits
            this.value = this.value.replace(/\D/g, '').slice(-1);
            this.classList.toggle('filled', this.value !== '');
            syncHidden();
            if (this.value && idx < boxes.length - 1) {
                boxes[idx + 1].focus();
            }
        });

        box.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !this.value && idx > 0) {
                boxes[idx - 1].value = '';
                boxes[idx - 1].classList.remove('filled');
                boxes[idx - 1].focus();
                syncHidden();
            }
        });

        box.addEventListener('paste', function (e) {
            e.preventDefault();
            const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
            pasted.split('').slice(0, 6).forEach((char, i) => {
                if (boxes[i]) {
                    boxes[i].value = char;
                    boxes[i].classList.add('filled');
                }
            });
            syncHidden();
            const nextEmpty = boxes.findIndex(b => !b.value);
            if (nextEmpty !== -1) boxes[nextEmpty].focus();
            else boxes[5].focus();
        });
    });

    // Pre-fill from old value if any
    const oldVal = hiddenOtp.value;
    if (oldVal) {
        oldVal.split('').forEach((char, i) => {
            if (boxes[i]) { boxes[i].value = char; boxes[i].classList.add('filled'); }
        });
    }

    // Focus first empty on load
    const firstEmpty = boxes.findIndex(b => !b.value);
    if (firstEmpty !== -1) boxes[firstEmpty].focus();

    /* ===== OTP COUNTDOWN (5 min) ===== */
    const timerBadge    = document.getElementById('timer-badge');
    const countdownEl   = document.getElementById('timer-countdown');
    let timeLeft        = 300;

    function updateTimer() {
        const m = Math.floor(timeLeft / 60);
        const s = timeLeft % 60;
        countdownEl.textContent = `${m}:${s.toString().padStart(2, '0')}`;
        if (timeLeft <= 0) {
            timerBadge.classList.add('expired');
            timerBadge.innerHTML = `
                <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Kode OTP telah kadaluarsa`;
            document.getElementById('btn-verify').disabled = true;
            return;
        }
        timeLeft--;
        setTimeout(updateTimer, 1000);
    }
    updateTimer();

    /* ===== RESEND LOCKOUT COUNTDOWN ===== */
    @if(!$canResend && $lockedUntil)
    const resendEl   = document.getElementById('resend-countdown');
    const lockedUntil = new Date('{{ $lockedUntil }}');
    function updateResend() {
        const diff = Math.max(0, Math.floor((lockedUntil - new Date()) / 1000));
        if (!resendEl) return;
        if (diff <= 0) { resendEl.textContent = ' Silakan refresh halaman.'; return; }
        const m = Math.floor(diff / 60), s = diff % 60;
        resendEl.textContent = ` Coba lagi dalam ${m}:${s.toString().padStart(2, '0')}`;
        setTimeout(updateResend, 1000);
    }
    updateResend();
    @endif

    /* ===== SUBMIT LOADING ===== */
    document.getElementById('otp-form').addEventListener('submit', function (e) {
        const code = hiddenOtp.value;
        if (code.length < 6) {
            e.preventDefault();
            boxes.forEach(b => b.classList.add('error'));
            return;
        }
        const btn = document.getElementById('btn-verify');
        btn.disabled = true;
        btn.innerHTML = `<svg style="width:18px;height:18px;animation:spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Memverifikasi...`;
    });

    /* ===== RESEND LOADING ===== */
    const resendForm = document.getElementById('resend-form');
    if (resendForm) {
        resendForm.addEventListener('submit', function() {
            const btn = document.getElementById('btn-resend');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<svg style="width:15px;height:15px;animation:spin 1s linear infinite;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Mengirim...`;
            }
        });
    }
})();
</script>
</x-guest-layout>
