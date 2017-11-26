<?php

class View
{
	
	private $aData = [];
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }


    function addData( $sName, $Value ){
	    $this->aData[$sName] = $Value;
    }

	function generate()
	{
	    // aData =['aHeader' => $this->aHeader, 'aContent' => $this->aContent ,'aLeftMenu' => $this->aLeftMenu];
	    foreach ( $this->aData as $sName => $value)
	        $$sName = $value;

		include 'application/views/'.$this->template;
	}
}
