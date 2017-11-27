<?php


class MainController extends Controller
{
    private $category;
    private $new;

    function parseParams($params)
    {
        $sAction = 'actionIndex';

        if (isset($params[2]) && ($params[2])){
            $sAction = 'actionCategory';
            $this->category = $params[2];
            var_dump("это 2");
        }

        if (isset($params[3]) && ($params[3])){
            $sAction = 'actionNew';
            $this->new = $params[3];
            var_dump("это 3");
        }

        if (method_exists($this, $sAction))
            $this->action = $sAction;
        else
            throw (new Exception('No such action'));

    }

    public function actionMenu(){
        //верхнее меню
        $this->aHighMenu[] = new Menu((new HighMenu()),$this->mylittleuser,'top_menu.php');
        //нижнее меню
        $this->aLowMenu[] = new Menu((new LowMenu()),$this->mylittleuser,'top_menu.php');
    }

    public function actionIndex(){
        //главная
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(new Categories(),$this->mylittleuser,1,'left_menu.php');
        //вывод всех проверенных новостей
    }

    public function actionCategory(){
        //категория
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(Categories::findById($this->category),$this->mylittleuser,1,'left_menu.php');
        //вывод всех проверенных новостей этой категории
    }

    public function actionNew(){
        //новость
        $this->actionMenu();
    }



}