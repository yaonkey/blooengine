<?php use Blooengine\Models\Product;

include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="row">
                            <div class="col-sm-7" width="300" height="240">
                                <div class="view-product">
                                    <img id='basic' src="<?php echo Product::getImage($product['id']); ?>" alt=""/>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="product-information"><!--/product-information-->

                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/product-details/new.jpg" class="newarrival" alt=""/>
                                    <?php endif; ?>

                                    <h2><?php echo $product['name']; ?></h2>
                                    <p>Код товара: <?php echo $product['code']; ?></p>
                                    <span>
                                    <span><?php echo $product['price']; ?> РУБ </span>
                                    <a href="#" data-id="<?php echo $product['id']; ?>"
                                       class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>В корзину
                                    </a>
                                </span>
                                    <p>
                                        <b>Наличие:</b> <?php echo Product::getAvailabilityText($product['availability']); ?>
                                    </p>
                                    <p><b>Производитель:</b> <?php echo $product['brand']; ?></p>
                                </div><!--/product-information-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br/>
                                <h5>Описание товара</h5>
                                <?php echo $product['description']; ?>
                            </div>


                            <div id="disqus_thread"
                                 style="margin-left: 30px; margin-right: 30px; margin-top: 30px;"></div>


                        </div>
                    </div><!--/product-details-->

                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>