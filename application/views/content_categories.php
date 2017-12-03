
    <h3><?= $aData['title'] ?></h3>
    <? foreach ($aData['items'] as $item): ?>
        <li  style="padding: 0px 10% 0px 0px; width: 40%" ><?= $item['title'] ?>
            <? foreach ( $item['buttons'] as $button): ?>
                <a style="float: right ;" href="<?=$item["back"].'&func='.$item['id'].$button?>"><img src="<?$_SERVER['DOCUMENT_ROOT']?>/images/<?= $button?>.png" width="30" height="30" alt="<?= $button?>"></a>
            <? endforeach; ?>
        </li>
    <? endforeach; ?>

