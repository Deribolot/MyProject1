<?php


class UserController extends MainController
{
    protected $category;
    protected $verified_admin=1;

    function parseParams($params)
    {
        $sAction = 'actionIndex';
        if (isset($params[2]) && ($params[2])){
            $sAction = 'actionCategory';
            $this->category = $params[2];
        }
        if (method_exists($this, $sAction))
            $this->action = $sAction;
        else
            throw (new Exception('No such action'));
    }

    protected function actionMenu(){
        $this->funcAdmin();
        //верхнее меню
        $this->aHighMenu[] = new Menu((new HighMenu()),$this->mylittleuser,'top_menu.php');
        //нижнее меню
        $this->aLowMenu[] = new Menu((new LowMenu()),$this->mylittleuser,'top_menu.php');
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu((new LeftUsersMenu()),$this->mylittleuser,null,'left_menu.php');
    }

    protected function actionIndex(){
        //главная
        $this->actionMenu();
        //вывод всех категорий
        $this->aContent[] = new ContentCategories(new Users(),$this->mylittleuser, null,'content_categories.php');
    }

    protected function actionCategory(){
        //категория
        $this->actionMenu();
        //вывод всех проверенных/непроверенных категорий
        $this->aContent[] = new ContentCategories(new Users(),$this->mylittleuser, $this->category,'content_categories.php');

    }
    protected function funcDelete($pa_m,$className){
        $new=$className::findById($pa_m);
        $answer=$className::deleteById($pa_m);
        if ($new->login==$this->mylittleuser->login)  $this->mylittleuser=null;
        $answer?var_dump("Удаление успешно выполнено"):var_dump("Удаление выполнить не удалось");
    }

    protected function funcAdminr($pa_m,$className){
        $this->sayMe($pa_m,$className,1,0,"Права админа ","даны");
    }
    protected function funcUser($pa_m,$className){
        $this->sayMe($pa_m,$className,0,0,"Обычные права ","даны");
    }
    protected function funcLocking($pa_m,$className){
        $this->sayMe($pa_m,$className,0,1,"Пользователь ","забанен");
    }
    protected function sayMe($pa_m,$className,$admin_rights,$locking,$string1,$string2){
        $new=$className::findById($pa_m);
        $new->admin_rights=$admin_rights;
        $new->locking=$locking;
        if (($new->login==$this->mylittleuser->login) && ($new->admin_rights==0)) $this->mylittleuser->admin_rights==0;
        if (($new->login==$this->mylittleuser->login) &&  ($new->locking==1)) $this->mylittleuser=null;
        $paramForSave=[];
        $ar=(array)$new;
        foreach ( $ar as $value1){
            foreach ( $value1 as $name=>$value) {
                $paramForSave[$name]=$value;
            }
        }

        $answer= $new->saveRecord( $paramForSave);
        (($answer) && (($className::findById($pa_m)->locking)==$locking)&& (($className::findById($pa_m)->admin_rights)==$admin_rights))?var_dump($string1.$string2):var_dump($string1."не ".$string2);
    }

    protected function funcAdmin(){
        if (isset($_GET['func']) & !empty($_GET['func'])){
            $func=$_GET['func'];
            if ($this->mylittleuser->admin_rights==1){
                //АДМИН
                var_dump("Админ, Я ВЕСЬ ТВОЙ!");
                //делай функцию
                $buttons=['delete','locking','adminr','user'];
                foreach ($buttons as $value)
                {
                    $this->getFunction($func,$value,'Users','login');
                }
            }
            else var_dump("Недостаточно прав, для совершения подобных действий!");
        }
    }

}
?>