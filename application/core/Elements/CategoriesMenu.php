<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 25.10.2017
 * Time: 11:04
 */

class CategoriesMenu extends View{
    /**
     * @param iMenu $oDataSource
     * @param $mylittleuser
     * @param $verified_admin
     * @param $template
     */
    public function __construct($oDataSource,$mylittleuser,$verified_admin,$template){
        $this->addData('aData', $oDataSource->getData($mylittleuser,$verified_admin));
        parent::__construct($template);
    }
}