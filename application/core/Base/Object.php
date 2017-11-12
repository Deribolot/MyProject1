<?php
/**
 * Class Object
 * @property $id
 */
abstract class Object
{
    /** @var  PDO */
    static $db;

    private $aParams =[];

    protected function getValueFromParams($param){
        return isset($this->aParams[$param])? $this->aParams[$param] : null;
    }

    /**
     * @param $param
     * @param $value
     * @return $this
     */
    protected function setValueForParam($param,$value){
        $this->aParams[$param] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->getValueFromParams('id');
    }

    /**
     * @param mixed $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setValueForParam('id',$id);
    }

    public function __construct( $params = [])
    {
        $className = get_called_class();
        foreach ($params as $param_name => $param_value){
            //содержит ли объект или класс указанный атрибут
            if (property_exists($className, $param_name ))
                $this->$param_name = $param_value;
            elseif(method_exists($this,'set'.ucfirst($param_name) )){
                $name = 'set'.ucfirst($param_name);
                $this->$name($param_value);
            }

        }
    }

    //получить значение параметра $name
    public function __get($name)
    {
        //ucfirst - с большой буквы $name
        $sFuncName = 'get' . ucfirst($name);
        //содержит ли объект или класс указанный метод
        if (method_exists($this, $sFuncName))
        {
            return $this->$sFuncName();
        }
        return null;
    }

    //присвоить значение параметра $name
    public function __set($name, $value)
    {
        //ucfirst - с большой буквы $name
        $sFuncName = 'set' . ucfirst($name);
        //содержит ли объект или класс указанный метод
        if (method_exists($this, $sFuncName))
        {
            return $this->$sFuncName($value);
        }
        return null;
    }

    abstract static function TableName();

    /**
     * @param integer $id
     * @return $this|null
     */
    public static function findById($id){

        /** @var Object $class */
        $class = get_called_class();
        $table = $class::TableName();
        // запустить подготовленный запрос на выполнение
        $oQuery = Object::$db->prepare("SELECT * FROM {$table} WHERE id=:need_id");
        $oQuery->execute(['need_id' => $id]);
        //извлечь следующую строку из результирующего набора
        //PDO::FETCH_ASSOC возвращает следующую строку в виде массива, индексированного именами столбцов
        $aRes = $oQuery->fetch(PDO::FETCH_ASSOC);
        return $aRes? new $class($aRes):null;
    }

    /**
     * @return mixed $columnNames|null
     */
    public static function getColumnName()
    {
        try {
            $class = get_called_class();
            $table = $class::TableName();
            $oQuery = Object::$db->prepare("SHOW COLUMNS FROM {$table}");
            $oQuery->execute();
            $data = $oQuery->fetchAll();
            $count = count($data);
            $i = 0;
            while ($i < $count) {
                $columnNames[] = $data[$i]["Field"];
                $i++;
            }
            return $columnNames;
        }catch (PDOException $e) {
            var_dump("Ошибка при получении имен колонок таблицы");
            return null;
        }
    }

    //сохранение записи
    public static function saveRecord($params = [])
    {
        //Если в $params будут элементы одинаковыми ключами, то сохранится последнее
        $class = get_called_class();
        $table = $class::TableName();
        $columnNames=$class::getColumnName();
        //Убираем левые параметры
        foreach ($params as $param_name => $param_value) {
            foreach ($columnNames as $column_name => $column_value) {
                if ($column_value == $param_name) {
                        //массив из принятых параметров с ключами - (столбцами таблицы)
                        $paramsForSave[$column_value] =  $param_value;
                } 
            }
        }
        if ((array_key_exists('id',$paramsForSave))&&(count($paramsForSave)==count($columnNames))) {
            if ($class::findById($paramsForSave['id']) ) {
                //Если уникальные поля не совпадают с уникальными полями  других картежей
                //проверка на существование кортежей, на которые делаются ссылки
                var_dump(" Передан для обновления");
                return $class::updateRecord($paramsForSave);
            }
            else {
                var_dump("Записи с таким ключом не существует! В обновлении отказать!");
                return false;
            }
        }
        elseif ((!(array_key_exists('id',$paramsForSave)))&&(count($paramsForSave)==(count($columnNames)-1))) {
            //Если уникальные поля не существуют
            //проверка на существование кортежей, на которые делаются ссылки
            var_dump(" Передан для добавления");
            return $class::addRecord($paramsForSave);
        }
        else {
            var_dump(" Данные для сохранения неполные или неверные!");
            return false;
        }
    }

    //сохранение через обновление
    protected static function updateRecord($params = [])
    {
        try {
            $str="";
            $class = get_called_class();
            $table = $class::TableName();
            $columns = implode(', ', array_keys($params));
            $values = "'" . implode("', '", array_values($params)) . "'";
            foreach (array_keys($params) as $column_name => $column_value)
            {
                ($column_name !=0)?
                    $str= $str.$column_value."='".(array_values($params)[$column_name])."'":
                    $str= "";
                (($column_name !=0)&&($column_name !=(count(array_keys($params))-1)))? $str= $str.", ":$str= $str;
            }
            $oQuery = Object::$db->prepare("UPDATE {$table} SET  {$str} WHERE id=:need_id");
            $oQuery->execute(['need_id' => ($params[id])]);
            return true;
        }catch (PDOException $e) {
            var_dump("Ошибка при обновлении");
            return false;
        }
    }
    //сохранение через добавление
    protected static function addRecord($params = [])
    {
        try {
            $class = get_called_class();
            $table = $class::TableName();
            $columns = implode(', ', array_keys($params));
            $values = "'" . implode("', '", array_values($params)) . "'";
            $oQuery = Object::$db->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
            $oQuery->execute();
            return true;
        }catch (PDOException $e) {
            var_dump("Ошибка при добавлении");
            return false;
        }
    }
    //удаление записи
    public static function deleteById($id){

        /** @var Object $class */
        $class = get_called_class();
        $table = $class::TableName();
        if ($class::findById($id) ) {
            var_dump("Передан для удаления");
            $oQuery = Object::$db->prepare("DELETE FROM {$table} WHERE id=:need_id");
            $oQuery->execute(['need_id' => $id]);
            return !($class::findById($id))? true: false ;
        }
        else {
            var_dump("Записи с таким ключом не существует, поэтому ее нельзя удалить!");
            return false;
        }
    }
}

