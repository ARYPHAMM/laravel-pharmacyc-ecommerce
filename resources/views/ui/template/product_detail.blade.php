@extends('ui.index')
@section('content')
@include('ui.template.layout.breadcrumb')
<div class="productDetail ">
    <div class="productDetail_info">
        <div class="container container__content">
            <div class="row mt-3 productDetail_Wrapper">
                <div class="productDetail_infoLeft">
                    <div data-lazy="true" class="swiper-container gallery-top product__slideTop w-100">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" class="d-flex">
                                    <img class="w-100 h-auto " src="<?= $product->thumbnail ?>" alt="<?= $product->title ?>">
                                </a>
                            </div>
                            <?php foreach ($product['images'] as $r_slide) { ?>
                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="d-flex">
                                        <img class="w-100 h-auto " src="<?= $r_slide->thumbnail ?>" alt="<?= $product->title ?>">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="swiper-container gallery-thumbs product__slideNavigation mt-2 mb-2 w-100 ml-1 mr-1">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="javascript:void(0)" class="display-flex">
                                    <img src="<?= $product->thumbnail ?>" alt="<?= $product->title ?>">
                                </a>
                            </div>
                            <?php foreach ($product['images'] as $r_slide) { ?>
                                <div class="swiper-slide">
                                    <a href="javascript:void(0)" class="display-flex">
                                        <img src="<?= $r_slide->thumbnail ?>" alt="<?= $product->title ?>">
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="productDetail_infoRight">
                    <div class="productDetail_title">
                        @php
                        echo $product->title;
                        @endphp
                    </div>
                    <div class="productDetail_Desc">
                        @php
                        echo $product->description;
                        @endphp
                    </div>
                    <div class="productItem__price mt-1">
                        <div class="d-flex flex-row align-items-center">
                            <span class="productItem__priceTitle">
                                Giá:
                            </span>
                            <span class="productItem__priceSale">
                            </span>
                        </div>
                        <del class="productItem__priceOrigin">
                        </del>
                    </div>
                    <div class="product__addToCart d-flex flex-row align-items-center">
                        <div class="d-flex align-items-center flex-wrap">
                            <button onclick="setQuantity( parseInt($('.input__quantity').val())  -1)" class="btn bg--default1 shadow-none border-0 rounded-circle">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                            <input class="input__quantity " type="text" value="1" min=0 max=11 />
                            <button onclick="setQuantity(parseInt($('.input__quantity').val())+1)" class="btn bg--default1 shadow-none border-0 rounded-circle">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </div>
                        <div class="d-flex align-items-center flex-wrap">
                            <button onclick="cartAjax({ action: 'addtocart',quantity: $('.input__quantity').val(), id: '<?= $product->id ?>',type:'Mua trực tiếp', lbl: 'label-success', callback: function(){ setTimeout(function() {  }, 1000); } });" class="btn btn__addToCart m-1">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setQuantity(val) {
            var value = val;
            if (val <= 0) {
                $('.input__quantity').val(1);
                return;
            }
            if (val > parseInt($('.input__quantity').attr('max'))) {
                $('.input__quantity').val(value - 2);
                alert("Tồn kho " + ($('.input__quantity').attr('max') - 1) + " Sản phẩm");
            } else
                $('.input__quantity').val(value);
        }
    </script>
    <div class="productDetail_infoExpand">
        <div class="container container__content">
            <div class="row shawdow--default">
                <div class="productDetail__titlePopular">
                    Mô tả
                </div>
                <div class="col-12">
                    <div>
                        <?= $product->content ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="productDetail_infoExpand mt-3  mb-3">
        <div class="container container__content">
            <div class="row shawdow--default">
                <div class="productDetail__titlePopular">
                    Sản Phẩm Liên Quan
                </div>
                <div class="w-100 mb-3">
                    <div class='swiper-container swiper-container-slide-related w-100'>
                        <div class='swiper-wrapper w-100'>
                            <?php foreach ($productRelated as $r_product) { ?>
                                <div class='swiper-slide'>
                                    @include(config('app.template').'.layout.product-item-swiper')
                                </div>
                            <?php } ?>
                        </div>
                        <div class='swiper-button-next swiper-button-next-slide-related'>
                            <i class="fas fa-chevron-right    "></i>
                        </div>
                        <div class='swiper-button-prev swiper-button-prev-slide-related'>
                            <i class="fas fa-chevron-left    "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(window).on('load', function() {
        num_Row = parseInt("<?php echo count($productRelated); ?>");
        count_load = -1;
        if (window.matchMedia("(min-width: 992px)").matches && num_Row <= 4) {
            count_load = 4;
        }
        if (window.matchMedia("(min-width: 768px) and (max-width: 991px)").matches && num_Row <= 3) {
            count_load = 3;
        }
        if (window.matchMedia("(min-width: 640px and (max-width: 767px)").matches && num_Row <= 2) {
            count_load = 2;
        }
        if (window.matchMedia("(min-width: 320px) and (max-width: 639px)").matches && num_Row <= 1) {
            count_load = 1;
        }
        var swiper = new Swiper('.swiper-container-slide-related', {
            slidesPerView: 2,
            // slidesPerColumn: 2,
            lazy: true,
            loadPrevNext: true,
            loadPrevNextAmount: 10,
            loadOnTransitionStart: true,
            allowTouchMove: true,
            navigation: {
                nextEl: '.swiper-button-next-slide-related',
                prevEl: '.swiper-button-prev-slide-related',
            },
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination-related',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
            },
            speed: 2000,
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    // slidesPerColumn: 1,
                    spaceBetween: 0,
                },
                640: {
                    slidesPerView: 2,
                    // slidesPerColumn: 1,
                    spaceBetween: 3,
                },
                768: {
                    slidesPerView: 3,
                    // slidesPerColumn: 1,
                    spaceBetween: 5,
                },
                1024: {
                    slidesPerView: 4,
                    // slidesPerColumn: 2,
                },
            },
            on: {
                touchEnd: function(e) {
                    var realIndex = $('.swiper-container-slide-related .swiper-slide:not(.swiper-slide-duplicate)').length;
                    for (let index = 0; index <= realIndex; index++) {
                        this.lazy.loadInSlide(index);
                    }
                },
                init: function() {
                    for (let index = 0; index < count_load - 1; index++) {
                        this.lazy.loadInSlide(index);
                    }
                },
            },
        });
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 10,
            autoHeight: true, //enable auto height
            lazy: true,
            loadPrevNext: true,
            loadPrevNextAmount: 1,
            loadOnTransitionStart: true,
            allowTouchMove: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs
            },
            on: {
                // touchEnd: function(e) {
                //     var realIndex = $('.gallery-top .swiper-slide:not(.swiper-slide-duplicate)').length;
                //     for (let index = 0; index <= realIndex; index++) {
                //         this.lazy.loadInSlide(index);
                //     }
                // },
                // init: function() {
                //     this.update();
                // }
            },
        });
    });
</script>
@endsection