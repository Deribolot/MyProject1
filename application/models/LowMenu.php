<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class LowMenu implements iMenu
{
    function getData()
    {
        return [
            'Low1'=>[ 'title'=> 'Новости', 'href' => '/' ],
            'Low2'=>[ 'title'=> 'Мои новости', 'href' => '/' ],
        ];
    }

}