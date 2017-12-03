<?php

class ContentCategories extends View{
    /**
     * @param iContentNews $oDataSource
     * @param $mylittleuser
     * @param $verified_admin

     * @param $template
     */
    public function __construct($oDataSource,$mylittleuser,$verified_admin,$template){
        $this->addData('aData', $oDataSource->getList($mylittleuser,$verified_admin));
        parent::__construct($template);
    }
}