<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class TopMenu implements iMenu
{
    function getData()
    {
        return [
            'Main'=>[ 'title'=> 'Главная', 'href' => '/' ],
            'Catalog'=>[ 'title'=> 'Каталог', 'href' => '/catalog' ],
        ];
    }

}