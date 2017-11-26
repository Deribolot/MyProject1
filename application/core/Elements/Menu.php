<?php
/**
 * Created by PhpStorm.
 * User: rv_000
 * Date: 25.10.2017
 * Time: 11:04
 */

class Menu extends View
{
    /**
     * Menu constructor.
     * @param iMenu $oDataSource
     * @param $mylittleuser
     * @param $template
     */
    public function __construct($oDataSource,$mylittleuser,$template)
    {
        $this->addData('aData', $oDataSource->getData($mylittleuser,null));
        parent::__construct($template);
    }


}