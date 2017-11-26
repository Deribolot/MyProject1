<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class LeftMenu implements iMenu
{
    function getData($user)
    {
        if (!$user)
        {
            return [
                'Low1'=>[ 'title'=> 'Новости', 'href' => "/main?login=log6" ],
            ];
        }
        else
        {
            return [
                'Low1'=>[ 'title'=> "Новости", 'href' => "/main?$user->login" ],
                'low2'=>[ 'title'=> 'Мои новости', 'href' => '/main/' ],
            ];
        }

    }
}