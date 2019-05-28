<?
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$mode = (isset($_POST['mode']) ? preg_replace("/[^a-z|]/i", "", substr($_POST['mode'], 0, 10)) : '');
$edost_locations = (isset($_POST['edost_locations']) && $_POST['edost_locations'] == 'Y' ? true : false);
$id = (isset($_POST['id']) ? preg_replace("/[^0-9A]/i", "", substr($_POST['id'], 0, 20)) : 0);

if (!empty($_POST['set_office'])) {
	// запись выбранного офиса в куки

	$profile = explode('_', isset($_POST['profile']) ? intval($_POST['profile']) : 0);
	$cod = (!empty($_POST['cod']) && $_POST['cod'] === 'Y' ? true : false);

	$_SESSION['EDOST']['office_default'][$mode] = $_SESSION['EDOST']['office_default']['all'] = array('id' => $id, 'profile' => $profile[0], 'cod_tariff' => $cod);

	echo 'OK';
}
else if (!empty($_POST['location'])) {
	// выбор местоположений

	if (!CModule::IncludeModule('edost.catalogdelivery')) return;

	if ($edost_locations) {
		$s = getLocalPath('modules/edost.delivery/classes/general/delivery_edost.php');
		if (empty($s) && CModule::IncludeModule('edost.locations')) {
			$location = CLocationsEDOST::GetCurrent();
			$id = (!empty($location['main_id']) ? $location['main_id'] : 0);
		}
	}

	CCatalogDeliveryEDOST::DrawLocation($id, $edost_locations, true);
}
else {
	// расчет доставки

	$zip = (isset($_POST['zip']) ? preg_replace("/[^0-9.]/i", "", substr($_POST['zip'], 0, 10)) : '');
	$city2 = (!empty($_POST['city2']) ? trim($GLOBALS['APPLICATION']->ConvertCharset(substr($_POST['city2'], 0, 200), 'utf-8', LANG_CHARSET)) : '');
	$product_id = (isset($_POST['product']) ? intval($_POST['product']) : 0);
	$add_cart = (isset($_POST['addcart']) && $_POST['addcart'] == '1' ? 'Y' : '');
	$quantity = (isset($_POST['quantity']) && intval($_POST['quantity']) > 0 ? intval($_POST['quantity']) : 1);
	$bookmark = (isset($_POST['bookmark']) ? substr($_REQUEST['bookmark'], 0, 10) : '');

	$param = array();

	if (isset($_POST['weight']) || isset($_POST['price'])) {
		$ar = array('weight', 'price', 'size1', 'size2', 'size3');
		$ar2 = array();
		foreach ($ar as $v) if (isset($_POST[$v])) $ar2[$v] = str_replace(',', '.', preg_replace("/[^0-9.,|A-Z]/i", "", substr($_POST[$v], 0, 12)));
		if (isset($ar2['weight'])) $param['weight'] = $ar2['weight'];
		if (isset($ar2['price'])) $param['price'] = $ar2['price'];
		if (isset($ar2['size1']) && isset($ar2['size2']) && isset($ar2['size3'])) $param['size'] = array($ar2['size1'], $ar2['size2'], $ar2['size3']);
	}

	// распаковка параметров
	$data = (isset($_POST['param']) ? preg_replace("/[^a-z0-9()_|:\/.]/i", "", substr($_POST['param'], 0, 2000)) : '');
	if ($data != '') {
		$param_key = array('sort', 'minimize', 'max', 'economize', 'price_value', 'show_error', 'show_ico', 'format_ico', 'ico_default', 'show_day', 'location_id_default', 'currency_result', 'weight_measure', 'price_measure', 'size_measure', 'attract_weight', 'attract_price', 'map_inside', 'block_type', 'cod', 'format', 'block', 'autoselect_office');
		$data = explode(')', $data);
		foreach ($data as $v) if ($v != '') {
			$ar = explode('(', $v);
			if ($ar[0] != '' && isset($ar[1]) && in_array($ar[0], $param_key)) $param[$ar[0]] = $ar[1];
		}
	}

	$param['location'] = array('id' => $id, 'zip' => $zip, 'city2' => $city2);
	$param['product_id'] = $product_id;
	$param['add_cart'] = $add_cart;
	$param['quantity'] = $quantity;
	$param['edost_locations'] = $edost_locations;
	$param['bookmark'] = $bookmark;

//	echo '<br><b>param:</b> <pre style="font-size: 12px">'.print_r($param, true).'</pre>';

	if ($mode != '') $APPLICATION->IncludeComponent('edost:catalogdelivery', '', array('MODE' => $mode, 'PARAM' => $param), null, array('HIDE_ICONS' => 'Y'));
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_after.php');
?>