<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<div >
    <h1> <? $aData['name']  ?></h1>
    <h2><? $aData['text']  ?></h2>
    <? foreach ($aData['sheet'] as $item): ?>
        <div><?= $item ?></div>
    <? endforeach; ?>
    <a href="<?=$aData["back"]?>">назад</a>
</div>





