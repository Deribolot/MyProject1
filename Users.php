<?php
 class Users extends Object{

    protected $login;
    protected $email;
    protected $user_password;
    protected $data_checkin;
    protected $admin_rights;
    protected $data_assumption;

    static  function TableName()
     {
         return 'users';
     }
        //задать логин
     public function setLogin($value)
     {
         $this->login=$value;
     }
        //получить логин
     public function getLogin()
     {
         return $this->login ;
     }
     public static function findById($login)
     {
         $class = get_called_class();
         $table = $class::TableName();
         $oQuery = Object::$db->prepare("SELECT * FROM {$table} WHERE login=:need_login");
         // запустить подготовленный запрос на выполнение
         $oQuery->execute([ 'need_login' => $login]);
         //извлечь следующую строку из результирующего набора
         //PDO::FETCH_ASSOC возвращает следующую строку в виде массива, индексированного именами столбцов
         $aRes = $oQuery->fetch(PDO::FETCH_ASSOC);
         return $aRes ? new $class($aRes) : null;
     }
}
