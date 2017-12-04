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
            ($verified_admin === 1)? $word="main":$word="bad";
            //Это общие новости
            //Вывести одобренные категории, у которых существуют одобренные/неодобренные новости
            $aCat = Categories::findList($verified_admin);
            if (Users::findById($mylittleuser->login)->login) {
                //авторизованный
                foreach ($aCat as $oCategories) {
                    $aData['items'][] = ['title' => $oCategories->name, 'href' => '/'.$word.'/' . $oCategories->id . '?login=' . $mylittleuser->login];
                }
            }
            else{
                //неавторизованный
                foreach ($aCat as $oCategories) {
                    $aData['items'][] = ['title' => $oCategories->name, 'href' => '/'.$word.'/' . $oCategories->id ];
                }
            }
        }
        else{
            //Это МОИ НОВОСТИ
            //вывести категории, в которых пользователь $mylittleuser писал новости

            if (Users::findById($mylittleuser->login)->login) {
                $aCat = Categories::findList($verified_admin,$mylittleuser);
                //авторизованный
                foreach ($aCat as $oCategories) {
                    $aData['items'][] = ['title' => $oCategories->name, 'href' => '/my/' . $oCategories->id . '?login=' . $mylittleuser->login];
                }
            }
            else{
                //неавторизованный
                var_dump("Нет Ваших новостей");
            }
        }
        if ($aCat==[])  {$aData = ['title' => 'Нет подходящих категорий'];$aData['items'] = [];}
        return $aData;
    }
    // создает список категорий
    /**
     * @param $mylittleuser
     * @param $verified_admin
     * @return array
     */
    static function findList($verified_admin,$mylittleuser=null){
        $aRes = [];
        if ($verified_admin === 1 or $verified_admin === 0) {
            //Вывести одобренные категории, у которых существуют одобренные/неодобренные новости
            $oQuery = self::$db->prepare("SELECT DISTINCT  categories.* FROM  categories
            INNER JOIN relationships on  categories.id = id_category 
            INNER JOIN news on news.id = id_news
            WHERE news.verified_admin=:need_verified_admin AND  categories.verified_admin=1 ");

            $oQuery->execute(['need_verified_admin' => $verified_admin]);
            $oQuery->execute();
            foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                $aRes[] = new Categories($aValues);
        }
        else{
            //Вывести категории, в которых писал $mylittleuser для моих новостей
            if (Users::findById($mylittleuser->login)->login) {
                $oQuery = self::$db->prepare("SELECT DISTINCT  categories.* FROM  categories
                INNER JOIN relationships on  categories.id = id_category 
                INNER JOIN news on news.id = id_news
                WHERE news.login_autor=:need_login ");
                $oQuery->execute(['need_login' => Users::findById($mylittleuser->login)->login]);
                $oQuery->execute();
                foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                    $aRes[] = new Categories($aValues);
            }else{
                //выдать все
                $oQuery = self::$db->prepare("SELECT DISTINCT  * FROM  categories");
                $oQuery->execute();
                foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                    $aRes[] = new Categories($aValues);
            }

        }
        return $aRes;
    }
    static function getList ($mylittleuser,$verified_admin){
        $aData=[];
        $aData['title']="";
        if (Users::findById($mylittleuser->login)->admin_rights==1) {
            if($verified_admin === 1 or $verified_admin === 0){
                $aData['title']=($verified_admin === 1) ? "Одобренные":"Неодобренные";
                $oQuery = self::$db->prepare("SELECT DISTINCT  * FROM  categories
                    WHERE categories.verified_admin=:need_verified_admin ");
                $oQuery->execute(['need_verified_admin' => $verified_admin]);
                $oQuery->execute();
                foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                    $aRes[] = new Categories($aValues);
            }
            else{
                //выдать все
                $oQuery = self::$db->prepare("SELECT DISTINCT  * FROM  categories");
                $oQuery->execute();
                foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                    $aRes[] = new Categories($aValues);
            }
            foreach ($aRes as $oCategories) {
                (Categories::findById($oCategories->id)->verified_admin==0)? $string= ['delete','set']:$string= ['delete'];
                $aData['items'][] = ['title' => $oCategories->name,'buttons'=>$string,'back'=>Object::deleteEndURL('func').'','id'=> $oCategories->id];
            }
            if(count($aRes)<1) {$aData['title']="Нет подходящих категорий";$aData['items']=[];}
        }
        else {
            var_dump("У Вас нет таких прав, и я Вам ничего не должен!");
        }
        return $aData;
    }
}