<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 25.10.2017
 * Time: 11:06
 */

interface iContentNews
{
    /**
     * @param $mylittleuser
     * @param $verified_admin
     * @param $id_category
     * @return array
     */
    function getData($mylittleuser,$verified_admin,$id_category);
}