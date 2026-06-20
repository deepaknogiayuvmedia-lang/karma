@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('Verify Account'))

@push('css_or_js')
<style>
    /* ── Page wrapper ───────────────────────────────── */
    .verify-section {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 3rem 1rem;
        background: linear-gradient(135deg, #f0f4ff 0%, #fafaff 100%);
        position: relative;
        overflow: hidden;
    }

    /* Decorative blobs */
    .verify-section::before {
        content: '';
        position: absolute;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(99,102,241,0.12) 0%, transparent 70%);
        top: -120px;
        right: -80px;
        border-radius: 50%;
        pointer-events: none;
    }
    .verify-section::after {
        content: '';
        position: absolute;
        width: 350px;
        height: 350px;
        background: radial-gradient(circle, rgba(236,72,153,0.08) 0%, transparent 70%);
        bottom: -100px;
        left: -60px;
        border-radius: 50%;
        pointer-events: none;
    }

    /* ── Card ───────────────────────────────────────── */
    .verify-card {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 450px;
        border-radius: 24px;
        overflow: hidden;
      
        background: #fff;
    }

    /* ── Gradient Header ────────────────────────────── */
    .verify-card-header {
    
        padding: 2.5rem 2rem 3.8rem;
        text-align: center;
        position: relative;
    }
    .shield-icon-wrap {
        width: 72px;
        height: 72px;
        background: rgba(255,255,255,0.18);
        border: 2px solid rgba(255,255,255,0.35);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        backdrop-filter: blur(6px);
    }
    .shield-icon-wrap svg {
        width: 36px;
        height: 36px;
        fill: #00695C;
    }
    .verify-card-header h2 {
     
        font-size: 1.45rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
    }
    .verify-card-header p {
     
        font-size: 0.875rem;
        margin: 0;
        line-height: 1.6;
    }
    .hint-badge {
        display: inline-block;
        margin-top: 0.8rem;
        padding: 0.28rem 0.9rem;
        background: rgba(255,255,255,0.2);
        border: 1px solid rgba(255,255,255,0.35);
        border-radius: 50px;
        font-size: 0.82rem;
   
        letter-spacing: 0.03em;
    }
    /* Wave overlap */
    .verify-card-header::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 44px;
        background: #fff;
        border-radius: 55% 55% 0 0 / 70px 70px 0 0;
    }

    /* ── Card Body ──────────────────────────────────── */
    .verify-card-body {
        padding: 1.5rem 2rem 2rem;
    }

    /* ── OTP Label ──────────────────────────────────── */
    .otp-label {
        text-align: center;
        font-size: 0.78rem;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 1.1rem;
    }

    /* ── 4 Digit Boxes ──────────────────────────────── */
    .otp-inputs {
        display: flex;
        justify-content: center;
        gap: 14px;
        margin-bottom: 2rem;
    }
    .otp-digit {
        width: 62px;
        height: 68px;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        background: #f9fafb;
        font-size: 1.8rem;
        font-weight: 700;
        text-align: center;
        color: #1f2937;
        outline: none;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        -moz-appearance: textfield;
    }
    .otp-digit::-webkit-outer-spin-button,
    .otp-digit::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .otp-digit:focus {
        border-color: #00695C;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(99,102,241,0.14);
    }
    .otp-digit.otp-filled {
        border-color: #00695C;
        background: #f5f3ff;
        color: #4f46e5;
    }

    /* ── Verify Button ──────────────────────────────── */
    .btn-verify-otp {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 14px;
        background: #00695C;
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(99,102,241,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 1.5rem;
    }
    .btn-verify-otp:hover {
        background:  #00695C;
        box-shadow: 0 6px 20px rgba(99,102,241,0.42);
        transform: translateY(-1px);
    }
    .btn-verify-otp:active { transform: translateY(0); }

    /* ── Resend / Timer ─────────────────────────────── */
    .resend-area {
        text-align: center;
        margin-bottom: 1.2rem;
    }
    .timer-text {
        font-size: 0.83rem;
        color: #9ca3af;
        margin-bottom: 0.45rem;
    }
    .timer-text .timer-val {
        font-weight: 700;
        color: #00695C;
    }
    .btn-resend {
        background: none;
        border: 1.5px solid transparent;
        color: #00695C;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        padding: 6px 18px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    .btn-resend:hover:not([disabled]) {
        background: rgba(99,102,241,0.07);
        border-color: rgba(99,102,241,0.2);
    }
    .btn-resend[disabled] {
        color: #d1d5db;
        cursor: not-allowed;
    }

    /* ── Divider ─────────────────────────────────────── */
    .verify-divider {
        border: none;
        border-top: 1px solid #f3f4f6;
        margin: 1.2rem 0;
    }

    /* ── Back link ─────────────────────────────────── */
    .back-link {
        text-align: center;
        font-size: 0.84rem;
        color: #6b7280;
        margin: 0;
    }
    .back-link a {
        color: #00695C;
        font-weight: 600;
        text-decoration: none;
    }
    .back-link a:hover { text-decoration: underline; }

    /* Shake animation */
    @keyframes otp-shake {
        0%,100%{transform:translateX(0)}
        20%{transform:translateX(-8px)}
        40%{transform:translateX(8px)}
        60%{transform:translateX(-5px)}
        80%{transform:translateX(4px)}
    }
    .otp-shake { animation: otp-shake 0.4s ease; }

    @media (max-width: 480px) {
        .otp-digit { width: 52px; height: 58px; font-size: 1.5rem; border-radius: 12px; }
        .otp-inputs { gap: 10px; }
        .verify-card-body { padding: 1.2rem 1.25rem 1.75rem; }
    }
</style>
@endpush

@section('content')
<section class="verify-section">
    <div class="verify-card">

        {{-- ── Gradient Header ── --}}
        <div class="verify-card-header">
            <div class="shield-icon-wrap">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                </svg>
            </div>
            <h2>{{ \App\CPU\translate('Verify Your Account') }}</h2>

            @php($email_verify = \App\CPU\Helpers::get_business_settings('email_verification'))
            @php($phone_verify = \App\CPU\Helpers::get_business_settings('phone_verification'))

            @if($email_verify)
                <p>{{ \App\CPU\translate('We sent a 4-digit verification code to your email.') }}</p>
                @if(isset($user) && $user->email)
                    <span class="hint-badge">
                        {{ substr($user->email, 0, 3) }}***{{ strstr($user->email, '@') }}
                    </span>
                @endif
            @elseif($phone_verify)
                <p>{{ \App\CPU\translate('We sent a 4-digit OTP to your phone number.') }}</p>
                @if(isset($user) && $user->phone)
                    <span class="hint-badge">
                        ***{{ substr($user->phone, -3) }}
                    </span>
                @endif
            @else
                <p>{{ \App\CPU\translate('Enter the 4-digit verification code to continue.') }}</p>
            @endif
        </div>

        {{-- ── Card Body ── --}}
        <div class="verify-card-body">

            {{-- Session / Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger" style="border-radius:12px; font-size:0.875rem; margin-bottom:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- OTP Form --}}
            <form action="{{ route('customer.auth.verify') }}" method="post" id="verify-form">
                @csrf
                <input type="hidden" name="type"  value="{{ $loginuser }}">
                <input type="hidden" name="id"    value="{{ $user->id }}">
                <input type="hidden" name="token" id="token-combined">

                <p class="otp-label">{{ \App\CPU\translate('Enter 4-digit code') }}</p>

                {{-- 4 individual digit boxes --}}
                <div class="otp-inputs" id="otp-inputs">
                    <input type="number" class="otp-digit" id="otp-0" min="0" max="9" maxlength="1" autocomplete="one-time-code" autofocus>
                    <input type="number" class="otp-digit" id="otp-1" min="0" max="9" maxlength="1">
                    <input type="number" class="otp-digit" id="otp-2" min="0" max="9" maxlength="1">
                    <input type="number" class="otp-digit" id="otp-3" min="0" max="9" maxlength="1">
                </div>

                <button type="submit" class="btn-verify-otp" id="verify-btn">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <polyline points="9 12 11 14 15 10"/>
                    </svg>
                    {{ \App\CPU\translate('Verify & Continue') }}
                </button>
            </form>

            {{-- Resend form (hidden, submitted by JS) --}}
            <form id="resend-form" action="{{ route('customer.auth.check', [$user->id, $loginuser]) }}" method="get" style="display:none;"></form>

            {{-- Timer + Resend --}}
            <div class="resend-area">
                <div class="timer-text" id="timer-box">
                    {{ \App\CPU\translate('Resend code in') }}&nbsp;<span class="timer-val" id="timer-count">01:00</span>
                </div>
                <button type="button" class="btn-resend" id="resend-btn" disabled onclick="resendCode()">
                    ↺ {{ \App\CPU\translate('Resend Code') }}
                </button>
            </div>

            <hr class="verify-divider">

            <p class="back-link">
                {{ \App\CPU\translate('Wrong account?') }}
                <a href="{{ route('customer.auth.login') }}">{{ \App\CPU\translate('Back to Login') }}</a>
            </p>
        </div>

    </div>
</section>
@endsection


@push('script')
<script>
(function () {
    'use strict';

    const digits   = document.querySelectorAll('.otp-digit');
    const form     = document.getElementById('verify-form');
    const combined = document.getElementById('token-combined');

    /* ── Digit interaction ── */
    digits.forEach((input, idx) => {

        input.addEventListener('input', e => {
            const v = e.target.value.replace(/\D/g, '');
            e.target.value = v ? v.charAt(0) : '';
            if (v && idx < digits.length - 1) digits[idx + 1].focus();
            syncFill();
        });

        input.addEventListener('keydown', e => {
            if (e.key === 'Backspace') {
                if (e.target.value === '' && idx > 0) {
                    digits[idx - 1].focus();
                    digits[idx - 1].value = '';
                } else {
                    e.target.value = '';
                }
                syncFill();
                e.preventDefault();
            }
            if (e.key === 'ArrowLeft'  && idx > 0)              digits[idx - 1].focus();
            if (e.key === 'ArrowRight' && idx < digits.length - 1) digits[idx + 1].focus();
        });

        /* Paste full code */
        input.addEventListener('paste', e => {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
            digits.forEach((d, i) => { d.value = text[i] || ''; });
            digits[Math.min(digits.length - 1, text.length - 1)].focus();
            syncFill();
        });
    });

    function syncFill() {
        digits.forEach(d => d.classList.toggle('otp-filled', d.value !== ''));
    }

    /* ── Pre-submit assembly ── */
    form.addEventListener('submit', e => {
        const code = [...digits].map(d => d.value).join('');
        if (code.length < 4) {
            e.preventDefault();
            const wrap = document.getElementById('otp-inputs');
            wrap.classList.remove('otp-shake');
            void wrap.offsetWidth; // reflow
            wrap.classList.add('otp-shake');
            digits[0].focus();
            return;
        }
        combined.value = code;
    });

    /* ── Countdown ── */
    const timerCount = document.getElementById('timer-count');
    const timerBox   = document.getElementById('timer-box');
    const resendBtn  = document.getElementById('resend-btn');
    let interval;

    function startTimer(seconds) {
        clearInterval(interval);
        timerBox.style.display  = 'block';
        resendBtn.disabled      = true;

        interval = setInterval(() => {
            const m = String(Math.floor(seconds / 60)).padStart(2, '0');
            const s = String(seconds % 60).padStart(2, '0');
            timerCount.textContent = `${m}:${s}`;
            if (seconds-- <= 0) {
                clearInterval(interval);
                timerBox.style.display = 'none';
                resendBtn.disabled     = false;
            }
        }, 1000);
    }

    startTimer(60);

    /* ── Resend – re-trigger check() which re-sends OTP ── */
    window.resendCode = function () {
        document.getElementById('resend-form').submit();
    };

})();
</script>
@endpush
