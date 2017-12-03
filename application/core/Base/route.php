<?php

/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{
	private $aRouts = [

	];

	static function start()
	{
        //Переменная $_SERVER  --  это массив, содержащий информацию, такую как заголовки, пути и местоположения скриптов.
        //'REQUEST_URI'  --  это URI, который был передан для того, чтобы получить доступ к этой странице. Например, '/index.html'.
        /*explode -- Разбивает строку с помощью разделителя '/'*/
        $answer = explode('?', $_SERVER['REQUEST_URI']);
        $routes = explode('/', $answer[0]);

        /*example.ru/contacts/feedback
        routes[1] --  это контроллер contacts
        routes[2] --  это имя действия feedback*/

		// unset -- разрушает переменные
		unset($routes[0]);

		//ОПРЕДЕЛЕНИЕ КОНТРОЛЛЕРА
		//isset -- определяет, установлена ли переменная
		if ( isset($routes[1]) && ($routes[1]) )
		    //ucfirst --  преобразует первый символ строки в верхний регистр
			$sControllerClass = ucfirst($routes[1].'Controller');
		else
			$sControllerClass = 'MainController';
        unset($routes[1]);

		if (class_exists($sControllerClass))
			$oController = new $sControllerClass($routes);
		else
			$oController = new Page404($routes);

        //запускаем действие этого контроллера + добавляем виды
        $oController->build();
	}
	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
