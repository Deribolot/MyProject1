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
            if (isset($_POST['new']) & isset($_POST['login'])& isset($_POST['name']) & isset($_POST['date']) & !empty($_POST['date'])&!empty($_POST['new']) & !empty($_POST['new']) & !empty($_POST['new'])) {
                if ( (str_replace(" ","",$_POST['name'])=="" )|(str_replace(" ","",$_POST['new'])=="" )){
                    $this->message='Пустые поля!';
                } else {
                    $login =  $_POST['login'];
                    $date =  $_POST['date'];
                    $name =  $_POST['name'];
                    $new =  $_POST['new'];
                    $courses=$_POST['courses'];
                    $paramForSave=['name'=>"$name",'login_autor'=>"$login",'data_create'=>"$date",'text'=>"$new",'verified_admin'=>0,'rating'=>0];
                    if (News::saveRecord( $paramForSave)) {
                        $this->message=$date.':  новость  с названием ('.$name.') от пользователя '.$login.' УСПЕШНО принята';
                        if (isset($_POST['courses']) &!empty($_POST['courses']) ){
                            $this->message.='в категории(иях): ';
                            foreach ($courses as $cours){
                                foreach (Categories::findList(null,null) as $category) {
                                    if ($category->name==$cours) {
                                        foreach (News::findList(null,null) as $mynews) {
                                            if ($mynews->name==$name) {
                                                Relationships::saveRecord(['id_news'=>"$mynews->id",'id_category'=>"$category->id"])?
                                                    $this->message.=$category->name.', ':'';
                                            }
                                        }

                                    }
                                }
                            }
                            $this->message=substr ( $this->message, 0 , strlen ( $this->message)-2);
                        }
                    } else{
                        $this->message=$date.':  новость  с названием ('.$name.') от пользователя '.$login.' НЕ принята. Проверьте ее уникальность и попробуйте снова!';
                    }
                }
            }
            else{
                if (isset($_POST['category']) &!empty($_POST['category']) ) {
                    if ( str_replace(" ","",$_POST['category'])==""){
                        $this->message='Пустая категория';
                    }else {
                        $mycategory =  $_POST['category'];
                        $flag=false;
                        foreach (Categories::findList(null,null) as $category) {
                            if ($category->name==$mycategory) {
                                $flag=true;
                            }
                        }
                        if (!$flag){
                            Categories::saveRecord(['name'=>"$mycategory",'verified_admin'=>0])? $this->message='Категория '.$mycategory.' принята':$this->message='Категория '.$mycategory.' неверная или неуникальная';
                        }else{
                            $this->message='Категория '.$mycategory.' уже существует';
                        }
                    }

                }
                else {
                    $this->message = "";
                }
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