<?
    require('application/core/Base/Object.php');
    require('application/core/Base/Messages.php');
    require('application/models/Users.php');
    require('application/models/News.php');
    require('application/models/Comments.php');
    require('application/models/Categories.php');
    require('application/models/Relationships.php');
    require('application/DBConnect.php');
    header("Content-Type: text/html; charset=utf-8");
?>

<html>
	<head>
		<title> Tabtabus </title>

	</head>
	<body>
		<?
           var_dump('Пробую посоздавать всякие штуки');
           var_dump('Сначала узнаю, что есть вообще');
           var_dump("</br>");
        var_dump(News::getColumnName());
        var_dump("</br>");
        var_dump(Categories::getColumnName());
        var_dump("</br>");
        var_dump(Users::getColumnName());
        var_dump("</br>");
        var_dump(Comments::getColumnName());
        var_dump("</br>");
        var_dump(Relationships::getColumnName());
        var_dump("</br>");
        /*
         " array(7) { [0]=> string(2) "id" [1]=> string(4) "name" [2]=> string(11) "login_autor" [3]=> string(11) "data_create" [4]=> string(4) "text" [5]=> string(14) "verified_admin" [6]=> string(6) "rating" } string(5) "
" array(3) { [0]=> string(2) "id" [1]=> string(4) "name" [2]=> string(14) "verified_admin" } string(5) "
" array(7) { [0]=> string(5) "login" [1]=> string(5) "email" [2]=> string(13) "user_password" [3]=> string(12) "data_checkin" [4]=> string(12) "admin_rights" [5]=> string(15) "data_assumption" [6]=> string(7) "locking" } string(5) "
" array(7) { [0]=> string(2) "id" [1]=> string(7) "id_news" [2]=> string(11) "login_autor" [3]=> string(11) "data_create" [4]=> string(4) "text" [5]=> string(14) "verified_admin" [6]=> string(6) "rating" } string(5) "
" array(3) { [0]=> string(2) "id" [1]=> string(7) "id_news" [2]=> string(11) "id_category" } string(5) "
        */
        var_dump("</br>");
        var_dump('Пробую сохранить новость');
        var_dump('Пробую сохранить новость с несуществующим логином');
        var_dump("</br>");
        $wwww=News::saveRecord(["id"=>45,"name"=> 'Уникальная 4',"login_autor" =>'Логин не существует',
            "data_create" => '2017-10-31 22:55:36', "text" =>'Cat is walking,',
            "verified_admin" =>1, "rating" =>0]);
        var_dump($wwww);
        var_dump("</br>");
        var_dump("</br>");
        var_dump('Пробую добавить комментарий для несуществующей записи');
        var_dump("</br>");
        $wwww=Comments::saveRecord(["id_news"=> 433,"login_autor" =>'log6',
            "data_create" => '2017-10-31 22:55:36', "text" =>'Cat is walking,',
            "verified_admin" =>1, "rating" =>0]);
        var_dump($wwww);
        var_dump("</br>");
        var_dump("</br>");
        var_dump('Пробую сохранить новость с существующим логином');
        var_dump("</br>");
        $wwww=News::saveRecord(["id"=>45,"name"=> 'Уникальная 4',"login_autor" =>'log6',
            "data_create" => '2017-10-31 22:55:36', "text" =>'Cat is walking,',
            "verified_admin" =>1, "rating" =>0]);
        var_dump($wwww);
        var_dump("</br>");
        var_dump("</br>");
        var_dump('Пробую добавить комментарий для существующей записи');
        var_dump("</br>");
        $wwww=Comments::saveRecord(["id_news"=> 45,"login_autor" =>'log6',
            "data_create" => '2017-10-31 22:55:36', "text" =>'Cat is walking,',
            "verified_admin" =>1, "rating" =>0]);
        var_dump($wwww);
        var_dump("</br>");
        var_dump("</br>");
        var_dump('Пробую добавить связь. Удачно');
        var_dump("</br>");
        $wwww=Relationships::saveRecord(["id_news"=> 45,"id_category" =>5]);
        var_dump($wwww);
        var_dump("</br>");
        var_dump("</br>");
        var_dump('Пробую добавить связь. Недачно');
        var_dump("</br>");
        $wwww=Relationships::saveRecord(["id_news"=> 55,"id_category" =>55]);
        var_dump($wwww);
        var_dump("</br>");



        ?>
	</body>
</html>