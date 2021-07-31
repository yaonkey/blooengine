<?php include ROOT . '/views/layouts/header.php'; ?>

<!--        age-warning-frame-->
        <div id='age-warning-frame'>
            <h3 id='age-warning-header'><strong>А ВАМ ЕСТЬ 18?</strong></h3>
            <p id='age-warning-text'>
                Наш сайт представляет собой каталог для совершеннолетних потребителей табачной
                продукции (граждан России старше 18 лет). <br>
                Мы предоставляем информацию об основных потребительских свойствах
                и характеристиках табачной продукции.<br>
                Лицам, не достигшим совершеннолетия, пользование сайтом запрещено!
            </p>
            <div id='age-warning-buttons'>
                <input type="submit" value='Да' id='age-warning-yes-but'>
                <input type='button' value='Нет' id='age-warning-no-but'>
            </div>  
            
        </div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    
<!--                    <h2>Обсуждение</h2>
                    
                    
                    <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://http-ru-apps-market-zzz-com-ua.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                                        
                    
                    -->
                </div>
            </div>
            
            <div class="col-sm-9 padding-right"> 
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Новинки</h2>

                    <?php foreach ($latestProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                                        <h2><a href="/product/<?php echo $product['id']; ?>">
                                                <?php echo $product['name']; ?>
                                            </a></h2>
                                        <p>
                                            <?php echo $product['price']; ?> РУБ
                                            
                                        </p>
                                        <a href="#" class="btn btn-default add-to-cart" data-id="<?php echo $product['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div><!--features_items-->

                
<!--            <div class="recommended_items">recommended_items
                    <h2 class="title text-center">Рекомендации</h2>
                    <div class="cycle-slideshow" 
                         data-cycle-fx=carousel
                         data-cycle-timeout=5000
                         data-cycle-carousel-visible=3
                         data-cycle-carousel-fluid=true
                         data-cycle-slides="div.item"
                         data-cycle-prev="#prev"
                         data-cycle-next="#next"
                         >                        
                             <?php foreach ($sliderProducts as $sliderItem): ?>
                            <div class="item">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo Product::getImage($sliderItem['id']); ?>" alt="" />
                                            <h3><a href="/product/<?php echo $sliderItem['id']; ?>">
                                                <?php echo $sliderItem['name']; ?>
                                            </a></h3>
                                            <p><?php echo $sliderItem['price']; ?> РУБ</p>
                                            
                                            <br/><br/>
                                            <a href="#" class="btn btn-default add-to-cart" data-id="<?php echo $sliderItem['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                        </div>
                                        <?php if ($sliderItem['is_new']): ?>
                                            <img src="/template/images/home/new.png" class="new" alt="" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <a class="left recommended-item-control" id="prev" href="#recommended-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" id="next"  href="#recommended-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>

                </div>
            </div>/recommended_items-->
                
        </div>
    </div>
        

</section>

<script>
    // age checking script
    $(document).ready(function(){
        if (sessionStorage['checkAge'] == 'yes'){
            $('#age-warning-frame').css({display: "none"});
        }
        $('#age-warning-yes-but').click(function(){ // on "yes" click
            $('#age-warning-frame').css({display: "none"});
            sessionStorage['checkAge'] = 'yes';
        });
        $('#age-warning-no-but').click(function(){ // on "no" click
            sessionStorage['checkAge'] = 'no';
        });
    });
</script>

<?php include ROOT . '/views/layouts/footer.php'; ?>