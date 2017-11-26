<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<h3><?= $aData['title'] ?></h3>
<ul class="list">
    <? foreach ($aData['items'] as $item): ?>
        <li <? if(isset($item['class'])): ?>class="<?= $item['class'] ?>"<? endif ?> ><a href="<?= $item['href'] ?>"><?= $item['title'] ?></a></li>
    <? endforeach; ?>
</ul>
