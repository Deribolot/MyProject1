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
        if (Users::findById($params['login_autor'])&& News::findById($params['id_news'])){

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