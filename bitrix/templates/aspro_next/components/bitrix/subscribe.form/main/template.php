<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$frame = $this->createFrame()->begin();?>
<?$id = $this->randString();?>
<div class="subscribe-form s_<?=$id;?>">
	<div class="wrap_bg">
		<div class="top_blocks">
			<div class="text">
				<div class="title"><?$APPLICATION->IncludeFile(SITE_DIR."include/subscribe_title.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("TOP_BLOCK"),));?></div>
				<?/*<div class="more"><?$APPLICATION->IncludeFile(SITE_DIR."include/subscribe_text.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("TEXT_BLOCK"),));?></div>*/?>
			</div>
		</div>
		<form action="<?=$arResult["FORM_ACTION"];?>" class="sform box-sizing">
			<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
				<label for="sf_RUB_ID_<?=$itemValue["ID"].$id?>" class="hidden">
					<input type="checkbox" name="sf_RUB_ID[]" id="sf_RUB_ID_<?=$itemValue["ID"].$id?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> /> <?=$itemValue["NAME"]?>
				</label>
			<?endforeach;?>
			<div class="email_wrap">
				<input type="email" title="<?=GetMessage("subscr_form_email_title")?>" class="email_input" name="sf_EMAIL" maxlength="100" required size="20" value="<?=$arResult["EMAIL"]?>" placeholder="<?=GetMessage("subscr_form_email_title")?>" />
				<input type="submit" name="OK" class="btn btn-default send_btn" value="<?=($arResult["EMAIL"] ? GetMessage("subscr_form_button_change") : GetMessage("subscr_form_button"));?>" />
			</div>
							<?global $arTheme;?>
	<?if($arTheme["SHOW_LICENCE"]["VALUE"] == "Y" && !$arResult["ID"] ):?>
		<div class="subscribe_licenses">
			<div class="licence_block filter label_block">
					<label id="licenses_subscribe-error-footer"  class="licenses_subscribe-error-footer" for="licenses_subscribe_footer"><?=GetMessage("JS_REQUIRED_LICENSES");?></label>
				<input type="checkbox" id="licenses_subscribe_footer" <?=($_POST["licenses_subscribe"] ? "checked" : ($_POST ? "" : ($arTheme["SHOW_LICENCE"]["DEPENDENT_PARAMS"]["LICENCE_CHECKED"]["VALUE"] == "Y" ? "checked" : "")));?> name="licenses_subscribe_footer" value="Y">
				<label for="licenses_subscribe_footer">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
				</label>
			</div>
		</div>
	<?endif;?>
		</form>
	</div>
</div>
<style>
#licenses_subscribe-error-footer{
	display:none;
}
</style>
<script>
	var obDataSubscribe = <?=CUtil::PhpToJSObject($id)?>
</script>
<?$frame->end();?>
