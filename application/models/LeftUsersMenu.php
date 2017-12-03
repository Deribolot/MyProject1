<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class LeftUsersMenu implements iMenu
{
    function getData($mylittleuser,$verified_admin=null)
    {
        $aData['items'] = [];
        if ((Users::findById($mylittleuser->login)->login==$mylittleuser->login) && (Users::findById($mylittleuser->login)->admin_rights==1))
        {
            $aData = ['title' => 'Пользователи'];
            $aData['items'][] = ['title' => "админы", 'href' => '/user/1?login=' . $mylittleuser->login];
            $aData['items'][] = ['title' => "обычные", 'href' => '/user/2?login=' . $mylittleuser->login];
            $aData['items'][] = ['title' => "забаненные", 'href' => '/user/3?login=' . $mylittleuser->login];
        }
        return $aData;
    }

}