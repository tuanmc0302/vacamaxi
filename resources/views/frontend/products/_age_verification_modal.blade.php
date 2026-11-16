@if(!empty($requiresAgeVerification))
@php
    $productItem = $targetProduct ?? null;
    $categoryItem = $targetCategory ?? ($category ?? null);
@endphp
<div id="ageVerificationModal" class="age-modal-overlay" style="display: none;" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="ageModalTitle">
    <div class="age-modal-card">
        <h2 id="ageModalTitle" class="age-modal-title">{{ __('Xác nhận độ tuổi') }}</h2>

        <p class="age-modal-desc">
            @php
                $itemName = $productItem?->name ?? $categoryItem?->name ?? null;
            @endphp
            @if(!empty($itemName))
                {{ __('Website chỉ giới thiệu sản phẩm') }} <span class="age-product-name">"{{ $itemName }}"</span> {{ __('đến đối tượng trên 18 tuổi.') }}
            @else
                {{ __('Website chỉ giới thiệu sản phẩm đến đối tượng trên 18 tuổi.') }}
            @endif
        </p>

        <div class="age-modal-buttons">
            <button type="button" class="btn-age-confirm" onclick="handleAgeConfirm()">
                {{ __('Tôi đã đủ 18 tuổi') }}
            </button>
            <button type="button" class="btn-age-reject" onclick="handleAgeReject()">
                {{ __('Tôi dưới 18 tuổi') }}
            </button>
        </div>

        <label class="age-modal-remember">
            <input type="checkbox" id="ageRememberCheckbox" checked class="age-modal-checkbox">
            <span class="age-modal-remember-text">{{ __('Ghi nhớ độ tuổi của tôi') }}</span>
        </label>
    </div>
</div>

<style>
.age-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999999;
    background: rgba(15, 12, 10, 0.88);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: ageModalFadeIn 0.25s ease;
}

@keyframes ageModalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.age-modal-card {
    background: #1b1613;
    border: 1px solid rgba(243, 178, 26, 0.3);
    border-radius: 16px;
    padding: 32px 28px 24px;
    max-width: 460px;
    width: 100%;
    text-align: center;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.6);
    position: relative;
    animation: ageModalSlideUp 0.3s ease-out;
}

@keyframes ageModalSlideUp {
    from { transform: translateY(15px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.age-modal-title {
    font-size: 22px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 14px;
    letter-spacing: 0.3px;
}

.age-modal-desc {
    font-size: 14.5px;
    line-height: 1.6;
    color: #cfc7bd;
    margin-bottom: 24px;
}

.age-product-name {
    color: #f3b21a;
    font-weight: 700;
}

.age-modal-buttons {
    display: flex;
    gap: 12px;
    margin-bottom: 18px;
}

.btn-age-confirm {
    flex: 1;
    background: #f3b21a;
    color: #250900;
    border: none;
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14.5px;
    font-weight: 700;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.1s ease;
}

.btn-age-confirm:hover {
    background: #ffc233;
}

.btn-age-reject {
    flex: 1;
    background: transparent;
    color: #b5aba0;
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 14.5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-age-reject:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    border-color: rgba(255, 255, 255, 0.35);
}

.age-modal-remember {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    user-select: none;
}

.age-modal-checkbox {
    width: 16px;
    height: 16px;
    accent-color: #f3b21a;
    cursor: pointer;
    margin: 0;
}

.age-modal-remember-text {
    font-size: 13px;
    color: #a89f92;
}

.age-modal-remember:hover .age-modal-remember-text {
    color: #e2dbce;
}

@media (max-width: 480px) {
    .age-modal-card {
        padding: 26px 18px 20px;
    }
    .age-modal-buttons {
        flex-direction: column;
    }
}
</style>

<script>
(function() {
    const COOKIE_NAME = 'vacamaxi_age_verified';
    const MODAL_ID = 'ageVerificationModal';
    const CHECKBOX_ID = 'ageRememberCheckbox';
    const HOME_URL = '{{ route("frontend.home") }}';

    function getCookie(name) {
        const matches = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)'));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function setCookie(name, value, hours) {
        let cookieString = name + '=' + encodeURIComponent(value) + '; path=/; SameSite=Lax';
        if (hours) {
            const maxAge = hours * 3600; // 24 giờ
            cookieString += '; max-age=' + maxAge;
        }
        document.cookie = cookieString;
    }

    function checkAgeVerification() {
        const modal = document.getElementById(MODAL_ID);
        if (!modal) return;

        const isVerified = getCookie(COOKIE_NAME) === '1';
        if (!isVerified) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        } else {
            modal.style.display = 'none';
        }
    }

    window.handleAgeConfirm = function() {
        const rememberCheckbox = document.getElementById(CHECKBOX_ID);
        const shouldRemember = rememberCheckbox ? rememberCheckbox.checked : true;
        
        // Nếu tick ghi nhớ độ tuổi thì lưu cookie 24 giờ, ngược lại lưu session cookie
        if (shouldRemember) {
            setCookie(COOKIE_NAME, '1', 24);
        } else {
            setCookie(COOKIE_NAME, '1', null);
        }

        const modal = document.getElementById(MODAL_ID);
        if (modal) {
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.2s ease';
            setTimeout(function() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }, 200);
        }
    };

    window.handleAgeReject = function() {
        if (window.history.length > 1 && document.referrer && document.referrer.indexOf(window.location.host) !== -1) {
            window.history.back();
        } else {
            window.location.href = HOME_URL;
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkAgeVerification);
    } else {
        checkAgeVerification();
    }
})();
</script>
@endif
