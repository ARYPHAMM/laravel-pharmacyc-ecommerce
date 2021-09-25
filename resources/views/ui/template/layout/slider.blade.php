<?php if (count($slider) >0  && !empty($slider) ) { ?>
    <div class="slide">
        <div class="container container__content">
            <div class="row">
                <div class="col-12">
                    <div class="swiper-container swiper-container-slider-index mb-3">
                        <div class="swiper-wrapper">
                            <?php foreach ($slider->toArray()  as $r_slider) { ?>
                                <?php if (file_exists($r_slider['thumbnail']) && !empty($r_slider['thumbnail'])) { ?>
                                    <div class="swiper-slide">
                                        <a href="<?= @$r_slider['link'] ?>" class="display-flex">
                                            <img class="swiper-lazy" src="<?php echo $r_slider['thumbnail']  ?>" alt="<?= $information['title'] ?>">
                                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>

                                        </a>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="swiper-pagination-slider-index d-none"></div>
                        <!-- <div class='swiper-button-next swiper-button-next-slider-index'>
            <i class="fas fa-chevron-right    "></i></div>
        <div class='swiper-button-prev swiper-button-prev-slider-index'>
            <i class="fas fa-chevron-left    "></i></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(window).on('load', function() {

            num_Row = parseInt("<?php echo count($slider)  ?>");

            var swiper_slide = new Swiper('.swiper-container-slider-index', {
                autoplay: {
                    delay: 3000,
                },
                lazy: true,

                loadPrevNext: true,
                loadPrevNextAmount: 10,
                loadOnTransitionStart: true,
                allowTouchMove: true,
                speed: 2000,
                pagination: {
                    el: '.swiper-pagination-slider-index',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next-slider-index',
                    prevEl: '.swiper-button-prev-slider-index',
                },
                slidesPerView: 1,
                on: {
                    // init: function() {

                    // 	for (let index = 0; index <= count_load - 1; index++) {
                    // 		this.lazy.loadInSlide(index);

                    // 	}
                    // },
                    // touchEnd: function(e) {
                    // 	var realIndex = $('.swiper-container-slide-index .swiper-slide:not(.swiper-slide-duplicate)').length;
                    // 	for (let index = 0; index <= realIndex; index++) {
                    // 		this.lazy.loadInSlide(index);

                    // 	}
                    // },
                }
            });
        });
    </script>

<?php } ?>