<?php
/**
 * Class Relationships
 * @property int $id_news
 * @property int $id_categories
 */
class Relationships extends Object
{
    //protected $id_news;
    //protected $id_categories;

    static  function TableName()
    {
        return 'relationships';
    }
    static  function CheckUniqueness($params = [])
    {
        $class = get_called_class();
        $table = $class::TableName();
        $oQuery = Object::$db->prepare("SELECT * FROM {$table} WHERE id_news=:need_id_news AND id_category=:need_id_category");
        $oQuery->execute(['need_id_news' => $params['id_news'],'need_id_category' => $params['id_category']]);
        $aRes = $oQuery->fetchAll(PDO::FETCH_ASSOC);
        return $aRes? false:true;
    }
    static function CheckExistence($params = [])
    {
        return (Categories::findById($params['id_category'])&&News::findById($params['id_news']))? true:false;
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