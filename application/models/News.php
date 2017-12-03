<?php
/**
 * Class News
 * @property string $name
 */
class News extends Messages implements iContentNews
{
    static  function TableName(){
        return 'news';
    }

    static function CheckExistence($params = []){
        if (Users::findById($params['login_autor'])){
            $aRes=Users::findById($params['login_autor']);
            if ($aRes->locking){
                var_dump("Данный пользователь забанен!</br>");
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name){
        return $this->setValueForParam('name',$name);
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->getValueFromParams('name');
    }

    //для контента из новостей
    /**
     * @param $mylittleuser
     * @param $verified_admin
     * @param $id_category
     * @return array
     */
    function getData($mylittleuser,$verified_admin,$id_category){

        //$mylittleuser - объкт Users, авторизованный пользователь
        //$verified_admin - состояние проверки новости, 0 - не проверена, 1 - проверена
        //$id_category - категория новости
        $aData = ['title' => ""];
        if ($this->id) {//верни новость и нормальную ссылку ?НАЗАД
            if (News::findById($this->id)){
                $aResult=$this->getResume($verified_admin,$mylittleuser);
                $aData=['mytext'=>$aResult["text"] ];
                $aData["myname"]=$aResult["name"];
                foreach ($aResult["sheet"] as $column_name => $column_value)
                {
                    $aData["sheet"][]=$column_value;
                    //var_dump("$column_value");
                }
                foreach ($aResult["buttons"] as $column_name => $column_value)
                {
                   $aData["buttons"][$column_name]= $column_value;
                   //var_dump("приает");var_dump("$column_name => $column_value");
                }
                $aData["back"] = Object::deleteEndURL( 'new');;
                /*foreach ($aData["items"] as $column_name => $column_value)
                {
                    var_dump("$column_value");
                }*/
            }
            else
            {
                $aData = ['title' =>"Новость не найдена"];
            }

        }
        else{
            //верни список и нормальные ссылки на конкретные новости
            if ($verified_admin === 1 or $verified_admin === 0) {
                ($verified_admin === 1)? $word="main":$word="bad";
                //Это общие новости
                //Вывести одобренные/неодобренные новости о, у которых существуют добренные категории по соответ категории
                if (Users::findById($mylittleuser->login)->login) {
                    //авторизованный
                    if (Categories::findById($id_category)->id) {
                        $aData = ['title' => Categories::findById($id_category)->name];
                        //c категорией
                        $aCat = News::findList($verified_admin,$id_category);
                        foreach ($aCat as $oCategories) {
                            $aData['items'][] = ['title' => $oCategories->name, 'href' => '/'.$word.'/' . $id_category . '?login=' . $mylittleuser->login . '&new=' . $oCategories->id];
                        }
                    } else {
                        $aCat = News::findList($verified_admin);
                        $aData = ['title' => ""];
                        //без категории
                        foreach ($aCat as $oCategories) {
                            $aData['items'][] = ['title' => $oCategories->name, 'href' => '/'.$word.'?login=' . $mylittleuser->login. '&new=' . $oCategories->id];
                        }
                    }
                }
                else{
                    //неавторизованный
                    if (Categories::findById($id_category)->id) {
                        $aData = ['title' => Categories::findById($id_category)->name];
                        $aCat = News::findList($verified_admin,$id_category);
                        //c категорией
                        foreach ($aCat as $oCategories) {
                            $aData['items'][] = ['title' => $oCategories->name, 'href' => '/'.$word.'/' . $id_category . '?new=' . $oCategories->id];
                        }
                    } else {
                        $aCat = News::findList($verified_admin);
                        $aData = ['title' => ""];
                        //без категории
                        foreach ($aCat as $oCategories) {
                            $aData['items'][] = ['title' => $oCategories->name, 'href' => '/'.$word.'?new=' . $oCategories->id];

                        }
                    }
                }
            }
            else{
                //Это МОИ НОВОСТИ
                //вывести новости, в которых пользователь $mylittleuser писал новости, по соответ категории
                if (Users::findById($mylittleuser->login)->login) {
                    if (Categories::findById($id_category)->id) {
                        $aData = ['title' => Categories::findById($id_category)->name];
                        //c категорией
                        $aCat = News::findList($verified_admin,$id_category,$mylittleuser);
                        foreach ($aCat as $oCategories) {
                            $aData['items'][] = ['title' => $oCategories->name, 'href' => '/my/' . $id_category . '?login=' . $mylittleuser->login . '&new=' . $oCategories->id];

                        }
                    } else {
                        //без категории
                        $aCat = News::findList($verified_admin,null,$mylittleuser);
                        $aData = ['title' => ""];
                        //без категории
                        foreach ($aCat as $oCategories) {
                            $aData['items'][] = ['title' => $oCategories->name, 'href' => '/my?login=' . $mylittleuser->login. '&new=' . $oCategories->id];
                        }
                    }
                }
                else{
                    //неавторизованный
                    var_dump("Нет Ваших новостей");
                }
            }
            if ($aCat==[])  {$aData = ['title' => 'Нет подходящих новостей'];$aData['items'] = [];}
        }

        return $aData;
    }
    // создает список новостей
    /**

     * @param $verified_admin
     * @param $id_category
     * @param $mylittleuser
     * @return array
     */
    static function findList($verified_admin,$id_category=null,$mylittleuser=null){
        $aRes = [];
        if ($verified_admin === 1 or $verified_admin === 0) {
            //Вывести одобренные/неодобренные новости  по соответ категории
            if ($id_category===null)
            {
                //Вывести одобренные/неодобренные все новости
                $oQuery = self::$db->prepare("SELECT DISTINCT news.* FROM news
INNER JOIN relationships ON id_news= news.id
INNER JOIN categories ON id_category= categories.id
WHERE  news.verified_admin=:need_verified_admin AND categories.verified_admin=1
UNION ALL 
SELECT DISTINCT news.* FROM news
WHERE news.id not in (select relationships.id_news from relationships) AND  news.verified_admin=:need_verified_admin
");
                $oQuery->execute(['need_verified_admin' => $verified_admin]);
                $oQuery->execute();
                foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                    $aRes[] = new News($aValues);
            }
            else
            {
                //Вывести одобренные/неодобренные новости по соответ категории
                $oQuery = self::$db->prepare("SELECT news.* FROM news
INNER JOIN relationships ON id_news= news.id
INNER JOIN categories ON id_category= categories.id
WHERE categories.verified_admin=1 AND news.verified_admin=:need_verified_admin AND categories.id=:need_id_category");
                $oQuery->execute(['need_verified_admin' => $verified_admin,'need_id_category' => $id_category]);
                $oQuery->execute();
                foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                    $aRes[] = new News($aValues);

            }
        }
        else{
            //Вывести категории, в которых писал $mylittleuser для моих новостей
            if (Users::findById($mylittleuser->login)->login) {
                if ($id_category === null) {
                    //Вывести мои новости
                    $oQuery = self::$db->prepare("SELECT DISTINCT news.* FROM news
INNER JOIN relationships ON id_news= news.id
INNER JOIN categories ON id_category= categories.id
WHERE  news.login_autor=:need_login AND categories.verified_admin=1
UNION ALL 
SELECT DISTINCT news.* FROM news
WHERE news.id not in (select relationships.id_news from relationships) AND  news.login_autor=:need_login");
                    $oQuery->execute(['need_login' => Users::findById($mylittleuser->login)->login]);
                    $oQuery->execute();
                    foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                        $aRes[] = new News($aValues);
                } else {
                    //Вывести мои по соответ категории
                    $oQuery = self::$db->prepare("SELECT news.* FROM news
INNER JOIN relationships ON id_news= news.id
INNER JOIN categories ON id_category= categories.id
WHERE  news.login_autor=:need_login AND categories.id=:need_id_category");
                    $oQuery->execute(['need_login' => Users::findById($mylittleuser->login)->login, 'need_id_category' => $id_category]);
                    $oQuery->execute();
                    foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                        $aRes[] = new News($aValues);
                }
            }
            else
            {
                //выдать все
                $oQuery = self::$db->prepare("SELECT news.* FROM news");
                $oQuery->execute();
                foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                    $aRes[] = new News($aValues);
            }
        }
        return $aRes;
    }

    //какие данные вывести
    function getResume($verified_admin,$mylittleuser=null)
    {
        $stringNames = [];
        $stringNames["name"] = $this->name . "</br>";

        $stringNames["text"] = $this->text . "</br>";
        $mydate = explode(' ', $this->data_create);
        $stringNames["sheet"][] = "новость оставлена " . $mydate[0] . " в " . $mydate[1] . "</br>";
        $oQuery = self::$db->prepare("SELECT DISTINCT categories.* FROM news
        INNER JOIN relationships ON id_news=:need_id_news
        INNER JOIN categories ON id_category= categories.id");
        $oQuery->execute(['need_id_news' => $this->id]);
        $oQuery->execute();
        $aRes = "";
        foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues) {
            $v_a=((new Categories($aValues))->verified_admin==1)? '':' (неодобренной)';
            $aRes .= ((new Categories($aValues))->name) .$v_a.', ';
        }
        $aRes=substr ( $aRes, 0 , strlen ( $aRes)-2);
        if ($aRes) $stringNames["sheet"][] = "в категории(иях): ".$aRes."</br>";

        $stringNames["buttons"]=[];

        if ($mylittleuser==null){
            //не авторизован
            if ($verified_admin===1){
                //новости общие
                $stringNames["sheet"][] = 'пользователем '.$this->login_autor. (Users::findById($this->login_autor)->locking==0?'':', который забанен'). '</br>';
            }
            else{
                var_dump("У Вас нет таких прав, и я Вам ничего не должен!");
            }
        }
        else{
            $adress=Object::deleteEndURL( 'new');
            //var_dump("права $mylittleuser->admin_rights");
            if (($mylittleuser->admin_rights)==1){
                //админ
                //ВЫКИНУТЬ В МЕНЮ
                $stringNames["sheet"][] = "с id ".$this->id."</br>";
                if ($verified_admin===1){
                    //новости общие
                    $stringNames["sheet"][] = 'пользователем '.$this->login_autor. (Users::findById($this->login_autor)->locking==0?'':', который забанен'). '</br>';
                    $stringNames["buttons"]["delete"] = $adress.'&func='.$this->id.'delete';
                }
                else{
                    if ($verified_admin===0){
                        //новости неодобренные
                        $stringNames["sheet"][] = 'пользователем '.$this->login_autor. (Users::findById($this->login_autor)->locking==0?'':', который забанен'). '</br>';
                        $stringNames["buttons"]= ["delete" =>$adress.'&func='.$this->id.'delete',"set" => $adress.'&func='.$this->id.'set'];

                    }
                    else{
                        //мои новости
                        $stringNames["sheet"][] = "ее статус - ".(($this->verified_admin==0)?"не проверена":"проверена")." админом</br>";
                        $stringNames["buttons"]["delete"] = $adress.'&func='.$this->id.'delete';
                        //проверка одобренных
                        if (News::findById($this->id)->verified_admin==0)$stringNames["buttons"]["set"] = $adress.'&func='.$this->id.'set';


                    }
                }
            }
            else{
                //пользователь
                if ($verified_admin===1){
                    //новости общие
                    $stringNames["sheet"][] = 'пользователем '.$this->login_autor. (Users::findById($this->login_autor)->locking==0?'':', который забанен'). '</br>';
                    if (News::findById($this->id)->login_autor==$mylittleuser->login) $stringNames["buttons"]["delete"] = $adress.'&func='.$this->id.'delete';
                }
                else{
                    if ($verified_admin===0){
                        //новости неодобренные
                        var_dump("У Вас нет таких прав, и я Вам ничего не должен!");
                    }
                    else{
                        //мои новости
                        $stringNames["sheet"][] = "ее статус - ".(($this->verified_admin==0)?"не проверена":"проверена")." админом</br>";
                        $stringNames["buttons"]["delete"] = $adress.'&func='.$this->id.'delete';
                    }
                }
            }
        }
        return $stringNames;
    }


    /**
     * @param $mylittleuser
     * @param $message
     * @return array
     */
     function getForm ($mylittleuser,$message){
         $aData["message"]=$message;
         if ($mylittleuser==null) {
             $aData["login"]="";
         } else{
             $aData["login"]=$mylittleuser->login;
             $aData["categories"]=Categories::findList(null,null);
         }
        return $aData;
    }

}

