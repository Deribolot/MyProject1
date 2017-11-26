<?php
class Bootstrap{

    private $aConfig;

    function __construct($aConfig)
    {
        //шаг 1-- $aConfig = ['core','controllers','models']
        $this->aConfig = $aConfig;
    }

    private function load($Dir){
        /** @var FilesystemIterator[] $oDirectory */
        //например, $Dir = __DIR__/core

        /* конструктор new FilesystemIterator($Dir)
        создает новый объект итератора файловой системы на основе $Dir
        $Dir - путь к объекту файловой системы, по которому требуется навигация*/
        $oDirectory = new FilesystemIterator($Dir);

        foreach ($oDirectory as $oElem){
            //bool is_dir ( string filename ) возвращает TRUE, если файл существует и является директорией.
            if ($oElem->isDir())
                $this->load($Dir.'/'.$oElem->getFilename());
            else
                require_once ($Dir.'/'.$oElem->getFilename());
            //Позволяет пройти по пути из папок и подкючить файл
        }
    }

    function start(){
        //шаг 2--
        foreach ($this->aConfig as $sDir){
            //т.е. запуск метода load 3 раза для 'core','controllers','models'
            /*__DIR__ 	Директория файла.
            Если используется внутри подключаемого файла, то возвращается директория этого файла.
            Возвращаемое имя директории не оканчивается на слеш, за исключением корневой директории. */
            //Т.е. __DIR__вернет 3 пути до $sDir
            $this->load(__DIR__.'/'.$sDir);
        }

        require_once 'DBConnect.php';
    }
}

