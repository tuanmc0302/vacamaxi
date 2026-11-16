@if(!empty($requiresAgeVerification))
<div id="ageVerificationModal" class="age-modal-overlay" style="display: none;" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="ageModalTitle">
    <div class="age-modal-card">
        <div class="age-modal-badge">
            <span class="age-modal-badge-number">18+</span>
        </div>

        <p class="age-modal-eyebrow">{{ __('XÁC MINH ĐỘ TUỔI / AGE VERIFICATION') }}</p>
        <h2 id="ageModalTitle" class="age-modal-title">{{ __('BẠN ĐÃ ĐỦ 18 TUỔI?') }}</h2>
        
        <div class="age-modal-divider"></div>

        <p class="age-modal-desc">
            {{ __('Trang web này chứa thông tin và sản phẩm đồ uống có cồn dành riêng cho người từ đủ') }} 
            <strong>{{ __('18 tuổi trở lên') }}</strong> {{ __('theo quy định của pháp luật Việt Nam.') }}<br>
            {{ __('Vui lòng xác nhận độ tuổi của bạn trước khi tiếp tục truy cập.') }}
        </p>

        <label class="age-modal-remember">
            <input type="checkbox" id="ageRememberCheckbox" checked class="age-modal-checkbox">
            <span class="age-modal-remember-text">{{ __('Ghi nhớ độ tuổi của tôi (trong 24 giờ)') }}</span>
        </label>

        <div class="age-modal-buttons">
            <button type="button" class="btn-age-confirm" onclick="handleAgeConfirm()">
                <i class="bi bi-shield-check me-2"></i>{{ __('TÔI ĐÃ ĐỦ 18 TUỔI') }}
            </button>
            <button type="button" class="btn-age-reject" onclick="handleAgeReject()">
                {{ __('TÔI DƯỚI 18 TUỔI') }}
            </button>
        </div>

        <p class="age-modal-disclaimer">
            {{ __('Uống rượu, bia có thể gây tai nạn giao thông. Uống rượu, bia có thể ảnh hưởng đến sức khỏe thai nhi. Người dưới 18 tuổi không được uống rượu, bia.') }}
        </p>
    </div>
</div>

<style>
.age-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 99999999;
    background: rgba(10, 8, 7, 0.94);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    animation: ageModalFadeIn 0.3s ease;
}

@keyframes ageModalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.age-modal-card {
    background: linear-gradient(145deg, #1f1a16 0%, #13100e 100%);
    border: 1.5px solid rgba(243, 178, 26, 0.35);
    border-radius: 24px;
    padding: 40px 32px 30px;
    max-width: 520px;
    width: 100%;
    text-align: center;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.7), 0 0 40px rgba(243, 178, 26, 0.12);
    position: relative;
    transform: translateY(0);
    animation: ageModalSlideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes ageModalSlideUp {
    from { transform: translateY(25px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.age-modal-badge {
    width: 72px;
    height: 72px;
    margin: -76px auto 18px;
    background: linear-gradient(135deg, #b91c1c, #dc2626);
    border: 3px solid #f3b21a;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 25px rgba(220, 38, 38, 0.45), 0 0 15px rgba(243, 178, 26, 0.3);
}

.age-modal-badge-number {
    font-size: 24px;
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.5px;
    font-family: 'Montserrat', sans-serif;
}

.age-modal-eyebrow {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    color: #f3b21a;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.age-modal-title {
    font-size: 24px;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 16px;
    font-family: 'Montserrat', sans-serif;
    letter-spacing: 0.5px;
}

.age-modal-divider {
    width: 60px;
    height: 2px;
    background: #f3b21a;
    margin: 0 auto 20px;
    border-radius: 2px;
}

.age-modal-desc {
    font-size: 14.5px;
    line-height: 1.7;
    color: #d1c7bd;
    margin-bottom: 24px;
}

.age-modal-desc strong {
    color: #f3b21a;
}

.age-modal-remember {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 10px 18px;
    border-radius: 50px;
    margin-bottom: 26px;
    transition: all 0.2s ease;
    user-select: none;
}

.age-modal-remember:hover {
    background: rgba(243, 178, 26, 0.1);
    border-color: rgba(243, 178, 26, 0.3);
}

.age-modal-checkbox {
    width: 17px;
    height: 17px;
    accent-color: #f3b21a;
    cursor: pointer;
}

.age-modal-remember-text {
    font-size: 13.5px;
    color: #e5dec9;
    font-weight: 500;
}

.age-modal-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
}

.btn-age-confirm {
    background: linear-gradient(135deg, #f3b21a 0%, #e09f08 100%);
    color: #250900;
    border: none;
    padding: 14px 28px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(243, 178, 26, 0.35);
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.btn-age-confirm:hover {
    background: linear-gradient(135deg, #ffc438 0%, #f3b21a 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(243, 178, 26, 0.5);
    color: #250900;
}

.btn-age-reject {
    background: transparent;
    color: #a89f91;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 12px 28px;
    border-radius: 50px;
    font-size: 13.5px;
    font-weight: 600;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-age-reject:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
    border-color: rgba(255, 255, 255, 0.3);
}

.age-modal-disclaimer {
    font-size: 11px;
    line-height: 1.5;
    color: #7a7065;
    margin: 0;
    font-style: italic;
    border-top: 1px solid rgba(255, 255, 255, 0.06);
    padding-top: 16px;
}

@media (max-width: 575.98px) {
    .age-modal-card {
        padding: 34px 20px 24px;
        border-radius: 20px;
    }
    .age-modal-badge {
        width: 62px;
        height: 62px;
        margin-top: -65px;
    }
    .age-modal-badge-number {
        font-size: 20px;
    }
    .age-modal-title {
        font-size: 20px;
    }
    .age-modal-desc {
        font-size: 13.5px;
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
            const maxAge = hours * 3600; // in seconds
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
        
        // Nếu tick ghi nhớ độ tuổi thì lưu cookie 24 giờ (24h), ngược lại lưu cookie phiên (session)
        if (shouldRemember) {
            setCookie(COOKIE_NAME, '1', 24);
        } else {
            setCookie(COOKIE_NAME, '1', null);
        }

        const modal = document.getElementById(MODAL_ID);
        if (modal) {
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.25s ease';
            setTimeout(function() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }, 250);
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
