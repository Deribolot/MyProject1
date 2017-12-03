<?php

class CreateNews extends View{
    /**
     * @param iForm $oDataSource
     * @param $mylittleuser
     * @param $message
     * @param $template
     */
    public function __construct($oDataSource,$mylittleuser,$message,$template){
        $this->addData('aData', $oDataSource->getForm($mylittleuser,$message));
        parent::__construct($template);
    }
}