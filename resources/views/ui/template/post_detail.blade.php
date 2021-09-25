@extends('ui.index')
@section('content')
<div class="container container__content">
    <div class="row mt-5">
    
    <div class="product__detail-content col-12">
        <div class="post__detail-wrap width-web">
            
            
            <div class="post__detail-content">
                <h3 class="post__detail-title">
                    <?php echo $post->title ?>
                </h3>
            
                <p class="post__detail-desc">
                    <?php echo $post->descritpion ?>
                </p>
                <div class="post__detail-content">
                    <?php echo $post->content ?>
                </div>
            
            </div>
    
    
        </div>
    </div>
    </div>
    </div>
    
@endsection