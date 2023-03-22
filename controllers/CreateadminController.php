<?php

use Blooengine\Components\AdminBase;
use Blooengine\Components\Db;
use Blooengine\Models\User;

class CreateadminController extends AdminBase
{

    public function actionIndex(): bool
    {
        if (Db::checkConnection()) {
            if (count(User::getAllFromTable()) > 0) header('Location: /admin');
        }
        $result = false;
        $siteName = false;
        $siteEmail = false;
        $sitePassword = false;

        if (isset($_POST['submit'])) {
            $siteName = $_POST['site_name'];
            $siteEmail = $_POST['site_email'];
            $sitePassword = $_POST['site_password'];

            $errors = false;

            if (!User::checkEmail($siteEmail)) {
                $errors = ['Неверный email'];
            }
            if (!User::checkPassword($sitePassword)) {
                $errors = ['Пароль не должен быть короче 6-ти символов'];
            }

            if (!$errors) {
                Db::firstInit($siteName, $siteEmail);
                $result = User::createSuperadmin($siteEmail, $sitePassword);
            }
        }

        require_once ROOT . "/views/default/admin/create.php";
        return true;
    }

}