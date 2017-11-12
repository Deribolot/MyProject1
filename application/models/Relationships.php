<?php

class Relationships extends Object
{
    protected $id_news;
    protected $id_categories;

    static  function TableName()
    {
        return 'comments';
    }
    /**
     * @param int $id_news
     * @return $this
     */
    public function setId_news($id_news)
    {
        return $this->setValueForParam('id_news',$id_news);
    }
    /**
     * @return int
     */
    public function getId_news()
    {
        return $this->getValueFromParams('id_news');
    }
    /**
     * @param int $id_categories
     * @return $this
     */
    public function setId_categories($id_categories)
    {
        return $this->setValueForParam('id_categories',$id_categories);
    }
    /**
     * @return int
     */
    public function getId_categories()
    {
        return $this->getValueFromParams('id_categories');
    }
}