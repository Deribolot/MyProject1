<?php
class News extends Object{
    protected $id;
    protected $name;
    protected $login_autor;
    public $data_create;
    public $text_news;
    public $verified_admin;
    public $rating;

    static  function TableName()
    {
        return 'news';
    }
    public function setId($value)
    {
        $this->id=$value;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setName($value)
    {
        $this->name=$value;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setLogin_autor($value)
    {
        $this->login_autor=$value;
    }
    public function getLogin_autor()
    {
        return $this->login_autor;
    }
}

