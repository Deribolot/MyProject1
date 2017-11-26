<?php

/**
 * Class Categories
 * @property string $name
 * @property bool $verified_admin;
 */
class Categories extends Object implements iMenu
{
    //protected $name;
    //protected $verified_admin;

    static  function TableName()
    {
        return 'categories';
    }
    static function CheckExistence($params = [])
    {
        return true;
    }
    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setValueForParam('name',$name);
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->getValueFromParams('name');
    }
    /**
     * @param bool $verified_admin
     * @return $this
     */
    public function setVerified_admin($verified_admin)
    {
        return $this->setValueForParam('verified_admin',$verified_admin);
    }
    /**
     * @return bool
     */
    public function getVerified_admin()
    {
        return $this->getValueFromParams('verified_admin');
    }

    //для левого меню с категориями создает список категорий и выкидывает его
    /**
     * @param $mylittleuser
     * @param $verified_admin
     * @return array
     */
    function getData($mylittleuser,$verified_admin)
    {
        if ($mylittleuser)
            //Это МОИ НОВОСТИ
            //вывести категории, в которых пользователь $mylittleuser писал новости
            return null;
        else {
            if ($verified_admin === 1 or $verified_admin === 0) {
                //Это общие новости
                //Вывести одобренные категории, у которых существуют одобренные/неодобренные новости
                $aCat = Categories::findList($verified_admin);
            } else {
                var_dump("Ошибка при определении типа новости");
                return null;
            }
        }
        $aData = ['title' => $this->name? :'Категории'];

        $aData['items'] = [];
        foreach ($aCat as $oCategories)
            $aData['items'][] = ['title'=>$oCategories->name, 'href' => '/catalog/'.$oCategories->id];

        if ($aData['items']){
            $aData['items'][0]['class'] = 'first';
            $aData['items'][count($aData['items'])-1]['class'] = 'last';
        }

        return $aData;
    }
    // создает список категорий
    /**
     * @param $mylittleuser
     * @param $verified_admin
     * @return array
     */
    static function findList($verified_admin,$mylittleuser=null){

        if (!$mylittleuser ) {
            //Вывести одобренные категории, у которых существуют одобренные/неодобренные новости
            $oQuery = self::$db->prepare("SELECT * FROM " . self::TableName() . " WHERE verified_admin=:need_verified_admin");
            $oQuery->execute(['need_verified_admin' => $verified_admin]);
            $oQuery->execute();
            $aRes = [];
            foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                $aRes[] = new Categories($aValues);

        }
        else{
            //Вывести категории, в которых писал $mylittleuser
            $aRes = [];

        }
        return $aRes;
    }
}