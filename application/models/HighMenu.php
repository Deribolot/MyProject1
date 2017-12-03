<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class HighMenu implements iMenu
{
    function getData($mylittleuser,$verified_admin=null)
    {
        if (!$mylittleuser)
        {
            return [
                'High1'=>[ 'title'=> 'Вход', 'href' => "/login" ],
                'High2'=>[ 'title'=> 'Регистрация', 'href' => '/registration' ],
            ];
        }
        else
        {
            return [
                'High1'=>[ 'title'=> 'create', 'href' => "/create?login=$mylittleuser->login" ],
                'High2'=>[ 'title'=> "Я-$mylittleuser->login", 'href' => "/main?login=$mylittleuser->login" ],
                'High3'=>[ 'title'=> 'Выход', 'href' => '/main' ],
            ];
        }

    }

}