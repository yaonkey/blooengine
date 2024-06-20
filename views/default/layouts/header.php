<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blooengine</title>
    <link rel="icon" href="/template/images/home/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="/template/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/template/images/home/logo.png" type="image/x-icon" />
    <link href="/template/css/font-awesome.min.css" rel="stylesheet">
    <link href="/template/css/prettyPhoto.css" rel="stylesheet">
    <link href="/template/css/price-range.css" rel="stylesheet">
    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/main.css" rel="stylesheet">
    <link href="/template/css/responsive.css" rel="stylesheet">
    <link href="/views/default/css/main.css" rel="stylesheet">
    <script src="/views/default/js/main.js"></script>
    <script src="/template/js/bootstrap.min.js"></script>
    <script src="/template/js/jquery.js"></script>

</head><!--/head-->

<body>
    <div class="page-wrapper">
        <script type="text/javascript">
            $(function() {

                $(".search_button").click(function() {
                    // получаем то, что написал пользователь
                    var searchString = $("#search_box").val();
                    // формируем строку запроса
                    var data = 'search=' + searchString;

                    // если searchString не пустая
                    if (searchString) {
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
                            success: function(html) { // запустится после получения результатов
                                $("#results").show();
                                $("#results").append(html);
                            }
                        });
                    }
                    return false;
                });
            });
        </script>


        <header id="header">
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
                                    <li>
                                        <div class="logo pull-left">
                                            <a href="/"><img src="/template/images/home/logo.png" alt="" /></a>
                                        </div>
                                    </li>
                                    <li><a href="/"><i class="fa fa-home"></i> Главная</a></li>
                                    <li><a>
                                            <?php

                                            use Blooengine\Components\Cart;
                                            use Blooengine\Models\User;

                                            include THEME . 'layouts/categoryView.php'; ?>
                                        </a></li>
                                    <li><a href="../../../index.php">
                                            <i class="fa fa-shopping-cart"></i> Корзина
                                            [<span id="cart-count"><?php echo Cart::countItems(); ?></span>]
                                        </a>
                                    </li>
                                    <?php if (User::isGuest()) : ?>
                                        <li><a href="/user/login/"><i class="fa fa-lock"></i> Вход</a></li>
                                        <li><a href="/user/register/"><i class="fa fa-lock"></i> Регистрация</a></li>
                                    <?php else : ?>
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