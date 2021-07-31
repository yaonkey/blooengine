<?php include ROOT . '/views/layouts/header.php'; ?>

<!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    
                   <?php include_once ROOT . '/views/layouts/categoryView.php'; ?> 
            
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Каталог</h2>
                    
<!--                    реализация поиска-->
                    <form name="search" method="post"  class='searchform' action="search" style='padding-left: 15px; padding-bottom: 15px;'>
                        <input style='margin-right: 5px; margin-bottom: 5px;' type="search" name="query" placeholder="Поиск">
                        <button type="submit">Найти</button> 
                        <label for="search"><?php echo $searchError; ?></label>
                    </form>
                    
                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                                        <h2><a href="/product/<?php echo $product['id'];?>">
                                                <?php echo $product['name'];?>
                                            </a></h2>
                                        <p><?php echo $product['price'];?> РУБ
                                            
                                        </p>
                                        
                                        <a href="#" data-id="<?php echo $product['id'];?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину
                                        </a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>                   

                </div><!--features_items-->
                   
                <!-- Постраничная навигация -->
                 <?php echo $pagination->get(); ?>

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>