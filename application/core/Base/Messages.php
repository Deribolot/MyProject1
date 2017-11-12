<?php

class Messages extends Object
{
    protected $id;
    protected $login_autor;
    protected $data_create;
    protected $text;
    protected $verified_admin;
    protected $rating;

    static  function TableName()
    {
        return 'messages';
    }
    /**
     * @param string $login_autor
     * @return $this
     */
    public function setLogin_autor($login_autor)
    {
        return $this->setValueForParam('login_autor',$login_autor);
    }
    /**
     * @return string
     */
    public function getLogin_autor()
    {
        return $this->getValueFromParams('login_autor');
    }
    /**
     * @param string $data_create
     * @return $this
     */
    public function setData_creater($data_create)
    {
        return $this->setValueForParam('data_create',$data_create);
    }
    /**
     * @return string
     */
    public function getData_create()
    {
        return $this->getValueFromParams('data_create');
    }
    /**
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        return $this->setValueForParam('text',$text);
    }
    /**
     * @return string
     */
    public function getText()
    {
        return $this->getValueFromParams('text');
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
    /**
     * @param int $rating
     * @return $this
     */
    public function setRating($rating)
    {
        return $this->setValueForParam('rating',$rating);
    }
    /**
     * @return int
     */
    public function getRating()
    {
        return $this->getValueFromParams('rating');
    }



}