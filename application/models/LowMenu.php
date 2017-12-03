<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class LowMenu implements iMenu
{
    function getData($mylittleuser,$verified_admin=null)
    {
        if (!$mylittleuser)
        {
            return [
                'Low1'=>[ 'title'=> 'Новости', 'href' => "/main" ],
            ];
        }
        else
        {
            if ($mylittleuser->admin_rights==1){
                return [
                    'Low1'=>[ 'title'=> "Одобренные новости", 'href' => "/main?login=$mylittleuser->login" ],
                    'Low2'=>[ 'title'=> 'Мои новости', 'href' => "/my?login=$mylittleuser->login" ],
                    'Low3'=>[ 'title'=> 'Неодобренные новости', 'href' => "/bad?login=$mylittleuser->login" ],
                    'Low4'=>[ 'title'=> 'Пользователи', 'href' => "/user?login=$mylittleuser->login" ],
                    'Low5'=>[ 'title'=> 'Категории', 'href' => "/category?login=$mylittleuser->login" ],
                ];
            }
            else{
                return [
                    'Low1'=>[ 'title'=> "Новости", 'href' => "/main?login=$mylittleuser->login" ],
                    'low2'=>[ 'title'=> 'Мои новости', 'href' => "/my?login=$mylittleuser->login" ],
                ];
            }


        }
    }

}