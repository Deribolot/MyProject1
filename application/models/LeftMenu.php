<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class LeftMenu implements iMenu
{
    function getData($mylittleuser,$verified_admin=null)
    {
        if (!$mylittleuser)
        {
            return [
                'Low1'=>[ 'title'=> 'Все новости', 'href' => "/main" ],
                'Low2'=>[ 'title'=> 'Категории', 'href' => "" ],
                'Low3'=>[ 'title'=> 'Категории', 'href' => "/main" ],
            ];
        }
        else
        {
            if ($mylittleuser->admin_rights==1){
                return [
                    'Low1'=>[ 'title'=> 'Все новости', 'href' => "/main" ],
                    'Low2'=>[ 'title'=> 'Категории', 'href' => "/main" ],
                ];
            }
            else{
                return [
                    'Low1'=>[ 'title'=> 'Все новости', 'href' => "/main" ],
                    'Low2'=>[ 'title'=> 'Категории', 'href' => "/main" ],
                ];
            }


        }

    }

    public function actionIndex(){
      /*  $this->aHeader[] = new Menu((new TopMenu()),'top_menu.php');
        $this->aLeftMenu[] = new Menu(new Category(),'left_menu.php');
        var_dump("1");*/

    }

    public function actionCategory(){
      /*  $this->aHeader[] = new Menu((new TopMenu()),'top_menu.php');
        $this->aLeftMenu[] = new Menu(Category::findById($this->category),'left_menu.php');
        var_dump("2");*/

    }





}