<div class="index mt-3">
    <div class="index__productCategory">
        <div class="container container__content">
            <div class="row  d-flex flex-column">
                <div class="col-12">
                    <ul class="nav nav-tabs  index__navTabs " id="myTab" role="tablist">
                        <li>
                            Danh mục sản phẩm
                        </li>
                        <?php foreach ($layout['index']['product-category'] as $index => $r_category) {
                        ?>
                        <?php $row_product[$index] = DB::table('tbl_product')
                        ->join('tbl_tr_product', 'tbl_tr_product.product_id', '=', 'tbl_product.id')
                        ->where('tbl_tr_product.lang_id', '=', $default_lang_id)
                        ->where('tbl_product.enable', '>', '0')
                        ->where('tbl_product.popular1', '>', '0')
                        ->where('tbl_product.popular2', '>', '0')
                        ->whereRaw('FIND_IN_SET(' . $r_category['category_id'] . ',category_id)')
                        ->get(['tbl_tr_product.*', 'tbl_product.url', 'tbl_product.thumbnail']); ?>
                        <?php if (count($row_product[$index]) > 0 && !empty($row_product[$index])) { ?>
                        <li class="nav-item">
                            <a class="nav-link  <?= $index == 0 ? 'active' : '' ?>" id="category-<?= $index + 1 ?>-tab"
                                data-toggle="tab" href="#category-<?= $index + 1 ?>" role="tab"
                                aria-controls="category-<?= $index + 1 ?>"
                                aria-selected="true"><?php echo $r_category['title']; ?></a>
                            <?php } ?>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content index__tabContent w-100  mt-3 mb-3" id="myTabContent">
                        <?php foreach ($layout['index']['product-category'] as $index => $r_category) { ?>

                        <?php if (count($row_product[$index]) > 0 && !empty($row_product[$index])) { ?>
                        <div class="tab-pane fade <?= $index == 0 ? 'show active' : '' ?>"
                            id="category-<?= $index + 1 ?>" role="tabpanel"
                            aria-labelledby="category-<?= $index + 1 ?>-tab">
                            <span class="title__popularCategoryIndex">
                                <?php echo $r_category['title']; ?>
                            </span>
                            <div class='swiper-container swiper-container-slide--row_product-<?= $index + 1 ?> w-100'>
                                <div class='swiper-wrapper'>
                                    <?php foreach ($row_product[$index] as $r_product) { ?>

                                    <div class='swiper-slide'>

                                        @include(config('app.template').'.layout.product-item-swiper')
                                    </div>


                                    <?php } ?>
                                </div>
                                <div class='swiper-button-prev swiper-button-prev-slide--row_product-<?= $index + 1 ?>'>
                                    <i class="fas fa-chevron-left    "></i></div>
                                <div class='swiper-button-next swiper-button-next-slide--row_product-<?= $index + 1 ?>'>
                                    <i class="fas fa-chevron-right    "></i></div>
                                <script>
                                    $(window).on('load', function() {
                                                num_Row = parseInt("<?php echo count($row_product[$index]); ?>");
                                                count_load = -1;
                                                if (window.matchMedia("(min-width: 992px)").matches && num_Row <= 10) {
                                                    $('.swiper-button-prev-slide--row_product-<?= $index + 1 ?>,.swiper-button-next-slide--row_product-<?= $index + 1 ?>').remove();
                                                    count_load = 10;
                                                }
                                                if (window.matchMedia("(min-width: 768px) and (max-width: 991px)").matches && num_Row <= 8) {
                                                    $('.swiper-button-prev-slide--row_product-<?= $index + 1 ?>,.swiper-button-next-slide--row_product-<?= $index + 1 ?>').remove();
                                                    count_load = 8;
                                                }
                                                if (window.matchMedia("(min-width: 640px and (max-width: 767px)").matches && num_Row <= 2) {
                                                    $('.swiper-button-prev-slide--row_product-<?= $index + 1 ?>,.swiper-button-next-slide--row_product-<?= $index + 1 ?>').remove();
                                                    count_load = 4;
                                                }
                                                if (window.matchMedia("(min-width: 320px) and (max-width: 639px)").matches && num_Row <= 2) {
                                                    $('.swiper-button-prev-slide--row_product-<?= $index + 1 ?>,.swiper-button-next-slide--row_product-<?= $index + 1 ?>').remove();
                                                    count_load = 2;
                                                }
                                                var swiper_product = new Swiper('.swiper-container-slide--row_product-<?= $index + 1 ?>', {
                                                    autoplay: {
                                                        delay: 5000,
                                                    },
                                                    lazy: true,

                                                    loadPrevNext: true,
                                                    loadPrevNextAmount: 10,
                                                    loadOnTransitionStart: true,
                                                    allowTouchMove: true,
                                                    pagination: {
                                                        el: '.swiper-pagination-slide--row_product-<?= $index + 1 ?>',
                                                        clickable: true
                                                    },
                                                    speed: 2000,
                                                    navigation: {
                                                        nextEl: '.swiper-button-next-slide--row_product-<?= $index + 1 ?>',
                                                        prevEl: '.swiper-button-prev-slide--row_product-<?= $index + 1 ?>',
                                                    },

                                                    breakpoints: {
                                                        320: {
                                                            slidesPerView: 2,
                                                            spaceBetween: 5,
                                                            slidesPerColumn: 1,

                                                        },
                                                        640: {
                                                            slidesPerView: 2,
                                                            spaceBetween: 5,
                                                            slidesPerColumnFill: 'row',
                                                            slidesPerColumn: 1,
                                                        },
                                                        768: {
                                                            slidesPerView: 4,
                                                            spaceBetween: 5,
                                                            slidesPerColumnFill: 'row',
                                                            slidesPerColumn: 2,
                                                        },
                                                        1024: {
                                                            slidesPerView: 5,
                                                            spaceBetween: 10,
                                                            slidesPerColumnFill: 'row',
                                                            slidesPerColumn: 2,
                                                        },
                                                    },
                                                    on: {
                                                        init: function() {

                                                            for (let index = 0; index <= count_load+1; index++) {
                                                                this.lazy.loadInSlide(index);

                                                            }
                                                        },
                                                        touchEnd: function(e) {
                                                            var realIndex = $('.swiper-container-slide--row_product-<?= $index + 1 ?> .swiper-slide:not(.swiper-slide-duplicate)').length;

                                                            for (let index = 0; index <= realIndex; index++) {
                                                                this.lazy.loadInSlide(index);

                                                            }
                                                        },
                                                    }
                                                });
                                            });
                                </script>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>