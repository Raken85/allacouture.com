<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (!CModule::IncludeModule('edost.catalogdelivery')) return;

use Bitrix\Sale\Location;

$sign = GetMessage('EDOST_CATALOGDELIVERY_SIGN');
$field = $sign['field'];
$field_key = array('location', 'zip', 'weight', 'price', 'size');

$mode = (isset($arParams['MODE']) && in_array($arParams['MODE'], array('window', 'inside', 'full', 'manual')) ? $arParams['MODE'] : '');
$param = (isset($arParams['PARAM']) && is_array($arParams['PARAM']) ? $arParams['PARAM'] : array());
$color = (isset($arParams['COLOR']) ? $arParams['COLOR'] : 'clear_white');

// упаковка параметров в строку для расчета через ajax
$param_string = '';
$param_key = array('sort', 'minimize', 'max', 'economize', 'price_value', 'show_error', 'show_ico', 'format_ico', 'ico_default', 'show_day', 'location_id_default', 'currency_result', 'weight_measure', 'price_measure', 'size_measure', 'attract_weight', 'attract_price', 'map_inside', 'block_type', 'cod', 'format', 'block', 'autoselect_office');
foreach ($param as $key => $v) if (in_array($key, $param_key)) $param_string .= $key.'('.$v.')';

// поля для ручного расчета
if ($mode == 'manual') foreach ($field_key as $v) {
	$field[$v]['default'] = ($v == 'size' ? array('', '', '') : '');
	if (!empty($param['field'][$v]['disable'])) $field[$v]['disable'] = true;
	else if (!empty($param['field'][$v])) $field[$v] = array_merge($field[$v], $param['field'][$v]);
	if (!in_array($v, array('location', 'zip'))) $param_string .= $v.'_measure'.'('.$field[$v]['measure'].')';
}

$arResult = array();
$arResult['param_string'] = $param_string;
$arResult['component_path'] = $componentPath;

// куки
$add_cart = false;
if (!empty($_COOKIE['edost_catalogdelivery'])) {
	$v = explode('|manual=', $_COOKIE['edost_catalogdelivery']);
	$add_cart = (empty($v[0]) ? false : true);
	if (!empty($v[1])) {
		$v = explode('|', $v[1]);
		if (isset($v[4])) {
			if (empty($field['weight']['hide'])) $field['weight']['default'] = floatval($v[0]);
			if (empty($field['price']['hide'])) $field['price']['default'] = floatval($v[1]);
			if (empty($field['size']['hide'])) $field['size']['default'] = array(floatval($v[2]), floatval($v[3]), floatval($v[4]));
		}
	}
}
if (isset($param['add_cart'])) $add_cart = ($param['add_cart'] == 'Y' ? true : false);
$param['add_cart'] = ($add_cart ? 'Y' : 'N');
//echo '<br><b>component field</b> <pre style="font-size: 12px">'.print_r($field, true).'</pre>';

// присвоение дефолтных значений
if ($mode == 'manual') {
	$param['field'] = $field;
	foreach ($field_key as $v) if (!in_array($v, array('location', 'zip'))) if (!isset($param[$v])) {
		$param[$v] = $field[$v]['default'];
		$param[$v.'_measure'] = $field[$v]['measure'];
	}
}
//echo '<br><b>component param</b> <pre style="font-size: 12px">'.print_r($param, true).'</pre>';

// проверка на модуль edost.locations
if (!isset($param['edost_locations'])) $param['edost_locations'] = (isset($arParams['EDOST_LOCATIONS']) && $arParams['EDOST_LOCATIONS'] == 'N' ? false : true);
if ($param['edost_locations'] && !(CModule::IncludeModule('edost.locations') && class_exists('CLocationsEDOST') && method_exists('CLocationsEDOST', 'GetCurrent'))) $param['edost_locations'] = false;

if ($mode == 'manual' || $mode == '') {
	// проверка на наличе модуля edost.delivery
	$s = getLocalPath('modules/edost.delivery/classes/general/delivery_edost.php');
	$param['edost_delivery'] = (!empty($s) ? true : false);

	// подключение библиотек
	$date = date('dmY');
	$protocol = (!empty($_SERVER['HTTPS']) || !empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ? 'https://' : 'http://');
	$map_link = $protocol.'edostimg.ru/shop/';
//	$map_link = '/bitrix/js/edost.delivery/'; // !!!!!
	if (empty($arParams['SCRIPT']) || $arParams['SCRIPT'] == 'A') $param['script'] = array('path' => $map_link, 'date' => $date);
	else if ($arParams['SCRIPT'] == 'Y') {
		CUtil::InitJSCore(array('ajax'));
		$GLOBALS['APPLICATION']->SetAdditionalCSS($map_link.'office.css?a='.$date);
		$GLOBALS['APPLICATION']->AddHeadString('<script type="text/javascript" src="'.$map_link.'catalogdelivery.js?a='.$date.'" charset="utf-8"></script>');
		if ($param['edost_delivery']) $GLOBALS['APPLICATION']->AddHeadString('<script type="text/javascript" src="'.$map_link.'office.js?a='.$date.'" charset="utf-8"></script>');
	}

	// параметры окна
	$s = array();
	$s[] = (isset($arParams['FRAME_AUTO']) && $arParams['FRAME_AUTO'] == 'N' ? 'N' : '');
	$s[] = (isset($arParams['FRAME_X']) ? intval($arParams['FRAME_X']) : '');
	$s[] = (isset($arParams['FRAME_Y']) ? intval($arParams['FRAME_Y']) : '');
	$s[] = ($color == 'clear_white' ? 'Y' : 'N');
	$s[] = (isset($arParams['SHOW_QTY']) && $arParams['SHOW_QTY'] == 'Y' ? 'Y' : 'N');
	$s[] = (isset($arParams['SHOW_ADD_CART']) && $arParams['SHOW_ADD_CART'] == 'Y' ? 'Y' : 'N');
	$s[] = $param['add_cart'];
	$s[] = (isset($arParams['SHOW_BUTTON']) && $arParams['SHOW_BUTTON'] == 'Y' ? 'Y' : 'N');
	$s[] = (!empty($arParams['~INFO']) ? str_replace(array('"', '|', "\n"), array('&quot;', '', ''), $arParams['~INFO']) : '');
	$s[] = (!empty($arParams['~NO_DELIVERY_MESSAGE']) ? str_replace(array('"', '|', "\n"), array('&quot;', '', ''), $arParams['~NO_DELIVERY_MESSAGE']) : '');
	$s[] = (!empty($arParams['LOADING']) ? $componentPath.'/images/'.$arParams['LOADING'] : '');
	$s[] = (!empty($arParams['LOADING_SMALL']) ? $componentPath.'/images/'.$arParams['LOADING_SMALL'] : '');
	$arResult['window_param'] = implode('|', $s);
}
//echo '<br><b>catalogdelivery component param:</b><pre>'.print_r($param, true).'</pre><br>';

if ($mode != '') {
	// расчет доставки и вывод html

	// загрузка данных по активному местоположению
	if ($param['edost_locations']) {
		$ar = (isset($param['location']) ? $param['location'] : array());
		if (!empty($id_default)) $ar += array('default' => array('id' => $id_default));
		$location = CLocationsEDOST::GetCurrent($ar);
	}
	else {
		$id = (isset($param['location']['id']) ? intval($param['location']['id']) : 0);
		$zip = (isset($param['location']['zip']) ? preg_replace("/[^0-9.]/i", "", $param['location']['zip']) : '');
		$id_default = (isset($param['location_id_default']) ? intval($param['location_id_default']) : 0);

		if (empty($id) && !empty($_COOKIE['edost_location'])) {
			$ar = explode('|', substr($_COOKIE['edost_location'], 0, 250)); // id|zip|city2
			if (isset($ar[2])) {
				$id = intval($ar[0]);
				$zip = preg_replace("/[^0-9.]/i", "", $ar[1]);
			}
		}
		if (empty($id) && isset($_COOKIE['YS_GEO_IP_LOC_ID'])) $id = intval($_COOKIE['YS_GEO_IP_LOC_ID']);
		if (empty($id)) $id = $id_default;

		$location = array();
		if (!empty($id)) {
			if (!empty($_SESSION['EDOST']['catalogdelivery_location_data']) && $_SESSION['EDOST']['catalogdelivery_location_data']['id'] == $id) $location = $_SESSION['EDOST']['catalogdelivery_location_data'];
			else {
				for ($i = 0; $i <= 4; $i++) {
					$ar = Location\LocationTable::getList(array(
						'select' => array('ID', 'CODE', 'SORT', 'PARENT_ID', 'TYPE_ID', 'LNAME' => 'NAME.NAME', 'CHILD_CNT', 'TYPE.CODE'),
						'filter' => array('NAME.LANGUAGE_ID' => 'ru', '=ID' => $id),
					));
					$ar->addReplacedAliases(array('LNAME' => 'NAME', 'SALE_LOCATION_LOCATION_TYPE_CODE' => 'TYPE_CODE'));
					$v = $ar->fetch();
					if (!isset($v['ID'])) break;
					if ($i == 0) $location['id'] = $v['ID'];
					if ($v['TYPE_CODE'] == 'CITY') $location['city'] = $v['NAME'];
					if ($v['TYPE_CODE'] == 'REGION') $location['region'] = $v['NAME'];
					if ($v['TYPE_CODE'] == 'COUNTRY') $location['country'] = $v['NAME'];
					if (!empty($v['PARENT_ID'])) $id = $v['PARENT_ID']; else break;
				}
				if (!empty($location['id'])) {
					$location['zip'] = $zip;
					if (empty($location['city']))
						if (!empty($location['region'])) {
							$location['city'] = $location['region'];
							$location['region'] = '';
						}
						else $location['city'] = $location['country'];

					$_SESSION['EDOST']['catalogdelivery_location_data'] = $location;
				}
			}
		}
	}
	$param['location'] = $location;
//	echo '<br><b>param:</b> <pre style="font-size: 12px">'.print_r($param, true).'</pre>';

	// расчет доставки
	if ($mode == 'manual' && empty($param['weight'])) {
		$r = false;
		$param['disable'] = true;
	}
	else $r = CCatalogDeliveryEDOST::GetData($param, $mode);
//	echo '<br><b>CatalogDelivery GetData:</b><pre>'.print_r($r, true).'</pre><br>';

	$arResult += array(
		'mode' => $mode,
		'param' => $param,
		'inside' => (isset($r['inside']) ? $r['inside'] : false),
		'detailed' => (!empty($r['detailed']) ? true : false),
	);
	if ($mode != 'inside' && isset($r['format'])) $arResult['edost']['format'] = $r['format'];

	$this->IncludeComponentTemplate();

}
else {
	// инициализация - вывод html и js кода (доставка НЕ рассчитывается)

	if ($this->StartResultCache()) {
		$v = $color;
		if ($v != 'clear_white') {
			$data = array(
				'red' => array(255, 0, 0),
				'blue' => array(160, 208, 240),
				'blue_light' => array(100, 200, 240),
				'green' => array(80, 200, 80),
				'orange' => array(255, 185, 0),
				'white' => array(230, 230, 230),
				'black' => array(80, 80, 80),
				'gray' => array(200, 200, 200),
				'clear_white' => array(255, 255, 255),
			);
			if ($v != '' && isset($data[$v])) $color = $data[$v];
			else {
				$n = strlen($v);
				if ($n == 3) $color = array(hexdec($v{0}.$v{0}), hexdec($v{1}.$v{1}), hexdec($v{2}.$v{2}));
				else if ($n == 6) $color = array(hexdec($v{0}.$v{1}), hexdec($v{2}.$v{3}), hexdec($v{4}.$v{5}));
				else $v = '';
			}
			if ($v == '') $color = $data['gray'];

			$light = ceil(0.3*$color[0] + 0.59*$color[1] + 0.11*$color[2]);

			$arResult['COLOR'] = '#'.CCatalogDeliveryEDOST::RGBtoHEX($color);
			$arResult['COLOR_SHADOW'] = '#'.CCatalogDeliveryEDOST::RGBlight($color, ($light < 90 ? 100 : -80), true);
			$arResult['COLOR_FONT'] = ($light < 160 ? '#FFF' : '#'.CCatalogDeliveryEDOST::RGBlight($color, -140, true));
			$arResult['COLOR_FONT_UP'] = '#'.CCatalogDeliveryEDOST::RGBlight($color, ($light < 150 ? 120 : -20), true);
			$arResult['COLOR_UP'] = '#'.CCatalogDeliveryEDOST::RGBlight($color, 25, true);
			$arResult['CLEAR_WHITE'] = ($light == 255 ? true : false);
			$arResult['RADIUS'] = (isset($arParams['RADIUS']) ? intval($arParams['RADIUS']) : 0);
		}

		$arResult['param'] = $param;

		$this->IncludeComponentTemplate();
	}

	return $componentPath.'/images/'.(isset($arParams['IMAGE']) && $arParams['IMAGE'] != '' ? $arParams['IMAGE'] : 'delivery.png');
}
?>
