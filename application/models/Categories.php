<?php

/**
 * Class Categories
 * @property string $name
 * @property bool $verified_admin;
 */
class Categories extends Object
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

}