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
            <div >Имя:</div>
            <div ><input type='text' name='login' size="30" value='' placeholder="Введите имя" required pattern="^[а-яА-ЯёЁa-zA-Z0-9_.]{1,255}$" maxlength="15"></div>
            <div >Пароль:</div>
            <div ><input type='password' name='password' size="30" value="" placeholder="Введите пароль" required maxlength="15"></div>
            <div ><INPUT type=SUBMIT VALUE=Отправить><INPUT type="reset" VALUE=Отменить></div>
        </h4>
    </form>
    <? endif; ?>
</div>





