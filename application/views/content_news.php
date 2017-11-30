<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<div class="content">
    <h1> <?= $aData["myname"]  ?></h1>
    <h2><?= $aData["mytext"]  ?></h2>
    <? foreach ($aData['sheet'] as $item): ?>
        <div><?= $item ?></div>
    <? endforeach; ?>
    <a href="<?=$aData["back"]?>">назад</a>
</div>





