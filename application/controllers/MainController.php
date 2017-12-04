<?php


class MainController extends Controller
{
    protected $category;
    protected $new;
    protected $verified_admin=1;

    function parseParams($params)
    {

        $sAction = 'actionIndex';

        if (isset($params[2]) && ($params[2])){
            $sAction = 'actionCategory';
            $this->category = $params[2];
            if (isset($_GET['new']) & !empty($_GET['new'])) {

                if (News::findById($_GET['new'])){
                    $this->new=   $_GET['new'];
                    $sAction = 'actionCategoryNew';
                }
            }
        }
        else{
            if (isset($_GET['new']) & !empty($_GET['new'])) {

                if (News::findById($_GET['new'])){
                    $this->new=   $_GET['new'];
                    $sAction = 'actionNew';
                }
            }
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
    }

    protected function actionIndex(){
        //главная
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(new Categories(),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод всех проверенных новостей
        $this->aContent[] = new ContentNews(new News(),$this->mylittleuser,$this->verified_admin, null,'new_menu.php');
    }

    protected function actionCategory(){
        //категория
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(Categories::findById($this->category),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод всех проверенных новостей этой категории
        $this->aContent[] = new ContentNews(new News(),$this->mylittleuser,$this->verified_admin, $this->category,'new_menu.php');

    }

    protected function actionNew(){
        //новость
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(new Categories(),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод новости, категории нет
        $this->aContent[] = new ContentNews(News::findById($this->new),$this->mylittleuser,$this->verified_admin,null,'content_news.php');
    }

    protected function actionCategoryNew(){
        //категория
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(Categories::findById($this->category),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод новости, категории есть
        $this->aContent[] = new ContentNews(News::findById($this->new),$this->mylittleuser,$this->verified_admin, $this->category,'content_news.php');

    }
    protected function getFunction($func,$name,$className,$id='id'){
        if  (strpos($func, $name)) {
            $pa_m=explode($name,$func );
            $function='func'.ucfirst($name);
            //проверка существования метод
            if (method_exists($this,$function)) {
                if ($className::findById($pa_m[0])->$id) {
                    $this->$function($pa_m[0],$className);
                    return true;
                }
                else return false;
            }
            else return false;
        }
        else return false;
    }
    protected function funcDelete($pa_m,$className){
        $answer=$className::deleteById($pa_m);
        $answer?var_dump("Удаление успешно выполнено"):var_dump("Удаление выполнить не удалось");
    }
    protected function funcSet($pa_m,$className){
        $new=$className::findById($pa_m);
        $new->verified_admin=1;
        $paramForSave=[];
        $ar=(array)$new;
        foreach ( $ar as $value1)
            foreach ( $value1 as $name=>$value)
                $paramForSave[$name]=$value;
        $answer= $new->saveRecord( $paramForSave);
        (($answer) && (($className::findById($pa_m)->verified_admin)==1))?var_dump("Одобрение выполнено успешно"):var_dump("Одобрение выполнить не удалось");
    }
    protected function funcAdmin(){
        if (isset($_GET['func']) & !empty($_GET['func'])){
            $func=$_GET['func'];
            if ($this->mylittleuser->admin_rights==1){
                //АДМИН
                var_dump("Админ, Я ВЕСЬ ТВОЙ!");
                //делай функцию
                $buttons=['delete','set'];
                foreach ($buttons as $value)
                {
                    $this->getFunction($func,$value,'News');
                }
            }
            else {
                if ($this->mylittleuser->admin_rights==0){
                    //ПОЛЬЗОВАТЕЛЬ
                    $id_new=explode('delete',$func );
                    //Удалить, если это его новость
                    If(News::findById($id_new[0])->login_autor==$this->mylittleuser->login)
                    {
                        $this->getFunction($func,'delete','News');
                        var_dump("Ой, удаляй, надоел! $func");
                    }
                    else{
                        var_dump("Не тое, не трожь! $func");
                    }
                }
                else var_dump("Недостаточно прав, для совершения подобных действий!");
            }
        }
    }


}
?>