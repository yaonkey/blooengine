<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4">

                <?php if ($result): ?>
                    <p>Первый администратор зарегистрирован!</p>
                    <?php header('Location: /admin'); ?>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--first sign up form-->
                        <h2>Регистрация первого администратора</h2>
                        <form action="#" method="post">
                            <input type="email" name="site_email" placeholder="E-mail сайта"
                                   value="<?= $siteEmail ?>"/>
                            <input type="password" name="site_password" placeholder="Пароль"
                                   value="<?= $sitePassword ?>"/>
                            <input type="text" name="site_name" placeholder="Наименование сайта"
                                   value="<?= $siteName ?>"/>
                            <label>Для входа а админку сайта используйте Email сайта и пароль администратора</label>
                            <input type="submit" name="submit" class="btn btn-default" value="Готово"/>
                        </form>
                    </div><!--/ first sign up form-->

                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>
