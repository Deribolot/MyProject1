<?php
/**
 * Class Comments
 * @property int $id_news
 */
class Comments extends Messages
{
    //protected $id_news;

    static  function TableName()
    {
        return 'comments';
    }
    static  function CheckUniqueness()
    {
        return true;
    }
    static function CheckExistence($params = [])
    {
        return (Users::findById($params['login_autor'])&&News::findById($params['id_news']))? true:false;
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
}