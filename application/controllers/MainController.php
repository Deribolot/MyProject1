<?php


class MainController extends Controller
{
    private $category;
    private $new;

    function parseParams($params)
    {
        var_dump("MainController");
        $sAction = 'actionIndex';

        if (isset($params[2]) && ($params[2])){
            $sAction = 'actionCategory';
            $this->category = $params[2];
        }

        if (isset($params[3]) && ($params[3])){
            $sAction = 'actionNew';
            $this->new = $params[3];
        }

        if (method_exists($this, $sAction))
            $this->action = $sAction;
        else
            throw (new Exception('No such action'));

    }

    public function actionIndex(){
        $this->aHighMenu[] = new Menu((new HighMenu()),'top_menu.php');
        $this->aLowMenu[] = new Menu((new LowMenu()),'top_menu.php');
    }

    public function actionCategory(){
        $this->aHighMenu[] = new Menu((new HighMenu()),'top_menu.php');
        $this->aLowMenu[] = new Menu((new LowMenu()),'top_menu.php');
    }
    public function actionNew(){
        $this->aHighMenu[] = new Menu((new HighMenu()),'top_menu.php');
        $this->aLowMenu[] = new Menu((new LowMenu()),'top_menu.php');
    }



}