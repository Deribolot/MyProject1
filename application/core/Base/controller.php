<?php

abstract class Controller {

    protected $action;

	public $aHighMenu = [];
    public $aLowMenu = [];
	public $aContent = [];
	public $aLeftMenu = [];

	private $view;
    /**
     * @param array $params
     */
	abstract function parseParams($params);

	function __construct($params = [],$template = 'main.php')
	{
        //$routes = []
	    $this->parseParams($params);

	     //main.php -- основной вид сайта
        //создали страницу
		$this->view = new View($template);
	}

	function build(){
	    //определили наполнение страницы
	    $sAction = $this->action;
	    $this->$sAction();

	    //Передаем массивы данных, которые были заданы через действие action,в ВИДЫ
        // и инициализируем их под именем, заданным в 1ом аргументе addData.

        //наполнила данными стараницу
        $this->view->addData('aHighMenu',$this->aHighMenu);
        $this->view->addData('aLowMenu',$this->aLowMenu);
        $this->view->addData('aContent',$this->aContent);
	    $this->view->addData('aLeftMenu',$this->aLeftMenu);

	    //сгенерировали страницу с данными
	    $this->view->generate();
    }
}
