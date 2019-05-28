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





<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	<?if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>

	<?else:?>
				<div class="form-contact__input-wrap">
               
			   
			   
				
			
			
			<?
	switch ($FIELD)
	{
		case "PASSWORD":
			?>
			<input size="30" type="password" name="REGISTER[<?=$FIELD?>]" id="<?=$FIELD?>" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-contact__input js-form-contact__input--psw-reg" />
			<label for="<?=$FIELD?>" class="form-contact__input-holder"><?=GetMessage("REGISTER_FIELD_".$FIELD)?></label>
			<a href="#" class="form-contact__show-psw js-form-contact__show-psw-reg"></a>
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
			<input size="30" type="password" id="<?=$FIELD?>" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" class="form-contact__input js-form-contact__input--psw-reg-repeat"/>
			<label for="<?=$FIELD?>" class="form-contact__input-holder"><?=GetMessage("REGISTER_FIELD_".$FIELD)?></label>
			<a href="#" class="form-contact__show-psw js-form-contact__show-psw-reg-repeat"></a>
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
                    <label for="<?=$FIELD?>" class="form-contact__input-holder"><?=GetMessage("REGISTER_FIELD_".$FIELD)?><?if($FIELD=='UF_FIO'):?>ФИО<?endif;?></label>
				<?endif;?>
			<?
			}?>
                </div>
	<?endif?>
<?endforeach?>






<?/*if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<?=$arUserField["EDIT_FORM_LABEL"]?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "regform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif*/?>



		
		
		
		
	
				<?/*div class="form-contact__controls form-contact__controls--reg">
                    <input type="submit" name="register_submit_button" class="form-contact__submit form-contact__submit--reg" value="<?=GetMessage("AUTH_REGISTER")?>" />
                </div*/?>
				
				<div class="form-contact__controls form-contact__controls--reg">
<input type="submit" name="register_submit_button" class="form-contact__submit form-contact__submit--reg" value="<?=GetMessage("AUTH_REGISTER")?>" />
					<?/*button type="submit" name="register_submit_button"  class="form-contact__submit form-contact__submit--reg"><?=GetMessage("AUTH_REGISTER")?></button*/?>
                </div>
				
                <div class="form-contact__sign-social">
                    <div class="form-contact__sign-social-text">Или войдите с помощью</div>
					<?
						$GLOBALS['IS_SOC_AUTH_FROM_REG']=1;
						$APPLICATION->IncludeComponent("bitrix:system.auth.form", "templat", Array(
							"FORGOT_PASSWORD_URL" => SITE_DIR."login/forgot_password/",	// Страница забытого пароля
								"PROFILE_URL" => SITE_DIR."account/",	// Страница профиля
								"REGISTER_URL" => SITE_DIR."signup/",	// Страница регистрации
								"SHOW_ERRORS" => "Y",	// Показывать ошибки
							),
							false
						);?>

					

                </div>










</form>
<?endif?>