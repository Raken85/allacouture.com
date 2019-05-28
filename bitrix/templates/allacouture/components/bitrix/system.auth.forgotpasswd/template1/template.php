<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

ShowMessage($APPLICATION->arAuthResult);

?>
<?// echo '<pre>'; print_r($APPLICATION->arAuthResult); echo '</pre>';?>
<div class="modal__before-text">
	<p>
	<?=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
	</p>
</div>
<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="form form-contact">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">


<!-- <div class="data-table bx-forgotpass-table"> -->
	<!-- <thead>
		<tr> 
			<td colspan="2"><b><?=GetMessage("AUTH_GET_CHECK_STRING")?></b></td>
		</tr>
	</thead> 
	<tbody>
		<tr>
			<td><?=GetMessage("AUTH_LOGIN")?></td>
			<td>-->
						<!-- <input class="form-contact__input" type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" /> --><!-- &nbsp;<?=GetMessage("AUTH_OR")?> -->
				
			<!-- </td>
		</tr>
		<tr> 
			<td><?=GetMessage("AUTH_EMAIL")?></td>
			<td> -->
						<input class="form-contact__input" type="text" name="USER_EMAIL" required maxlength="255" placeholder="<?=GetMessage("AUTH_EMAIL")?>" />
				
			<!-- </td>
		</tr> -->
	<?if($arResult["USE_CAPTCHA"]):?>
		<!-- <tr>
			<td></td>
			<td> -->
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			<!-- </td>
		</tr> -->
		<!-- <tr> -->
			<!-- <td> --><?echo GetMessage("system_auth_captcha")?><!-- </td> -->
			<!-- <td> --><input type="text" name="captcha_word" maxlength="50" value="" /><!-- </td> -->
		<!-- </tr> -->
	<?endif?>
	<!-- </tbody> -->
	<!-- <tfoot>
		<tr> 
			<td colspan="2"> -->
				<div class="form__footer">
					<input type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" class="form__submit button button_big" />
				</div>
			<!-- </td>
		</tr>
	</tfoot> -->
<!-- </div> -->
<!-- <p> -->
	<!-- <span class="form-contact__reg">
		<a class="form-contact__reg-link" href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a>
	</span> -->
<!-- </p>  -->
</form>
<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
