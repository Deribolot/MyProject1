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
        $aData = ['title' => $this->name? :""];
        if ($this->id) {//верни новость и нормальную ссылку ?НАЗАД
            if (News::findById($this->id)){
                $aData = ['title' => News::findById($id_category)->name];
                $aCat = $this;
                foreach ($aCat as $oCategories) {
                    if ($verified_admin === 1) {
                        $aData['items'][] = ['title' => $oCategories];
                    } else {
                        $aData['items'][] = ['title' => $oCategories];
                    }
                }
                /*if ($verified_admin === 1 or $verified_admin === 0) {
                    //Это общие новости
                    if (Users::findById($mylittleuser->login)->login) {
                        //авторизованный
                        if (Categories::findById($id_category)->id) {
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

}

