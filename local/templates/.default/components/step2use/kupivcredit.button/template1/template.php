<?php
/**
 * @var array $arResult
 * @var array $arParams
 * @var CBitrixComponentTemplate $this
 */
CUtil::InitJSCore(array('window'));
?>

<button class="btn-lg w_icons  btn btn-default transition_bg animate-load" id="s2u-open-credit-button" type="button"><?= GetMessage('S2U_COMP_KUPIVCREDIT_BUTTON_TEXT') ?></button>

<div id="s2u-credit-window-text" style="display: none;">
	<?php
	$APPLICATION->IncludeFile(
		$this->__folder . '/description_inc.php',
		array(),
		array(
			'MODE' => 'html',
			'NAME' => GetMessage('S2U_COMP_KUPIVCREDIT_EDIT_LINK_TEXT')
		)
	);
/*?>
	<form action="https://loans-qa.tcsbank.ru/api/partners/v1/lightweight/create" method="post" id="s2u-order-credit-form">
		<input name="shopId" value="<?= $arParams['SHOP_ID'] ?>" type="hidden">
		<input name="showcaseId" value="<?= $arParams['SHOWCASE_ID'] ?>" type="hidden">
		<input name="promoCode" value="<?= $arParams['PROMO_CODE'] ?>" type="hidden">
		<input name="sum" value="<?= $arParams['PRODUCT_PRICE'] ?>" type="hidden">
		<?php if (!empty($arParams['PRODUCT_NAME'])) : ?>
			<input name="itemName_0" value="<?= $arParams['PRODUCT_NAME'] ?>" type="hidden">
			<input name="itemQuantity_0" value="1" type="hidden">
			<input name="itemPrice_0" value="<?= $arParams['PRODUCT_PRICE'] ?>" type="hidden">
		<?php endif ?>
		<input name="customerEmail" value="<?= $arResult['USER']['EMAIL'] ?>" type="hidden">
		<input name="customerPhone" value="<?= $arResult['USER']['PERSONAL_PHONE'] ?>" type="hidden">
	</form>*/?>
</div>

<script>
	BX.message({
        S2U_COMP_KUPIVCREDIT_WIN_ORDER_BUTTON_TEXT: '<?= GetMessage('S2U_COMP_KUPIVCREDIT_WIN_ORDER_BUTTON_TEXT') ?>',
        S2U_COMP_KUPIVCREDIT_WIN_TITLE: '<?= GetMessage('S2U_COMP_KUPIVCREDIT_WIN_TITLE') ?>'
	});
</script>
