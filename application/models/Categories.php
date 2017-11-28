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
        //$mylittleuser - объкт Users, авторизованный пользователь
        //$verified_admin - состояние проверки новости, 0 - не проверена, 1 - проверена

        $aData = ['title' => 'Категории'];
        $aData['items'] = [];
        if ($verified_admin === 1 or $verified_admin === 0) {
            var_dump("СЕЙЧАС категория rtgthexthexthtt");
            //Это общие новости
            //Вывести одобренные категории, у которых существуют одобренные/неодобренные новости
            $aCat = Categories::findList($verified_admin);
            if (Users::findById($mylittleuser->login)->login) {
                //авторизованный
                foreach ($aCat as $oCategories) {
                    if ($verified_admin === 1) {
                        $aData['items'][] = ['title' => $oCategories->name, 'href' => '/main/' . $oCategories->id . '?login=' . $mylittleuser->login];
                    } else {
                        $aData['items'][] = ['title' => $oCategories->name, 'href' => '/bad/' . $oCategories->id . '?login=' . $mylittleuser->login];
                    }
                }
            }
            else{
                //неавторизованный
                foreach ($aCat as $oCategories) {
                    if ($verified_admin === 1) {
                        $aData['items'][] = ['title' => $oCategories->name, 'href' => '/main/' . $oCategories->id ];
                    }else {
                        $aData['items'][] = ['title' => $oCategories->name, 'href' => '/bad/' . $oCategories->id ];
                    }
                }
            }
        }
        else{
            //Это МОИ НОВОСТИ
            //вывести категории, в которых пользователь $mylittleuser писал новости
            $aData['items'][] = ['title' => 'sdjhfeshfsjfjs' ];
            var_dump("СЕЙЧАС категория $this->id");
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

        if ($verified_admin === 1 or $verified_admin === 0) {
            //Вывести одобренные категории, у которых существуют одобренные/неодобренные новости
            $oQuery = self::$db->prepare("SELECT DISTINCT  categories.* FROM  categories
            INNER JOIN relationships on  categories.id = id_category 
            INNER JOIN news on news.id = id_news
            WHERE news.verified_admin=:need_verified_admin AND  categories.verified_admin=1 ");
            $oQuery->execute(['need_verified_admin' => $verified_admin]);
            $oQuery->execute();
            $aRes = [];
            foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                $aRes[] = new Categories($aValues);

        }
        else{
            //Вывести категории, в которых писал $mylittleuser для моих новостей
            $aRes = [];

        }
        return $aRes;
    }
}