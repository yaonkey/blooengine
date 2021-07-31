<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Hookah</title>
        <link rel="icon" href="/template/images/home/logo.ico" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!--
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <link rel="shortcut icon" href="/template/images/home/logo.ico" type="image/x-icon" />
        <link href="/template/css/bootstrap.min.css" rel="stylesheet">
        <link href="/template/css/font-awesome.min.css" rel="stylesheet">
        <link href="/template/css/prettyPhoto.css" rel="stylesheet">
        <link href="/template/css/price-range.css" rel="stylesheet">
        <link href="/template/css/animate.css" rel="stylesheet">
        <link href="/template/css/main.css" rel="stylesheet">
        <link href="/template/css/responsive.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        
    </head><!--/head-->

    <body>
        <div class="page-wrapper">

<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>-->
<script type="text/javascript">

$(function() {

    $(".search_button").click(function() {
        // получаем то, что написал пользователь
        var searchString    = $("#search_box").val();
        // формируем строку запроса
        var data            = 'search='+ searchString;

        // если searchString не пустая
        if(searchString) {
            // делаем ajax запрос
            $.ajax({
                type: "POST",
                url: "do_search.php",
                data: data,
                beforeSend: function(html) { // запустится до вызова запроса
                    $("#results").html('');
                    $("#searchresults").show();
                    $(".word").html(searchString);
               },
               success: function(html){ // запустится после получения результатов
                    $("#results").show();
                    $("#results").append(html);
              }
            });
        }
        return false;
    });
});
</script>
            
            
            <header id="header"><!--header-->
<!--                <div class="header_top">header_top
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="contactinfo">
                                    <ul class="nav nav-pills">
                                        LOGO
                                        <li><a href="/"><i class="fa fa-home"></i> Главная</a></li>
                                        <li><a href="/catalog/"><i class="fa fa-dollar"></i> Купить</a></li>
                                        <li><a href="/cart">
                                                <i class="fa fa-shopping-cart"></i> Корзина 
                                                    [<span id="cart-count"><?php echo Cart::countItems(); ?></span>]
                                            </a>
                                        </li>
                                       
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="contactinfo pull-right">
                                    <ul class="nav nav-pills">
                                        
                                        <?php if (User::isGuest()): ?>                                        
                                            <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                            <li><a href="/user/register/"><i class="fa fa-lock"></i> Регистрация</a></li>
                                        <?php else: ?>
                                            <li><a href="/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                                        <?php endif; ?>
                                            <li><a href="/about/"><i class="fa fa-info-circle"></i> О нас</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>/header_top-->

                
                <div class="header-bottom"><!--header-bottom and active layout-->
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div class="mainmenu pull-left">
                                    <ul class="nav navbar-nav collapse navbar-collapse">
                                        <li><div class="logo pull-left">
                                    <a href="/"><img src="/template/images/home/logo.png" alt="" /></a>
                                </div></li>
                                        <li><a href="/"><i class="fa fa-home"></i> Главная</a></li>
                                        <li><a>
                                            <?php include ROOT.'/views/layouts/categoryView.php'; ?>
                                        </a></li>
                                        <li><a href="/cart">
                                                <i class="fa fa-shopping-cart"></i> Корзина 
                                                    [<span id="cart-count"><?php echo Cart::countItems(); ?></span>]
                                            </a>
                                        </li>
                                        <?php if (User::isGuest()): ?>                                        
                                            <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                            <li><a href="/user/register/"><i class="fa fa-lock"></i> Регистрация</a></li>
                                        <?php else: ?>
                                            <li><a href="/cabinet/"><i class="fa fa-user"></i> Аккаунт</a></li>
                                            <li><a href="/user/logout/"><i class="fa fa-unlock"></i> Выход</a></li>
                                        <?php endif; ?>
                                            <li><a href="/about/"><i class="fa fa-info-circle"></i> О нас</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/header-bottom-->

            </header><!--/header-->