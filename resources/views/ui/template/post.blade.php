@extends('ui.index')
@section('content')
    @include('ui.template.layout.breadcrumb')
    <div class="container container__content">
        <div class="row justify-content-center">
            <span class="d-flex justify-content-center w-100">
                <a class="title__popularIndex color--default mt-1 " href="{{ $category->url }}"><?php echo
                    $category->title; ?></a>
            </span>
            <?php foreach ($post as $r_post) { ?>
            <div class="col-12 col-md-9 mb-3">
                @include('ui.template.layout.post-item')
            </div>
            <?php } ?>
        </div>
        <div class="row">
        </div>
    </div>
@endsection
