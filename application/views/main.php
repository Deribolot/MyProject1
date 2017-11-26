<?php
/**
 * @var View[] $aHighMenu
 * @var View[] $aLowMenu
 * @var View[] $aLeftMenu
 * @var View[] $aContent
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>Новостной сайт</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
                <h1>Новостной сайт</h1>
                    <?foreach ($aHighMenu as $item):?>
                        <? $item->generate() ?>
                    <?endforeach?>
                    <?foreach ($aLowMenu as $item):?>
                        <? $item->generate() ?>
                    <?endforeach?>

            </div>
			<div id="page">
                <?foreach ($aLeftMenu as $item):?>
                    <? $item->generate() ?>
                <?endforeach?>
				<div id="content">
                    <?foreach ($aContent as $item):?>
                        <? $item->generate() ?>
                    <?endforeach?>
				</div>
				<br class="clearfix" />
			</div>
			<div id="page-bottom">
				<div id="page-bottom-sidebar">
					<h3>Прекраснейший сайт</h3>
                    <p>со свежайшими новостями</p>
				</div>
				<div id="page-bottom-content">
					<h3>Работу выполнила</h3>
					<p>Дериболот Юлия</p>
				</div>
				<br class="clearfix" />
			</div>
		</div>
		<div id="footer"> 2017</div>
	</body>
</html>