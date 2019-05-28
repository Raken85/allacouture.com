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
	<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" class="form-contact">
	<?
	if($arResult["BACKURL"] <> ''):
	?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?
	endif;
	?>

<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?><?//if($FIELD=='EMAIL'){?> 
	<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
		<tr>
			<?echo GetMessage("main_profile_time_zones_auto")?><?if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?><span class="starrequired">*</span><?endif?>
			<select name="REGISTER[AUTO_TIME_ZONE]" onchange="this.form.elements['REGISTER[TIME_ZONE]'].disabled=(this.value != 'N')">
				<option value=""><?echo GetMessage("main_profile_time_zones_auto_def")?></option>
				<option value="Y"<?=$arResult["VALUES"][$FIELD] == "Y" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_yes")?></option>
				<option value="N"<?=$arResult["VALUES"][$FIELD] == "N" ? " selected=\"selected\"" : ""?>><?echo GetMessage("main_profile_time_zones_auto_no")?></option>
			</select>
		</tr>
		
		<tr>
			<?echo GetMessage("main_profile_time_zones_zones")?>
			<select name="REGISTER[TIME_ZONE]"<?if(!isset($_REQUEST["REGISTER"]["TIME_ZONE"])) echo 'disabled="disabled"'?>>
			<?foreach($arResult["TIME_ZONE_LIST"] as $tz=>$tz_name):?>
						<option value="<?=htmlspecialcharsbx($tz)?>"<?=$arResult["VALUES"]["TIME_ZONE"] == $tz ? " selected=\"selected\"" : ""?>><?=htmlspecialcharsbx($tz_name)?></option>
			<?endforeach?>
			</select>
			</td>
		</tr>
		
	<?else:?>
	
		<div class="form-contact__input-wrap">
					

			<?/*if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"):?>*<?endif*/?>
			<?
				switch ($FIELD)
				{
				case "PASSWORD":
			?>
			<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="bx-auth-input" />
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
			<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" />
			<?
				}
			?>
			<?/*label for="form-contact__input--name" class="form-contact__input-holder"><?=GetMessage("REGISTER_FIELD_".$FIELD)?></label*/?>
		</div>
		
		
		
	<?endif?>
<?endforeach?>



<?/*?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?=$arUserField["EDIT_FORM_LABEL"]?>:<?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;?></td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;?>
<?*/?>





<?/*
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<tr>
			<td colspan="2"><b><?=GetMessage("REGISTER_CAPTCHA_TITLE")?></b></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<tr>
			<td><?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:<span class="starrequired">*</span></td>
			<td><input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
	<?
}
*/?>

	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td><button type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>"></button></td>
		</tr>
	</tfoot>


</form>
<?endif?>
