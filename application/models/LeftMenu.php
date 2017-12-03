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
        $aData['items'] = [];
        if ((Users::findById($mylittleuser->login)->login==$mylittleuser->login) && (Users::findById($mylittleuser->login)->admin_rights==1))
        {
            $aData = ['title' => 'Категории'];
            $aData['items'][] = ['title' => "одобренные", 'href' => '/category/yes?login=' . $mylittleuser->login];
            $aData['items'][] = ['title' => "неодобренные", 'href' => '/category/no?login=' . $mylittleuser->login];

        }
        return $aData;
    }

}