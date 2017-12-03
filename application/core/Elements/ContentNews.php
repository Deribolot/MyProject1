<?php

class ContentNews extends View{
    /**
     * @param iContentNews $oDataSource
     * @param $mylittleuser
     * @param $verified_admin
     * @param $id_category
     * @param $template
     */
    public function __construct($oDataSource,$mylittleuser,$verified_admin,$id_category,$template){
        $this->addData('aData', $oDataSource->getData($mylittleuser,$verified_admin,$id_category));
        parent::__construct($template);
    }
}