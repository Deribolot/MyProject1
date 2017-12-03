<?php

class LoginController extends Controller
{
    protected $message;

    function parseParams($params)
    {
        $sAction = 'actionMenu';
        if (method_exists($this, $sAction))
            $this->action = $sAction;
        else
            throw (new Exception('No such action'));
    }

    protected function getPostPam()
    {
        $mylittleuser = $this->mylittleuser;
        if (isset($_POST['login']) & isset($_POST['password']) & !empty($_POST['password']) & !empty($_POST['login'])) {
            //обраюотка данных
            $login = $_POST['login'];
            $password = $_POST['password'];
            if ((Users::findById($login)->user_password == $password) && (Users::findById($login)->locking == 0)) {
                $this->message = 'Добро пожаловать,' . $login . '!';
                $this->mylittleuser = Users::findById($login);
                $this->actionIndex(0);

            } elseif ((Users::findById($login)->user_password == $password) && (Users::findById($login)->locking == 1)) {
                $this->message = 'Поздравляю, ' . $login . '! Ты забанен:)';
                $this->mylittleuser = null;
                $this->actionIndex(0);
            } else {
                $this->message = 'Такого пользователя не существует! Необходима регистрация';
                $this->mylittleuser = null;
                $this->actionIndex(1);
            }

        } else {
            $this->message = "";
            $this->mylittleuser = null;
            $this->actionIndex(1);
        }
    }


    protected function actionMenu()
    {
        $this->getPostPam();
        //верхнее меню
        $this->aHighMenu[] = new Menu((new HighMenu()), $this->mylittleuser, 'top_menu.php');
        //нижнее меню
        $this->aLowMenu[] = new Menu((new LowMenu()), $this->mylittleuser, 'top_menu.php');
    }

    protected function actionIndex($rights)
    {
        //форма добавления записи
        $this->aContent[] = new Forms(new Users(), $rights, $this->message, 'login_users.php');
    }
}
?>