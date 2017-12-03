<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<div class="content">
    <h4><?= $aData["message"]  ?></h4>
    <? if($aData["login"]!=""): ?>
    <form method="POST" enctype="multipart/form-data">
        <h3> <?= $aData["login"]  ?>! Поделитесь вашей новостью с нами: </h3>
        <h4><input type="hidden" name="login" value="<?= $aData["login"]  ?>">
            <input type="hidden" name="date" value="<?= date("m.d.y H:i:s")  ?>">
            <div >Название название:</div>
            <div ><textarea name="name" rows="1" cols="55" wrap="virtual" placeholder="Введите название новой записи" required maxlength="25"></textarea></div>
            <div >Текст новости:</div>
            <div ><textarea name="new" rows="4" cols="55" wrap="virtual" placeholder="Введите текст новой записи" required maxlength="500"></textarea></div>
            <div ><INPUT type=SUBMIT VALUE=Отправить><INPUT type="reset" VALUE=Отменить></div>
        </h4>
    </form>
    <? endif ?>
</div>





