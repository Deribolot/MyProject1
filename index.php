<?
    require('Object.php');
    require('Users.php');
    require('News.php');
	require('DBConnect.php');
    header("Content-Type: text/html; charset=utf-8");
?>

<html>
	<head>
		<title> Tabtabus </title>

	</head>
	<body>
		<?
            $userr = new Users(["login" => 44]);
            //$userr->login= "log1";
            //var_dump($userr->login);
            //var_dump(Users::findById($userr->login));
            ///var_dump(Object::saveRecord(["login" => 44]));
            //$wwww=Users::getColumnName();


            /*$wwww=News::getColumnName();
            var_dump($wwww);
            var_dump("</br>");
            var_dump("</br>");
            "id"=> 6,
            */

        $wwww=News::saveRecord(["name"=> 'Катюша5',"login_autor" =>'log6',
            "data_create" => '2017-10-31 22:55:36', "text_news" =>'Cat is walking,',
            "verified_admin" =>1, "rating" =>0]);
        var_dump($wwww);
        var_dump("</br>");
        /*$wwww=News::saveRecord(["name"=> 'PPPat is walking,',"login_autor" =>'ttttt',
            "data_create" => '2017-10-31 22:55:36', "text_news" =>'Cat is walking,',
            "verified_admin" =>1, "rating" =>0]);
        var_dump($wwww);
        var_dump("</br>");*/
        $wwww=News::deleteById(38);
        var_dump($wwww);
        var_dump("</br>");

        ?>
	</body>
</html>