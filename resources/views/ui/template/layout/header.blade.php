<div class="header">
    <div class="header__top bg--default">
        <div class="container container__content">
            <div class="row align-items-center">
                <div class="header__topLeft">
                    <ul class="header__networkSocical d-flex align-items-center">
                        <li><a href="<?php echo @$layout['header']['facebook']['link'] ?>"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="<?php echo @$layout['header']['instagram']['link'] ?>"> <i class="fab fa-instagram    "></i></a></li>
                        <li><a href="<?php echo @$layout['header']['gmail']['link'] ?>"><i class="fab fa-google    "></i></a></li>
                    </ul>
                </div>
                <div class="header__topRight d-flex align-items-center position-relative">
                    <a class="text-white header__email" href="<?php echo @$layout['header']['email']['link'] ?>">Email: <?php echo @$layout['header']['email']['value'] ?> </a>
                    <a class="text-white header__hotline" href="<?php echo @$layout['header']['hotline']['link'] ?>">Hotline: <?php echo @$layout['header']['hotline']['value'] ?></a>
                    <button class="btn btn__toggleSearch d-flex d-lg-none" onclick="callFormSearch(this)">
                        <i class="fas fa-search    "></i>
                    </button>
                    <form class="form__search" method="post" action="">
                        <div class="form-group d-flex position-relative header__topSearch">
                            <input type="text" class="form-control rounded-0 " name="title" id="" aria-describedby="helpId" placeholder="Nhập từ khóa cần tìm....">
                            <button class="btn shadow-none"><i class="fas fa-search    "></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="header__center">
        <div class="container container__content">
            <div class="row position-relative align-items-center">
                <a href="./" class="header__logo">
                    <img class="lazy_load" data-src=" {{$layout['header']['photo-1']['thumbnail']}}" alt="">
                </a>
                <button onclick="openCloseMenuMobile()" class="btn d-flex btn--toggle shadow-none rounded-0 d-lg-none ml-auto align-items-center">
                    <i class="fas fa-bars pr-1"></i> Menu
                </button>
                <ul class="header__menu w-100">
                    <li><a href="./"><i class="fas fa-home color--default"></i></a></li>
                    <?php if (isset($layout['header']['menu-center'])) { ?>
                        <?php foreach ($layout['header']['menu-center'] as $r_menu) { ?>
                            <li class="<?= (is_array(@$r_menu['child']) && !empty(@$r_menu['child'])) ? 'addChervon' : '' ?>">
                                <a href="{{config('app.APP_URL').@$r_menu['url'].'.html'}}"><?= $r_menu['title'] ?></a>
                                <?php if (is_array($r_menu['child']) && !empty($r_menu['child'])) { ?>
                                    <button onclick="openCloseMenuSub(this)" class="btn btn--toggleMenuSub d-block
d-lg-none">
                                        <i class="fas fa-chevron-down    "></i>
                                    </button>
                                    <ul class="header__menuSub">
                                        <?php foreach ($r_menu['child'] as $r_menuSub) { ?>
                                            <li class="header__menuSubItem">
                                                <a href="{{config('app.APP_URL').@$r_menuSub['url'].'.html'}}">
                                                    <img class="lazy_load" data-src="<?php echo $r_menuSub['thumbnail'] ?>" alt="">
                                                    <span>
                                                        <?= $r_menuSub['title'] ?>
                                                    </span>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php  } ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <li class=" close__menuMobile">
                        <button onclick="openCloseMenuMobile()" class="btn">
                            &times;
                        </button>
                    </li>
                </ul>
                <a href="{{config('app.APP_URL').route('view-cart').'.html'}}" class="header__cart <?php echo session()->has('cart')  ? 'active' : ''; ?>">
                    <i class="fas fa-cart-arrow-down    color--default  "></i><span> Giỏ Hàng <?php echo session()->has('cart') == true  ? '(' . count(session()->get('cart')) . ')' : ''; ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function openCloseMenuMobile() {
        $('.header__menu').toggleClass('active');
        $('.header__menuSub').removeClass('active');
    }

    function openCloseMenuSub(element) {
        var el = $(element);
        el.next('ul').toggleClass('active');
    }

    function callFormSearch(element) {
        var el = $(element);
        el.next('form').toggleClass('active');
        if (el.next('form').hasClass('active')) {
            el.find('i').removeClass('fa-search').addClass('fa-times');
        } else {
            el.find('i').addClass('fa-search').removeClass('fa-times');
        }
    }
</script>