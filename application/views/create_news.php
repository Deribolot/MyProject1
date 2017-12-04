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
                <div ><textarea name="name" rows="1" cols="55" wrap="virtual" placeholder="Введите название новой записи" required maxlength="40"></textarea></div>
                <div >Текст новости:</div>
                <div ><textarea name="new" rows="4" cols="55" wrap="virtual" placeholder="Введите текст новой записи" required maxlength="700"></textarea></div>
                <div >Категории новости (0 или более, выделять с помощью Ctrl):</div>
                <div ><select name="courses[]"  multiple="multiple">
                    <? foreach ($aData['categories'] as $item): ?>
                        <option value="<?=$item->name?>"><?=$item->name?></option>
                    <? endforeach; ?>
                </select></div>
                <div ><INPUT type=SUBMIT VALUE=Отправить></div>
            </h4>
        </form>
        <form method="POST" enctype="multipart/form-data">
            <h3>Не хватает категории? Добавьте ее: </h3>
            <h4><div >Название категории:</div>
                <div ><textarea name="category" rows="1" cols="55" wrap="virtual" placeholder="Введите название новой категории" required maxlength="15"></textarea></div>
                <div ><INPUT type=SUBMIT VALUE=Отправить></div>
            </h4>
        </form>
    <? endif ?>
</div>





