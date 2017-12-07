<?php
/**
 * Class Users
 * @property  string $login
 * @property  string $email
 * @property  string $user_password
 * @property  string $data_checkin
 * @property  bool $admin_rights
 * @property  string $data_assumption
 * @property  bool $locking
 */

class Users extends Object
 {

    /*protected $login;
    *protected $email;
    *protected $user_password;
    *protected $data_checkin;
    *protected $admin_rights;
    *protected $data_assumption;
    *protected $locking;*/

    static  function TableName(){
         return 'users';
     }

    static  function CheckUniqueness($params = [],$r){
        $class = get_called_class();
        $table = $class::TableName();
        if ($r) {
            $oQuery = Object::$db->prepare("SELECT * FROM {$table} WHERE email=:need_email AND login!=:need_login");
            $oQuery->execute(['need_email' => $params['email'],'need_login' => $params['login']]);
            $aRes = $oQuery->fetchAll(PDO::FETCH_ASSOC);
            return $aRes? false:true;
       }
        else {
           $oQuery = Object::$db->prepare("SELECT * FROM {$table} WHERE email=:need_email");
            $oQuery->execute(['need_email' => $params['email']]);
            $aRes = $oQuery->fetchAll(PDO::FETCH_ASSOC);
            return $aRes? false:true;

        }
    }
    static function CheckExistence($params = [])
    {
        return true;
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
      * @return string
      */
     public function getUser_password()
     {
         return $this->getValueFromParams('user_password');
     }

     /**
      * @param string $user_password
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
             $aRes = $oQuery->fetch(PDO::FETCH_ASSOC);
             var_dump("Получила $aRes ");
             return ($class::findById($login))? false: true ;
         }
         else {
             var_dump("Записи с таким ключом не существует, поэтому ее нельзя удалить!");
             return false;
         }
     }
     //сохранение записи
     public static function saveRecord($params = [],$rights=null)
     {
         //Если в $params будут элементы одинаковыми ключами, то сохранится последнее
         $class = get_called_class();
         $table = $class::TableName();
         $columnNames=$class::getColumnName();
         //Убираем левые параметры
         foreach ($params as $param_name => $param_value) {
             foreach ($columnNames as $column_name => $column_value) {
                 if ($column_value == $param_name) {
                     if ($column_value=='user_password'){
                         $secret = "Xdgd99DFd9Z"; // Секретное слово
                         $param_value= md5($param_value.$secret); // Результат хэширования
                     }
                     //массив из принятых параметров с ключами - (столбцами таблицы)
                     $paramsForSave[$column_value] =  $param_value;
                 }
             }
         }
         if ((array_key_exists('login',$paramsForSave))&&(count($paramsForSave)==count($columnNames))) {
             if ($class::findById($paramsForSave['login']) ) {
                 if (($class::CheckUniqueness($paramsForSave,1))&&($class::CheckExistence($paramsForSave))&& ($rights==null)) {
                     var_dump(" Передан для обновления");
                     return $class::updateRecord($paramsForSave);
                 }
                 else{
                     var_dump(" Запись не может быть сохранена, по следующим причинам: </br> значения, которые должны быть уникальными, не являются таковыми; </br> 
                            значения полей, являющиеся ссылками, не найдены или недоступны из-за наложенных ограничений.");
                     return false;
                 }
             }
             else {
                 if (($class::CheckUniqueness($paramsForSave,0))&&($class::CheckExistence($paramsForSave))) {
                     var_dump(" Передан для добавления");
                     return $class::addRecord($paramsForSave);
                 }
                 else {
                     var_dump(" Запись не может быть сохранена, по следующим причинам: </br> значения, которые должны быть уникальными, не являются таковыми; </br> 
                            значения полей, являющиеся ссылками, не найдены или недоступны из-за наложенных ограничений.");
                     return false;
                 }
             }
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
             $oQuery = Object::$db->prepare("UPDATE {$table} SET  {$str} WHERE login=:need_login");
             $oQuery->execute(['need_login' => ($params[login])]);
             return true;
         }catch (PDOException $e) {
             var_dump("Ошибка при обновлении");
             return false;
         }
     }
    /**
     * @param $rights
     * @param $message
     * @return array
     */
    function getForm($rights,$message){
        $aData["message"]=$message;
        $aData["rights"]=$rights;
        return $aData;
    }
    static function getList ($mylittleuser,$verified_admin){
        $aData=[];
        $aData['title']="";
        $aData['items']=[];
        if (Users::findById($mylittleuser->login)->admin_rights==1) {
            switch ($verified_admin){
                case 1:
                    $aData['title']="Админы";
                    $need_locking=0;
                    $need_rights=1;
                    $oQuery = self::$db->prepare("SELECT DISTINCT  * FROM  users WHERE locking=:need_locking AND  admin_rights=:need_rights ");
                    $oQuery->execute(['need_locking' => $need_locking,'need_rights' => $need_rights]);
                    $oQuery->execute();
                    foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                        $aRes[] = new Users($aValues);
                    break;
                case 2:
                    $aData['title']="Обычные";
                    $need_locking=0;
                    $need_rights=0;
                    $oQuery = self::$db->prepare("SELECT DISTINCT  * FROM  users WHERE locking=:need_locking AND  admin_rights=:need_rights ");
                    $oQuery->execute(['need_locking' => $need_locking,'need_rights' => $need_rights]);
                    $oQuery->execute();
                    foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                        $aRes[] = new Users($aValues);
                    break;
                case 3:
                    $aData['title']="Забаненные";
                    $need_locking=1;
                    $need_rights=0;
                    $oQuery = self::$db->prepare("SELECT DISTINCT  * FROM  users WHERE locking=:need_locking AND  admin_rights=:need_rights ");
                    $oQuery->execute(['need_locking' => $need_locking,'need_rights' => $need_rights]);
                    $oQuery->execute();
                    foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                        $aRes[] = new Users($aValues);
                    break;
                default: $oQuery = self::$db->prepare("SELECT DISTINCT  * FROM  users");
                    $oQuery->execute();
                    foreach ($oQuery->fetchAll(PDO::FETCH_ASSOC) as $aValues)
                        $aRes[] = new Users($aValues);
            }
            foreach ($aRes as $oCategories) {
                if (Users::findById($oCategories->login)->admin_rights==1){
                    //админ
                    $string= ['user','locking','delete'];
                }else{
                    if (Users::findById($oCategories->login)->locking==1){
                        //бан
                        $string= ['adminr','user','delete'];
                    }else{
                        //обычный пользователь
                        $string= ['adminr','locking','delete'];
                    }
                }
                $aData['items'][] = ['title' => $oCategories->login,'buttons'=>$string,'back'=>Object::deleteEndURL('func').'','id'=> $oCategories->login];
            }
            if(count($aRes)<1) {$aData['title']="Нет подходящих пользователей";$aData['items']=[];}
        }
        else {
            var_dump("У Вас нет таких прав, и я Вам ничего не должен!");
        }
        return $aData;
    }
}
