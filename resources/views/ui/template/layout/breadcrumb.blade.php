<div id="breadcrumb" class="bg--default">
    <div class="container container__content">
        <div class="row">
            <div class="col-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= is_file('./home.php') ? './index.php' : './' ?>"><i class="fas fa-home text-white"></i></a>
                    </li>
                    <?php
                    $i = 1;
                    foreach ($row_breadcrumb as $uri_breadcrumb => $title_breadcrumb) :
                        if ($uri_breadcrumb != '' && $title_breadcrumb != '') :
                            if ($i < count($row_breadcrumb)) : ?>
                                <li>
                                    <a href="<?php echo $uri_breadcrumb; ?>"><?= $title_breadcrumb ?></a>
                                </li>
                            <?php else : ?>
                                <li class="active"><?= $title_breadcrumb ?></li>
                    <?php endif;
                        endif;
                        $i++;
                    endforeach;
                    ?>
                </ol>
            </div>
        </div>
    </div>
</div>
<style>
    #breadcrumb {
        font-size: 15px;
        /* border-bottom: solid 1px #ccc; */
        display: flex;
        white-space: nowrap;
    }

    .breadcrumb {
        background: transparent;
        margin-bottom: 0;
        padding: 0;
        flex-wrap: nowrap;
        overflow: hidden;
    }

    .breadcrumb li {
        line-height: 50px;
    }

    .breadcrumb>li+li:before {
        content: "\f105";
        position: relative;
        top: 2px;
        font-family: "Font Awesome 5 Pro";
        font-size: 18px;
        font-weight: 300;
        padding: 0 10px 0 7px;
        color: #fff;
        opacity: .7;
    }

    .breadcrumb li a {
        color: inherit;
        -webkit-transition: all .5s;
        -o-transition: all .5s;
        transition: all .5s;
        color: #fff;
    }

    .breadcrumb li a:hover {
        color: #777;
    }

    .breadcrumb li.active {
        color: #fff;
    }
</style>