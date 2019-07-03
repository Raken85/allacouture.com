<?php
/**
 * @author Pavel Nikitin <p.nikitin@yahoo.com>
 */

class S2UKupiVCreditButton extends CBitrixComponent
{
	public function onPrepareComponentParams( $arParams )
	{
		if (empty($arParams['PRODUCT_PRICE']))
			throw new Exception('Product price don`t be empty', 500);
		
		$arParams['PRODUCT_PRICE'] = number_format($arParams['PRODUCT_PRICE'], 2, '.', '');
		$arParams['PRODUCT_NAME'] = trim($arParams['PRODUCT_NAME']);
		$arParams['SHOP_ID'] = trim($arParams['SHOP_ID']);
		$arParams['SHOWCASE_ID'] = trim($arParams['SHOWCASE_ID']);
		$arParams['PROMO_CODE'] = trim($arParams['PROMO_CODE']);
		if (empty($arParams['SHOP_ID']))
			$arParams['SHOP_ID'] = 'test_online';
		if (empty($arParams['SHOWCASE_ID']))
			$arParams['SHOWCASE_ID'] = 'test_online';
		if (empty($arParams['PROMO_CODE']))
			$arParams['PROMO_CODE'] = 'default';
		
		return $arParams;
	}
	
	public function executeComponent()
	{
		global $USER;
		$this->arResult['USER'] = false;
		if ($USER->IsAuthorized()) {
			$arUser = $USER->GetByID($USER->GetID())->Fetch();
			$this->arResult['USER'] = $arUser;
		}
		
		$this->includeComponentTemplate();
	}
}