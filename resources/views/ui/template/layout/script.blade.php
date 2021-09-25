<script src="{{ asset('assets/js/app.js') }}"></script>
{{-- <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckfinder/ckfinder.js') }}"></script> --}}
<script src="{{ asset('assets/fancybox/js/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper/swiper.min.js') }}"></script>
<script src="{{ asset('assets/lazy/jquery.lazy.min.js') }}"></script>

<script>
	cartAjax = (obj) => {
		obj._token = $('meta[name="csrf-token"]').attr('content');
		console.log(obj);
		$.ajax({
			type: "post",
			url: "{{route('add-to-cart')}}",
			data: obj,
			dataType: "json",
			success: function(response) {
				// console.log(response);
			}
		});
	}
	updateCart = (obj) => {
		obj._token = $('meta[name="csrf-token"]').attr('content');
		console.log(obj);
		$.ajax({
			type: "post",
			url: "{{route('update-cart')}}",
			data: obj,
			dataType: "json",
			success: function(response) {
				console.log(response['status']);
				// if (response['status'] == 1) {
				cartReload();
				// }
			}
		});
	}

	function cartReload() {
		// if ($(".cart-link").length > 0)

		// 	$(".cart-link").load(" .cart-link > font");

		if ($(".cart__load").length > 0)

			$(".cart__load").load(" .cart__load > .cart__wrapper ");

	}
</script>