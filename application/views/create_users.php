<?php
/**
 * Created by PhpStorm.
 * @var $aData
 */
?>
<div class="content">
    <h4><?= $aData["message"]  ?></h4>
    <? if($aData["rights"]==1): ?>
    <form method="POST" enctype="multipart/form-data">
        <h3> Для регистрации заполните: </h3>
        <h4><input type="hidden" name="date" value="<?= date("m.d.y H:i:s")  ?>">
            <div >Имя:</div>
            <div ><input type='text' name='login' size="30" value='' placeholder="Введите имя" required pattern="^[а-яА-ЯёЁa-zA-Z0-9_.]{1,255}$" maxlength="15"></div>
            <div >E-mail:</div>
            <div ><input type='email' name='email' size="30" value='' placeholder="Введите свой e-mail" required maxlength="25"></div>
            <div >Пароль:</div>
            <div ><input type='password' name='password' size="30" value="" placeholder="Введите пароль" required maxlength="15"></div>
            <div ><INPUT type=SUBMIT VALUE=Отправить><INPUT type="reset" VALUE=Отменить></div>
        </h4>
    </form>
    <? endif; ?>
</div>





