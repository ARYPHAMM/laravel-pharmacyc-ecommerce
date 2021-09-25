<div class="productItem">
	<a href="" class="productItem__thumbnail">
		<img class="lazy_load" alt="" data-src="{{ $r_product->thumbnail }}">
	</a>
	<div class="productItem__heading">
		<a href="" class="productItem__title">
			<?= $r_product->title ?>
		</a>
		<div class="productItem__desc">
			<?= $r_product->description ?>
		</div>
		<div class="productItem__price mt-1">
			<div class="d-flex flex-row align-items-center">
				<span class="productItem__priceTitle">
					Giá:
				</span>
				<span class="productItem__priceSale">
					<?php
					//getPriceSale($r_product)
					?>
				</span>
			</div>
			<del class="productItem__priceOrigin">
				<?php
				//getPriceOrigin($r_product)
				?>
			</del>
		</div>
		<div class="productItem__addToCart">
			<button onclick="cartAjax({action: 'addtocart', id: '{{ $r_product->id }}',type:'Mua trực tiếp', msg: 'Thêm vào giỏ hàng thành công!', lbl: 'label-success', callback: function(){ setTimeout(function() { window.location='{{ route('add-to-cart') }}'; }, 1000); } });" class="btn">
				Thêm vào giỏ hàng
			</button>
		</div>
	</div>
</div>