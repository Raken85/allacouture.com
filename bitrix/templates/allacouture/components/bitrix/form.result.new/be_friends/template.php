<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<div class="modal closed" id="modal-friends">
  <div class="modal__header">
    <span>Стать другом</span>
  </div>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

      <?ShowNote($arResult["FORM_NOTE"]);?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
<?=$arResult["FORM_DESCRIPTION"]?>
	<?
}
	?>



		<?/**************стандартные поля**********************************/?>
		<?
 foreach ([]/*$arResult["QUESTIONS"]*/ as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>

				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>

			<?=$arQuestion["HTML_CODE"]?>

	<?
		}
	} //endwhile
 ?>

<?/******************************от дизайна**********************************************/?>


<div class="form__field field">
	<div class="field__control">
		<input type="text" placeholder="ФИО" name="form_text_1">
	</div>
</div>
<div class="form__field field">
	<div class="field__control">
		<input type="text" class="js-mask-phone" placeholder="+7 (___) ___-__-__" name="form_text_4">
	</div>
</div>
<div class="form__field field">
	<div class="field__control">
		<input type="text" placeholder="Электронная почта" name="form_text_2">
	</div>
</div>
<div class="form__field field">
	<div class="field__control">
		<textarea placeholder="Ваше сообщение" name="form_textarea_3" class="inputtextarea"></textarea>
	</div>
</div>


<div class="form__field field js-form__field_more-file opened">
	<div class="field__control">
		<div class="fileupload">
			<input name="form_file_5" class="inputfile" size="0" type="file" id="friends-photo">
			<label for="friends-photo">Прикрепить фото</label>
		</div>
	</div>
</div>
<div class="form__field field js-form__field_more-file">
        <div class="field__control">
          <div class="fileupload">
			<input name="form_file_20" class="inputfile" size="0" type="file" id="friends-photo1">
			<label for="friends-photo1">Еще файл</label>
		</div>
	</div>
</div>
<div class="form__field field js-form__field_more-file">
	<div class="field__control">
		<div class="fileupload">
			<input name="form_file_21" class="inputfile" size="0" type="file" id="friends-photo2">
			<label for="friends-photo2">Еще файл</label>
		</div>
	</div>
</div>
<div class="form__field field js-form__field_more-file">
	<div class="field__control">
		<div class="fileupload">
			<input name="form_file_22" class="inputfile" size="0" type="file" id="friends-photo3">
			<label for="friends-photo3">Еще файл</label>
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
    <div class="form__footer">
      	<input class="form__submit button button_black" <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
    </div>


<?=$arResult["FORM_FOOTER"]?>
<button class="modal__close">✕</button>
<?
} //endif (isFormNote)
?></div>