@extends('ui.index')
@section('content')
@include('ui.template.layout.breadcrumb')
<div class="product">
	<div class="container container__content">
		<div class="row mt-3 mb-3 ">
			<div class="row w-100">
				<?php
				
					foreach ($product as $r_product) { ?>
					<div class="col__md3 col__sm6 mb-3">
					   @include(config('app.template').'.layout.product-item')
					</div>
				<?php  } ?>
			</div>
		</div>
		<div class="d-flex justify-content-center">
			{{ $product->links('vendor.pagination.bootstrap-4') }}
		</div>
	</div>
</div>    
@endsection