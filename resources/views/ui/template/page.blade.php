@extends('ui.index')
@section('content')
@include('ui.template.layout.breadcrumb')

<section id="content" class="page">
	<figure class="container container__content">
		<div class="row">
			<div class="">
				<?php echo $category->content ?>
			</div>
		</div>
	</figure>
</section>

@endsection