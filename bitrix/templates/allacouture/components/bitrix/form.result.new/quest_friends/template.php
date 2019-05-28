<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>



<form name="friends" action="/friends/" method="POST" enctype="multipart/form-data"  class="form form_modal">


<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
<?
if ($arResult["isFormTitle"])
{
?>
<?
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>
	<?
} // endif
	?>


<?
?>

      <div class="form__field field">
        <div class="field__control">
          <input type="text" placeholder="ФИО" name="form_text_14">
        </div>
      </div>
      <div class="form__field field">
        <div class="field__control">
          <input type="text" class="js-mask-phone" placeholder="+7 (___) ___-__-__" name="form_text_15">
        </div>
      </div>
      <div class="form__field field">
        <div class="field__control">
          <input type="text" placeholder="Электронная почта" name="form_text_16">
        </div>
      </div>
      <div class="form__field field">
        <div class="field__control">
          <textarea placeholder="Ваше сообщение" name="form_textarea_17" class="inputtextarea"></textarea>
        </div>
      </div>
      <div class="form__field field">
        <div class="field__control">
          <div class="fileupload">
            <input  name="form_file_18" type="file" multiple id="friends-photo">
            <label for="friends-photo">Прикрепить фото</label>
          </div>
        </div>
      </div>
    <div class="form__field checkbox">
      	<input type="checkbox" id="friends-agree" value="1" checked>
      	<label for="friends-agree">Нажимая кнопку «Отправить»  Вы соглашаетесь<br>
          на обработку персональных данных в соответствии<br>
          с <a href="#">ФЗ РФ № 152-ФЗ<a>, а также с условиями<br>
           <a href="#">Политики конфиденциальности</a> и
           <a href="#">Публичной оферты</a>
        </label>
    </div>
	<?/*
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
		<tr>
			<td>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			</td>
			<td><?=$arQuestion["HTML_CODE"]?></td>
		</tr>
	<?
		}
	} //endwhile
*/?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
<?
} // isUseCaptcha
?>

 <div class="form__footer">
	<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit"   class="form__submit button button_black" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
 </div>





<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>

    <button class="modal__close">&#10005;</button>