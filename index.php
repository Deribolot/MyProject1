<?php
require('application/core/Base/Object.php');
require('application/core/Base/Messages.php');
require('application/core/Base/controller.php');
require('application/core/Base/view.php');
require('application/core/Elements/Menu.php');
require('application/core/Interfaces/IMenu.php');
require('application/models/Users.php');
require('application/models/News.php');
require('application/models/Comments.php');
require('application/models/Categories.php');
require('application/models/Relationships.php');
require('application/models/HighMenu.php');
require('application/models/LowMenu.php');
require('application/DBConnect.php');
header("Content-Type: text/html; charset=utf-8");



ini_set('display_errors', 1);
//создание класса bootstrap и запуск его метода load
require_once 'application/bootstrap.php';
(new Bootstrap([
    'core',
    'controllers',
    'models'
]))->start();

header("Content-Type: text/html; charset=utf-8");

//запуск маршрутизатора
Route::start();