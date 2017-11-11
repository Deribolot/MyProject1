<?php
 class Users extends Object{

    protected $login;
    protected $email;
    protected $user_password;
    protected $data_checkin;
    protected $admin_rights;
    protected $data_assumption;
    protected $locking;

    static  function TableName(){
         return 'users';
     }

     /**
      * @return string
      */
     public function getLogin()
     {
         return $this->getValueFromParams('login');
     }

     /**
      * @param string $login
      * @return $this
      */
     public function setLogin($login)
     {
         return $this->setValueForParam('login',$login);
     }
     /**
      * @return string
      */
     public function getEmail()
     {
         return $this->getValueFromParams('email');
     }

     /**
      * @param string $email
      * @return $this
      */
     public function setEmail($email)
     {
         return $this->setValueForParam('email',$email);
     }
     /**
      * @return int
      */
     public function getUser_password()
     {
         return $this->getValueFromParams('user_password');
     }

     /**
      * @param int $user_password
      * @return $this
      */
     public function setUser_password($user_password)
     {
         return $this->setValueForParam('user_password',$user_password);
     }
     /**
      * @return string
      */
     public function getData_checkin()
     {
         return $this->getValueFromParams('data_checkin');
     }

     /**
      * @param  string $data_checkin
      * @return $this
      */
     public function setData_checkin($data_checkin)
     {
         return $this->setValueForParam('data_checkin',$data_checkin);
     }
     /**
      * @return bool
      */
     public function getAdmin_rights()
     {
         return $this->getValueFromParams('admin_rights');
     }

     /**
      * @param  bool $admin_rights
      * @return $this
      */
     public function setAdmin_rights($admin_rights)
     {
         return $this->setValueForParam('admin_rights',$admin_rights);
     }
     /**
      * @return string
      */
     public function getData_assumption()
     {
         return $this->getValueFromParams('data_assumption');
     }

     /**
      * @param  string $data_assumption
      * @return $this
      */
     public function setData_assumption($data_assumption)
     {
         return $this->setValueForParam('data_assumption',$data_assumption);
     }
     /**
      * @return bool
      */
     public function getLocking()
     {
         return $this->getValueFromParams('locking');
     }

     /**
      * @param  bool $locking
      * @return $this
      */
     public function setLocking($locking)
     {
         return $this->setValueForParam('locking',$locking);
     }

     public static function findById($login){
         $class = get_called_class();
         $table = $class::TableName();
         $oQuery = Object::$db->prepare("SELECT * FROM {$table} WHERE login=:need_login");
         $oQuery->execute([ 'need_login' => $login]);
         $aRes = $oQuery->fetch(PDO::FETCH_ASSOC);
         return $aRes ? new $class($aRes) : null;
     }

     public static function deleteById($login){
         $class = get_called_class();
         $table = $class::TableName();
         if ($class::findById($login) ) {
             var_dump("Передан для удаления");
             $oQuery = Object::$db->prepare("DELETE FROM {$table} WHERE login=:need_login");
             $oQuery->execute(['need_login' => $login]);
             return !($class::findById($login))? true: false ;
         }
         else {
             var_dump("Записи с таким ключом не существует, поэтому ее нельзя удалить!");
             return false;
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
         if ((array_key_exists('login',$paramsForSave))&&(count($paramsForSave)==count($columnNames))) {
             if ($class::findById($paramsForSave['login']) ) {
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
         elseif ((!(array_key_exists('login',$paramsForSave)))&&(count($paramsForSave)==(count($columnNames)-1))) {
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
}
