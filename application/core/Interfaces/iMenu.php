<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 25.10.2017
 * Time: 11:06
 */

interface iMenu
{
    /**
     * @param $mylittleuser
     * @param $verified_admin
     * @return array
     */
    function getData($mylittleuser,$verified_admin);
}