<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<div class="content">
    <h1> <?= $aData["myname"]  ?></h1>
    <h2><?= $aData["mytext"]  ?></h2>
    <? foreach ($aData["sheet"] as $item): ?>
        <div><?= $item ?></div>
    <? endforeach; ?>
    <a href="<?=$aData["back"]?>"><img src="images/back.png" width="40" height="40" alt="back"></a>
    <? if($aData["buttons"]!=[]): ?><? foreach ($aData["buttons"] as $name => $value): ?>
        <a href="<?=  $value ?>"><img src="images/<?=  $name ?>.png" width="40" height="40" alt="<?=  $name ?>"></a>
    <? endforeach; ?><? endif ?>
</div>





