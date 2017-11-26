<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 26.10.2017
 * Time: 11:12
 */

class HighMenu implements iMenu
{
    function getData()
    {
        return [
            'High1'=>[ 'title'=> 'Я-автор', 'href' => '/1' ],
            'High2'=>[ 'title'=> 'Выход', 'href' => '/1' ],
        ];
    }

}