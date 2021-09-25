<div class="footer bg--default">
    <div class="footer__top">
        <div class="container container__content">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer__title text-white">
                        <?= $layout['footer']['footer-title-1']['value'] ?>
                    </div>
                    <div class="footer__content">
                        <?= @$layout['footer']['footer-content-1']['value'] ?>
    
                        </div>
                 
                </div>
                <div class="col-md-3">
                    <div class="footer__title text-white">
                        <?= $layout['footer']['footer-title-2']['value'] ?>
                    </div>
                    <div class="footer__content">
                        <ul class="footer__categoryList">
                            <?php foreach ($layout['footer']['footer-category-2'] as $r_category) { ?>
                                <li>
                                    <a href="<?php echo $r_category['url'] ?>">
                                <?php echo  $r_category['title'] ?>
                                </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                <div class="footer__title text-white">
                        <?= $layout['footer']['footer-title-3']['value'] ?>
                    </div>
                    <div class="footer__content">
                    <ul class="footer__categoryList">
                            <?php foreach ($layout['footer']['footer-category-3'] as $r_category) { ?>
                                <li>
                                    <a href="<?php echo $r_category['url'] ?>">
                                        <?php echo  $r_category['title'] ?>
                                        </a>
                                </li>
                            <?php } ?>
                        </ul>

                    </div>
                    <div class="footer__content">
                    <?= @$layout['footer']['footer-content2']['value'] ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
       <div class="text-center">
<?= @$information['copyright'] ?>
       </div>
    </div>
</div>