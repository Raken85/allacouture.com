<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); 
CJSCore::Init(array("jquery","date"));?>

<div class="module-form-block-wr lk-page border_block">

<?ShowError($arResult["strProfileError"]);?>
<?if( $arResult['DATA_SAVED'] == 'Y' ) {?><?ShowNote(GetMessage('PROFILE_DATA_SAVED'))?><br /><?; }?>
<script>
	$(document).ready(function()
	{
		$(".form-block-wr form").validate({rules:{ EMAIL: { email: true }}	});
	})
</script>
	<?global $arTheme?>
	<div class="form-block-wr">
		<form method="post" name="form1" class="main" action="<?=$arResult["FORM_TARGET"]?>?" enctype="multipart/form-data">
			<?=$arResult["BX_SESSION_CHECK"]?>
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
			<?if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] == "Y"):?>
				<input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
			<?else:?>
				
			<?endif?>
			<?if($arTheme["PERSONAL_ONEFIO"]["VALUE"] == "Y"):?>
				
			<?else:?>
				
			<?endif;?>
			
			



				


<div class="form-control">
				<div class="wrap_md">
					<div class="iblock label_block">
						<label>Индекс </label>

						<input type="text" name="PERSONAL_ZIP"  maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_ZIP"]?>" />
					</div>
					<div class="iblock text_block">
						<?//=GetMessage("PERSONAL_PHONE_DESCRIPTION")?>
					</div>
				</div>
			</div>

<div class="form-control">
				<div class="wrap_md">
					<div class="iblock label_block">
						<label>Город </label>

						<input type="text" name="PERSONAL_CITY"  maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_CITY"]?>" />
					</div>
					<div class="iblock text_block">
						<?//=GetMessage("PERSONAL_PHONE_DESCRIPTION")?>
					</div>
				</div>
			</div>

<div class="form-control">
				<div class="wrap_md">
					<div class="iblock label_block">
						<label>Адрес Доставки</label>

						<input type="text" name="UF_ADRESSS"  maxlength="255" value="<?=$arResult["arUser"]["UF_ADRESSS"]?>" />
					</div>
					<div class="iblock text_block">
						<?//=GetMessage("PERSONAL_PHONE_DESCRIPTION")?>
					</div>
				</div>
			</div>
			<div class="but-r">
				<button class="btn btn-default" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE_TITLE") : GetMessage("MAIN_ADD_TITLE"))?>"><span><?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE_TITLE") : GetMessage("MAIN_ADD_TITLE"))?></span></button>
			</div>

		</form>
		<? if($arResult["SOCSERV_ENABLED"]){ $APPLICATION->IncludeComponent("bitrix:socserv.auth.split", "main", array(
	"SUFFIX" => "form",
		"SHOW_PROFILES" => "Y",
		"ALLOW_DELETE" => "Y"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);}?>
	</div>
</div>