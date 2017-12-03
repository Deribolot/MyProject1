<?php

class Forms extends View{
    /**
     * @param iForm $oDataSource
     * @param $rights
     * @param $message
     * @param $template
     */
    public function __construct($oDataSource,$rights,$message,$template){
        $this->addData('aData', $oDataSource->getForm($rights,$message));
        parent::__construct($template);
    }
}