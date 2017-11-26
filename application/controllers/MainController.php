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

    public function actionIndex(){
        $this->aHighMenu[] = new Menu((new HighMenu()),$this->user,'top_menu.php');
        $this->aLowMenu[] = new Menu((new LowMenu()),$this->user,'top_menu.php');
    }

    public function actionCategory(){
        $this->aHighMenu[] = new Menu((new HighMenu()),$this->user,'top_menu.php');
        $this->aLowMenu[] = new Menu((new LowMenu()),$this->user,'top_menu.php');
    }
    public function actionNew(){
        $this->aHighMenu[] = new Menu((new HighMenu()),$this->user,'top_menu.php');
        $this->aLowMenu[] = new Menu((new LowMenu()),$this->user,'top_menu.php');
    }



}