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
            var_dump("это 2");
            if (isset($_GET['new']) & !empty($_GET['new'])) {

                if (News::findById($_GET['new'])){
                    $this->new=   $_GET['new'];
                    $sAction = 'actionCategoryNew';
                    var_dump("это 3");
                }
            }
        }
        else{
            if (isset($_GET['new']) & !empty($_GET['new'])) {

                if (News::findById($_GET['new'])){
                    $this->new=   $_GET['new'];
                    $sAction = 'actionNew';
                    var_dump("это 4");
                }
            }
        }



        if (method_exists($this, $sAction))
            $this->action = $sAction;
        else
            throw (new Exception('No such action'));

        var_dump("Hello");
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
        $this->aLeftMenu[] = new CategoriesMenu(new Categories(),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод всех проверенных новостей
        $this->aContent[] = new ContentNews(new News(),$this->mylittleuser,$this->verified_admin, null,'new_menu.php');
    }

    public function actionCategory(){
        //категория
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(Categories::findById($this->category),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод всех проверенных новостей этой категории
        $this->aContent[] = new ContentNews(new News(),$this->mylittleuser,$this->verified_admin, $this->category,'new_menu.php');

    }

    public function actionNew(){
        //новость
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(new Categories(),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод новости, категории нет
        $this->aContent[] = new ContentNews(News::findById($this->new),$this->mylittleuser,$this->verified_admin,null,'content_news.php');
    }

    public function actionCategoryNew(){
        //категория
        $this->actionMenu();
        //левое меню
        $this->aLeftMenu[] = new CategoriesMenu(Categories::findById($this->category),$this->mylittleuser,$this->verified_admin,'left_menu.php');
        //вывод новости, категории есть
        $this->aContent[] = new ContentNews(News::findById($this->new),$this->mylittleuser,$this->verified_admin, $this->category,'content_news.php');

    }


}
?>