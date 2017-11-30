<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<div class="content">

<ul class="list">
    <h3><?= $aData['title'] ?></h3>
    <? foreach ($aData['items'] as $item): ?>
        <li <? if(isset($item['class'])): ?>class="<?= $item['class'] ?>"<? endif ?> ><a href="<?= $item['href'] ?>"><?= $item['title'] ?></a></li>
    <? endforeach; ?>
</ul>
</div>
