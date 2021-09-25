<div class="item__post">
	<div class="item__post-img">
		<a href="<?php echo $r_post->url ?>" class="item__post-link">
			<img class="lazy_load" data-src="{{$r_post->thumbnail}}" alt="<?= $r_post->title ?>">
		</a>
	</div>
	<div class="item__post-content">
		<div class="item__post-content-bg">
			<a href="<?php echo $r_post->url ?>">
				<h5 class="item__post-content-title">
					<?php echo $r_post->title ?>
				</h5>
			</a>
			<div class="item__post-content-date">
			</div>
			<div class="item__post-content-desc">
				<?php echo $r_post->description ?>
			</div>
			<div class="item__postGetLink">
				<a class="btn rounded-0" href="<?php echo $r_post->url ?>">Xem chi tiết</a>
			</div>
		</div>

	</div>
</div>






