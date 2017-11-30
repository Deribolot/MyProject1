<?php

abstract class Controller {

    protected $action;
    protected $mylittleuser;

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

		if (isset($_GET['login']) & !empty($_GET['login'])) {
            $login =   $_GET['login'];
            if (Users::findById($login)){
                $this->mylittleuser=Users::findById($login);
                if(!$this->mylittleuser->locking) {
                    if ($this->mylittleuser->admin_rights) {
                        var_dump("Админ");
                    } else {
                        var_dump("Пользователь");
                    }
                }
                else
                {
                    var_dump("Заблокирован");
                    $this->mylittleuser=null;
                }

            }
            else
            {
                var_dump("Общий доступ");
                $this->mylittleuser=null;
            }
        }
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
?>
