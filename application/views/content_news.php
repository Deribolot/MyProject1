<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<div class="content">
    <h3> <?= $aData["myname"]  ?></h3>
    <h4><?= $aData["mytext"]  ?></h4>
    <? foreach ($aData["sheet"] as $item): ?>
        <div><?= $item ?></div>
    <? endforeach; ?>
    <a href="<?=$aData["back"]?>"><img src="images/back.png" width="30" height="30" alt="back"></a>
    <? if($aData["buttons"]!=[]): ?><? foreach ($aData["buttons"] as $name => $value): ?>
        <a href="<?=  $value ?>"><img src="<?$_SERVER['DOCUMENT_ROOT']?>/images/<?=  $name ?>.png" width="30" height="30" alt="<?=  $name ?>"></a>
    <? endforeach; ?><? endif ?>

</div>





