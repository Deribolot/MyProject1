<?php

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