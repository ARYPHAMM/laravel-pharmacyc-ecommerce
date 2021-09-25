<div class="index">
    <div class="index__product">
        <div class="container container__content">
            <div class="row flex-column">
                <div class="col-12">
                    <div class="title__popularIndex w-100">
                        <span class="color--default before--borderBottom"> Sản phẩm bán chạy </span>
                    </div>

                    <div class="index__productSlide d-flex flex-wrap mt-3 w-100">
                     
                        <?php
                        
                        @$product_selling = DB::table('tbl_product')->join('tbl_tr_product', 'tbl_tr_product.product_id', '=', 'tbl_product.id')
                        ->where('tbl_tr_product.lang_id', '=' , $default_lang_id)
                        ->where('tbl_product.enable', '>' , '0')
                        ->where('tbl_product.popular1', '>' , '0')
                        ->where('tbl_product.popular2', '>' , '0')
                        ->get(['tbl_tr_product.*', 'tbl_product.url', 'tbl_product.thumbnail']);
                        
                        ?>

                        <div class='swiper-container swiper-container-slide--product_selling w-100'>
                            <div class='swiper-wrapper'>
                                <?php foreach ($product_selling as  $r_product) { ?>
                                    <div class='swiper-slide'>

                                       @include(config('app.template').'.layout.product-item-swiper')
                                    </div>

                                <?php } ?>
                            </div>
                                <div class='swiper-button-prev swiper-button-prev-slide--product_selling'><i class="fas fa-chevron-left    "></i></div>
                                <div class='swiper-button-next swiper-button-next-slide--product_selling'><i class="fas fa-chevron-right    "></i></div>
                            <!-- Add Arrows -->

                            <!-- <div class='swiper-pagination swiper-pagination-slide--product_selling'></div>  -->
                            <!-- </div> -->
                            <script>
                                $(window).on('load', function() {


                                    var swiper_popular = new Swiper('.swiper-container-slide--product_selling', {
                                        lazy: true,
                                        loadPrevNext: true,
                                        loadPrevNextAmount: 1,
                                        loadOnTransitionStart: true,
                                        allowTouchMove: true,

                                        autoplay: {
                                            delay: 5000,
                                        },
                                        pagination: {
                                            el: '.swiper-pagination-slide--product_selling',
                                            clickable: true
                                        },
                                        speed: 2000,
                                        navigation: {
                                            nextEl: '.swiper-button-next-slide--product_selling',
                                            prevEl: '.swiper-button-prev-slide--product_selling',
                                        },
                                        breakpoints: {
                                            320: {
                                                slidesPerView: 2,
                                                spaceBetween: 5,
                                            },
                                            640: {
                                                slidesPerView: 2,
                                                spaceBetween: 5,
                                            },
                                            768: {
                                                slidesPerView: 2,
                                                spaceBetween: 5,
                                            },
                                            1024: {
                                                slidesPerView: 5,
                                                spaceBetween: 10,
                                            },
                                        },
                                    
                                        on: {
                                            touchEnd: function() {
                                                var realIndex = $('.swiper-container-slide--product_selling .swiper-slide:not(.swiper-slide-duplicate)').length;

                                                for (let index = 0; index <= realIndex; index++) {
                                                                this.lazy.loadInSlide(index);

                                                 }
                                            }
                                        },

                                    });
                                });
                            </script>
                        </div>
            
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</div>