@extends('ui.index')
@section('content')
	@include(config('app.template').'.layout.index-product-new')
	@include(config('app.template').'.layout.index-product-seller')
	@include(config('app.template').'.layout.slider')
	@include(config('app.template').'.layout.index-post')
@endsection