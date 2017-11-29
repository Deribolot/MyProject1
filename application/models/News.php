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
                //$aCat = $this;
                //$class = get_called_class();
                /*$columnNames=$class::getColumnName();
                foreach ($columnNames as $column_name => $column_value) {
                    $aData["items"][] =  $column_value.': '.$aCat->$column_value ."</br>";
                }*/
                $aResult=$this->getResume($verified_admin,$mylittleuser);
                $aData["text"]=$aResult["text"];
                $aData["name"]=$aResult["name"];
                foreach ($aResult["sheet"] as $column_name => $column_value)
                {
                    $aData["sheet"][]=$column_value;
                    var_dump("$column_value");
                }
                $answer = explode('new', $_SERVER['REQUEST_URI']);
                $aData["back"] =  $answer[0];
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
            //$aCat = News::findList();
            if ($verified_admin === 1 or $verified_admin === 0) {
                //Это общие новости
                //Вывести одобренные/неодобренные новости о, у которых существуют добренные категории по соответ категории
                if (Users::findById($mylittleuser->login)->login) {
                    //авторизованный
                    if (Categories::findById($id_category)->id) {
                        $aData = ['title' => Categories::findById($id_category)->name];
                        //c категорией
                        $aCat = News::findList($verified_admin,$id_category);
                        foreach ($aCat as $oCategories) {
                            if ($verified_admin === 1) {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/main/' . $id_category . '?login=' . $mylittleuser->login . '&new=' . $oCategories->id];
                            } else {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/bad/' . $id_category . '?login=' . $mylittleuser->login . '&new=' . $oCategories->id];
                            }
                        }
                    } else {
                        $aCat = News::findList($verified_admin);
                        $aData = ['title' => ""];
                        //без категории
                        foreach ($aCat as $oCategories) {
                            if ($verified_admin === 1) {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/main?login=' . $mylittleuser->login. '&new=' . $oCategories->id];
                            } else {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/bad?login=' . $mylittleuser->login. '&new=' . $oCategories->id];
                            }
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
                            if ($verified_admin === 1) {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/main/' . $id_category . '?new=' . $oCategories->id];
                            } else {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/bad/' . $id_category . '?new=' . $oCategories->id];
                            }
                        }
                    } else {
                        $aCat = News::findList($verified_admin);
                        $aData = ['title' => ""];
                        //без категории
                        foreach ($aCat as $oCategories) {
                            if ($verified_admin === 1) {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/main?new=' . $oCategories->id];
                            } else {
                                $aData['items'][] = ['title' => $oCategories->name, 'href' => '/bad?new=' . $oCategories->id];
                            }
                        }
                    }
                }
            }
            else{
                //Это МОИ НОВОСТИ
                //вывести новости, в которых пользователь $mylittleuser писал новости, по соответ категории
                $aData['items'][] = ['title' => 'sdjhfeshfsjfjs' ];
                var_dump("СЕЙЧАС категория $this->id");
            }
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

        if ($verified_admin === 1 or $verified_admin === 0) {
            //Вывести одобренные/неодобренные новости  по соответ категории
            if ($id_category===null)
            {
                //Вывести одобренные/неодобренные все новости
                $oQuery = self::$db->prepare("SELECT news.* FROM news
INNER JOIN relationships ON id_news= news.id
INNER JOIN categories ON id_category= categories.id
WHERE categories.verified_admin=1 AND news.verified_admin=:need_verified_admin");
                $oQuery->execute(['need_verified_admin' => $verified_admin]);
            }
            else
            {
                //Вывести одобренные/неодобренные новости по соответ категории
                $oQuery = self::$db->prepare("SELECT news.* FROM news
INNER JOIN relationships ON id_news= news.id
INNER JOIN categories ON id_category= categories.id
WHERE categories.verified_admin=1 AND news.verified_admin=:need_verified_admin AND categories.id=:need_id_category");
                $oQuery->execute(['need_verified_admin' => $verified_admin,'need_id_category' => $id_category]);

            }
            $oQuery->execute();
            $aRes = [];
            foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                $aRes[] = new News($aValues);

        }
        else{
            //Вывести категории, в которых писал $mylittleuser для моих новостей
            $aRes = [];

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
        INNER JOIN categories ON id_category= categories.id
        WHERE categories.verified_admin=1");
        $oQuery->execute(['need_id_news' => $this->id]);
        $oQuery->execute();
        $aRes = "";
        foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
            $aRes .= ((new Categories($aValues))->name) . ", ";
        $aRes=substr ( $aRes, 0 , strlen ( $aRes)-2);
        $stringNames["sheet"][] = "в категории(иях) ".$aRes."</br>";
        if ($mylittleuser===null){
            //не авторизован
            if ($verified_admin===1){
                //новости общие
                $stringNames["sheet"][] = "пользователем ".$this->login_autor."</br>";
            }
            else{
                var_dump("У Вас нет таких прав, и я Вам ничего не должен!");
            }
        }
        else{

            if (($mylittleuser->admin_rights)===1){
                //админ
                $stringNames["sheet"][] = "с id ".$this->id."</br>";
                if ($verified_admin===1){
                    //новости общие
                    $stringNames["sheet"][] = "пользователем ".$this->login_autor."</br>";
                }
                else{
                    if ($verified_admin===0){
                        //новости неодобренные
                        $stringNames["sheet"][] = "пользователем ".$this->login_autor."</br>";
                    }
                    else{
                        //мои новости
                        $stringNames["sheet"][] = "статус новости ".(($this->verified_admin===0)?"не проверена":"проверена")."</br>";
                    }
                }
            }
            else{
                //пользователь
                if ($verified_admin===1){
                    //новости общие
                    $stringNames["sheet"][] = "пользователем ".$this->login_autor."</br>";
                }
                else{
                    if ($verified_admin===0){
                        //новости неодобренные
                        var_dump("У Вас нет таких прав, и я Вам ничего не должен!");
                    }
                    else{
                        //мои новости
                        $stringNames["sheet"][] = "статус новости ".(($this->verified_admin===0)?"не проверена":"проверена")."</br>";
                    }
                }
            }
        }
        return $stringNames;
    }

}

