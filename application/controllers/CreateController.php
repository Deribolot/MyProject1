<?php

class CreateController extends Controller
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
        $mylittleuser=$this->mylittleuser;
        if( (Users::findById($mylittleuser->login)) & (Users::findById($mylittleuser->login)->locking==0)) {
            if (isset($_POST['new']) & isset($_POST['login'])& isset($_POST['name']) & isset($_POST['date']) &!empty($_POST['date'])&!empty($_POST['new']) & !empty($_POST['new']) & !empty($_POST['new']))
            {
                $login =  $_POST['login'];
                $date =  $_POST['date'];
                $name =  $_POST['name'];
                $new =  $_POST['new'];
                $paramForSave=['name'=>"$name",'login_autor'=>"$login",'data_create'=>"$date",'text'=>"$new",'verified_admin'=>0,'rating'=>0];
                News::saveRecord( $paramForSave)?   $this->message=$date.':  новость  с названием ('.$name.') от пользователя '.$login.' УСПЕШНО принята':
                    $this->message=$date.':  новость  с названием ('.$name.') от поьльзователя '.$login.' НЕ принята. Проверьте ее уникальность и попробуйте снова!';
            }
            else{
                $this->message="";
            }
            $this->actionIndex();
        }else {
            $this->message="Вы не можете создавать записи!";
            $this->actionMessage();
        }
    }


    protected function actionMenu(){
        $this->getPostPam();
        //верхнее меню
        $this->aHighMenu[] = new Menu((new HighMenu()),$this->mylittleuser,'top_menu.php');
        //нижнее меню
        $this->aLowMenu[] = new Menu((new LowMenu()),$this->mylittleuser,'top_menu.php');
    }

    protected function actionIndex(){
        //форма добавления записи
        $this->aContent[] = new CreateNews(new News(),$this->mylittleuser,$this->message,'create_news.php');
    }

    protected function actionMessage(){
        //форма добавления записи
        $this->aContent[] = new CreateNews(new News(),null,$this->message,'create_news.php');
    }
}
?>