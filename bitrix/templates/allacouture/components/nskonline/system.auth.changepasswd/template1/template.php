<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="bx-auth">
<?
ShowMessage($arParams["~AUTH_RESULT"]);
	?><?// echo '<pre>'; print_r($APPLICATION->arAuthResult); echo '</pre>';?>
<div class="registration">
<div class="registration__form">
<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform" class="form-contact">
	<?if (strlen($arResult["BACKURL"]) > 0): ?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<? endif ?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="CHANGE_PWD">


				<input placeholder="<?=GetMessage("AUTH_LOGIN")?>" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="form-contact__input" />


				<input placeholder="<?=GetMessage("AUTH_CHECKWORD")?>"type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="form-contact__input" />


				<input placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>"type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="form-contact__input" autocomplete="off" />
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


				<input type="password" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>" class="form-contact__input"  name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
		<?if($arResult["USE_CAPTCHA"]):?>
					<input type="hidden"  class="form-contact__input" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />


				<input type="text " data-placeholder="<?echo GetMessage("system_auth_captcha")?>" class="form-contact__input"  name="captcha_word" maxlength="50" value="" />

		<?endif?>
<div class="form-contact__controls form-contact__controls--reg">
		<input type="submit" class="form-contact__submit form-contact__submit--reg" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" />
</div>



</form>
</div>
</div>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
</div>