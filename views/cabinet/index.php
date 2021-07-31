<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">

            <h3>Кабинет пользователя</h3>
            
            <h4>Привет, <?php echo $user['name'];?>!</h4><br>
            <ul>
                <li><a class="btn btn-default" href="/cabinet/edit">Редактировать данные</a></li><br>
                <?php if($isAdmin != false){
                    echo "<li><a class='btn btn-default' href='/admin'>Админпанель</a></li>";
                }?>
            </ul>
            </div>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>