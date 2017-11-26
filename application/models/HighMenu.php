<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class HighMenu implements iMenu
{
    function getData($user)
    {
        if (!$user)
        {
            return [
                'High1'=>[ 'title'=> 'Вход', 'href' => "/main?login=log6" ],
                'High2'=>[ 'title'=> 'Регистрация', 'href' => '/main/' ],
            ];
        }
        else
        {
            return [
                'High1'=>[ 'title'=> "Я-$user->login", 'href' => "/main?$user->login" ],
                'High2'=>[ 'title'=> 'Выход', 'href' => '/main/' ],
            ];
        }

    }

}