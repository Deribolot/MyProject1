<?
/**
 * @var $aData
 */
?>
<div id="menu">
    <ul>
        <?foreach ($aData as $item):?>
            <li class="first active"><a href="<?= $item['href'] ?>"><?= $item['title'] ?></a></li>
        <?endforeach?>
    </ul>
    <br class="clearfix" />
</div>