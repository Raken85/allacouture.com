<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="modal closed" id="modal-feedback">
  <div class="modal__header">
    <span>Написать руководителю</span>
  </div>
  <form class="form form_modal" action="<?=POST_FORM_ACTION_URI?>" method="POST">
    <?=bitrix_sessid_post()?>
  	<input type="hidden" name="submit" value="Y">
  	<input type="hidden" name="AJAX_MODES" value="Y">
    <input type="hidden" name="template" value="2">
    <input type="hidden" name="subject" value="Написать руководителю">
    <div class="mess"></div>
    <div class="form__field field">
      <div class="field__control">
        <input type="text" name="user_name" placeholder="ФИО">
      </div>
    </div>
    <div class="form__field field">
      <div class="field__control">
        <input type="text" name="user_phone" class="js-mask-phone" placeholder="+7 (___) ___-__-__">
      </div>
    </div>
    <div class="form__field field">
      <div class="field__control">
        <input type="text" name="user_email" placeholder="Электронная почта">
      </div>
    </div>
    <div class="form__field field">
      <div class="field__control">
        <textarea name="MESSAGE" placeholder="Ваше сообщение"></textarea>
      </div>
    </div>
    <div class="form__field field">
      <div class="field__control">
        <div class="fileupload">
          <input type="file" name="user_file" id="contact-photo" multiple>
          <label for="contact-photo">Прикрепить фото</label>
        </div>
      </div>
    </div>
    <?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
    <div class="form__field checkbox">
      	<input type="checkbox" id="friends-agree" value="1" checked>
      	<label for="friends-agree">Нажимая кнопку «Отправить»  Вы соглашаетесь<br>
          на обработку персональных данных в соответствии<br>
          с <a href="#">ФЗ РФ № 152-ФЗ<a>, а также с условиями<br>
           <a href="#">Политики конфиденциальности</a> и
           <a href="#">Публичной оферты</a>
        </label>
    </div>
    <div class="form__footer">
      	<button class="form__submit button button_black" type="submit">Отправить</button>
    </div>
  </form>
  <button class="modal__close">&#10005;</button>
</div>