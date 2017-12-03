<?
/**
 * @var $aData
 */
?>
<div id="menu">
    <ul>
        <?foreach ($aData as $item):?>
            <? if ($item['title']=='create'): ?>
                <a href="<?=  $item['href'] ?>"><img src="images/<?= $item['title'] ?>.png" width="20" height="20" alt="<?= $item['title'] ?>"> добавить запись</a>
            <? else: ?>
                <li class="first active"><a href="<?= $item['href'] ?>"><?= $item['title'] ?></a></li>
            <? endif ?>
        <?endforeach?>
    </ul>
    <br class="clearfix" />
</div>