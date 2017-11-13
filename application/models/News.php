<?php
/**
 * Class News
 * @property string $name
 */
class News extends Messages
{
    //protected $name;

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

}

