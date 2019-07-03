<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
die();
?>
<?if($USER->IsAuthorized()):?>
<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
<?else:?>
<?
if (count($arResult["ERRORS"]) > 0):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<div class="info">
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
</div>
<?endif?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" class="form-contact">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>


	<div class="modal__header2">
	<span>Добро пожаловать!</span>
	</div>
	<div class="modal__before-text">
	Сайт находится в стадии финальных доработок.<br>
	Но вы можете принять участие<br>
	в нашей программе лояльности прямо сейчас!
	</div>


<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>

	<?else:?>
				<div class="form-contact__input-wrap">

			<?
	switch ($FIELD)
	{
		case "PASSWORD":
			?>
			<input size="30" type="hidden" name="REGISTER[<?=$FIELD?>]" id="<?=$FIELD?>" value="789632145" autocomplete="off" class="form-contact__input js-form-contact__input--psw-reg" />
					<?/*label for="<?=$FIELD?>" class="form-contact__input-holder"><?=GetMessage("REGISTER_FIELD_".$FIELD)?></label*/?>
<?if(($FIELD=='PASSWORD') or ($FIELD=='CONFIRM_PASSWORD')):?> <?else:?>
			<a href="#" class="form-contact__show-psw js-form-contact__show-psw-reg"></a>
<?endif;?>
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
			<?
			break;
		case "CONFIRM_PASSWORD":
			?>
			<input size="30" type="hidden" id="<?=$FIELD?>" name="REGISTER[<?=$FIELD?>]" value="789632145" autocomplete="off" class="form-contact__input js-form-contact__input--psw-reg-repeat"/>

			<?if(($FIELD=='PASSWORD') or ($FIELD=='CONFIRM_PASSWORD')):?> <?else:?>
				<label for="<?=$FIELD?>" class="form-contact__input-holder"><?=GetMessage("REGISTER_FIELD_".$FIELD)?></label>
				<a href="#" class="form-contact__show-psw js-form-contact__show-psw-reg-repeat"></a>
			<?endif;?>

			<?
			break;
		default:
			if ($FIELD == "PERSONAL_BIRTHDAY"):?><small><?=$arResult["DATE_FORMAT"]?></small><br />
			<?endif;
			?>
			
			<input <?if($FIELD=='PERSONAL_PHONE'):?> <?else:?>size="30"<?endif;?> type="<?if($FIELD=='LOGIN'):?>hidden<?else:?>text<?endif;?>" 
			<?if($FIELD=='LOGIN'):?>value="temp_login"<?else:?>value="<?=$arResult["VALUES"][$FIELD]?>"<?endif;?>
			id="<?if($FIELD=='UF_FIO'):?>main_UF_FIO<?else:?><?=$FIELD?><?endif;?>" 
			name="<?if($FIELD=='UF_FIO'):?>UF_FIO<?else:?>REGISTER[<?=$FIELD?>]<?endif;?>" 
			<?if($FIELD=='PERSONAL_PHONE'):?> placeholder="+7 (___) ___-__-__"<?endif;?>  
			class="form-contact__input <?if($FIELD=='PERSONAL_PHONE'):?>js-phone-input js-mask-phone phone-input input<?endif;?>"
			/>
				<?if(($FIELD=='PASSWORD') or ($FIELD=='CONFIRM_PASSWORD') or ($FIELD=='PERSONAL_PHONE')):?> <?else:?>
                    <label  for="<?=$FIELD?>" class="form-contact__input-holder"><?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if($FIELD=='UF_FIO'):?>ФИО<?endif;?></label>
				<?endif;?>
			<?
			}?>
                </div>
	<?endif?>
<?endforeach?>

				<div class="form-contact__controls form-contact__controls--reg">

		<button type="submit" name="register_submit_button" value="Принять участие" class="form-contact__submit form-contact__submit--reg">Принять участие</button>
 </div>

		<div class="modal__after-text">
			Нажимая кнопку «Принять участие»  Вы соглашаетесь
			на обработку персональных данныхв соответствии с <a href="#">ФЗ РФ № 152-ФЗ</a>, 
			а также с условиями <a href="#">Политики Конфиденциальности</a> и <a href="#">Публичной оферты.</a>

		</div>
</form>

<?endif?>