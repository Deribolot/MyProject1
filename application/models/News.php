<?php
/**
 * Class News
 * @property string $name
 */
class News extends Messages
{
    //protected $name;

    static  function TableName()
    {
        return 'news';
    }
    static function CheckExistence($params = [])
    {
        return Users::findById($params['login_autor'])? true:false;
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

}

