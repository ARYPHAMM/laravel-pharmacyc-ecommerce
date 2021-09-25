<div class="productItem">
	<a href=" {{config('app.APP_URL').@$r_product->url.'.html'}}" class="productItem__thumbnail">
        <img class=" swiper-lazy" data-src="{{ $r_product->thumbnail}}" alt="">
        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>

	</a>
	<div class="productItem__heading">
		<a href=" {{config('app.APP_URL').@$r_product->url.'.html'}}" class="productItem__title">
			<?php echo $r_product->title ?>
		</a>
		<div class="productItem__desc">
			<?php echo $r_product->description ?>
		</div>
		<div class="productItem__price mt-1">
			<div class="d-flex flex-row align-items-center">
				<span class="productItem__priceTitle">
					Giá:
				</span>
				<span class="productItem__priceSale">
					<?php echo 'Liên hệ' ?>
				</span>
			</div>
			<del class="productItem__priceOrigin">
			
			</del>
		</div>

	</div>
</div>