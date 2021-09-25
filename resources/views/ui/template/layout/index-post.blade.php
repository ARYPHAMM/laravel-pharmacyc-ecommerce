<div class="index">
    <div class="index__post">
        <div class="container container__content">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="index__popularPost">
                        Góc sức khỏe
                    </div>
                    <?php
                    @$row_post =  DB::table('tbl_post')->join('tbl_tr_post', 'tbl_tr_post.post_id', '=', 'tbl_post.id')
                        ->where('tbl_tr_post.lang_id', '=' , $default_lang_id)
                        ->where('tbl_post.enable', '>' , '0')
                        ->where('tbl_post.popular1', '>' , '0')
                        ->get(['tbl_tr_post.*', 'tbl_post.url', 'tbl_post.thumbnail']);
                    ?>
                    <?php foreach ($row_post as $r_post) { ?>
                    <div class="col-12 col-md-6">
                        @include(config('app.template').'.layout.post-item')
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>