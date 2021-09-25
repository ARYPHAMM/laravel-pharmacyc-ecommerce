<div class="layout__header">
    <div class="layout__header--left">
        <a href="{{ url('./') }}" class="btn btn__redirect ">
            <i class="fas fa-globe-africa mr-1"></i> Xem website
        </a>
    </div>
    <div class="layout__header--right">
        <div class="account__setting">
            <div class="account__dropdown">
                <button class="btn" onclick="$(this).next('ul').toggleClass('active');">
                    @php
                    @endphp
                    <img src="{{ file_exists($_SERVER['DOCUMENT_ROOT'].'/'.$account_current['thumbnail']) && !empty($account_current['thumbnail']) ? asset($account_current['thumbnail']) : './assets/img/no-image.png' }}"
                        alt="">
                    <span>
                        {{ $account_current['username'] }}
                    </span>
                </button>
                <ul class="position-absolute">
                    <li>
                        <a href="{{ route('user-edit') . '?id=' . $account_current['id'] }}">Thông tin tài khoản</a>
                    </li>
                    <li><a href="{{ route('user-logout') }}">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
