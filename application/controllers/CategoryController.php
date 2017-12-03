<?php


class CategoryController extends MainController
{
    protected $category;
    protected $verified_admin=1;

    function parseParams($params)
    {
        $sAction = 'actionIndex';
        if (isset($params[2]) && ($params[2])){
            $sAction = 'actionCategory';
            ($params[2]=="yes")? $this->category = 1:$this->category = 0;
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
        $this->aLeftMenu[] = new CategoriesMenu((new LeftMenu()),$this->mylittleuser,null,'left_menu.php');
    }

    protected function actionIndex(){
        //главная
        $this->actionMenu();
        //вывод всех категорий
        $this->aContent[] = new ContentCategories(new Categories(),$this->mylittleuser, null,'content_categories.php');
    }

    protected function actionCategory(){
        //категория
        $this->actionMenu();
        //вывод всех проверенных/непроверенных категорий
        $this->aContent[] = new ContentCategories(new Categories(),$this->mylittleuser, $this->category,'content_categories.php');

    }

    protected function funcAdmin(){
        if (isset($_GET['func']) & !empty($_GET['func'])){
            $func=$_GET['func'];
            if ($this->mylittleuser->admin_rights==1){
                //АДМИН
                var_dump("Админ, Я ВЕСЬ ТВОЙ! $func");
                //делай функцию
                $buttons=['delete','set'];
                foreach ($buttons as $value)
                {
                    $this->getFunction($func,$value,'Categories');
                }
            }
            else var_dump("Недостаточно прав, для совершения подобных действий!");
        }
    }

}
?>