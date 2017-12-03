<?php

class RegistrationController extends Controller
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

    protected function getPostPam(){
        if (isset($_POST['email']) & isset($_POST['login'])& isset($_POST['password']) & isset($_POST['date']) &!empty($_POST['date'])&!empty($_POST['password']) & !empty($_POST['login']) & !empty($_POST['email']))
        {
            if ( str_replace(" ","",$_POST['password'])=="" ){
                $this->message = 'Пустой пароль!';
                $this->mylittleuser = null;
                $this->actionIndex(1);
            }else {
                //обраюотка данных
                $login =  $_POST['login'];
                $date =  $_POST['date'];
                $email =  $_POST['email'];
                $password =  $_POST['password'];
                $paramForSave=['login'=>"$login",'email'=>"$email",'user_password'=>"$password",'data_checkin'=>"$date",'data_assumption'=>"$date",'admin_rights'=>0,'locking'=>0];
                if (Users::saveRecord( $paramForSave,1))
                {
                    $this->message='Добро пожаловать, '.$login.'!';
                    $this->mylittleuser=Users::findById($login);
                    $this->actionIndex(0);

                }else {
                    $this->message = $date . ':  пользователь ' . $login . ' НЕ зарегистрирован. Возможно это имя уже занято, попробуйте снова!';
                    $this->mylittleuser = null;
                    $this->actionIndex(1);

                }
            }
        }
        else{
            $this->message="";
            $this->mylittleuser = null;
            $this->actionIndex(1);
        }
    }


    protected function actionMenu(){
        $this->getPostPam();
        //верхнее меню
        $this->aHighMenu[] = new Menu((new HighMenu()),$this->mylittleuser,'top_menu.php');
        //нижнее меню
        $this->aLowMenu[] = new Menu((new LowMenu()),$this->mylittleuser,'top_menu.php');
    }

    protected function actionIndex($rights){
        //форма добавления записи
        $this->aContent[] = new Forms(new Users(),$rights,$this->message,'create_users.php');
    }
}
?>