<?php

$arComponentParameters = array(
	'GROUPS' => array(
		'CONNECT_SETTINGS' => array(
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_GROUPS_CONNECT_SETTINGS'),
		),
		'PRODUCT_SETTINGS' => array(
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_GROUPS_PRODUCT_SETTINGS'),
		),
		'WINDOW_SETTINGS' => array(
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_GROUPS_WINDOW_SETTINGS'),
		),
	),
	'PARAMETERS' => array(
		'SHOP_ID' => array(
			'PARENT' => 'CONNECT_SETTINGS',
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_SHOP_ID_NAME'),
			'TYPE' => 'STRING',
			'DEFAULT' => 'test_online'
		),
		'SHOWCASE_ID' => array(
			'PARENT' => 'CONNECT_SETTINGS',
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_SHOWCASE_ID_NAME'),
			'TYPE' => 'STRING',
			'DEFAULT' => 'test_online'
		),
		'PROMO_CODE' => array(
			'PARENT' => 'CONNECT_SETTINGS',
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_PROMO_CODE_NAME'),
			'TYPE' => 'STRING',
			'DEFAULT' => 'default'
		),
		'PRODUCT_NAME' => array(
			'PARENT' => 'PRODUCT_SETTINGS',
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_PRODUCT_NAME'),
			'TYPE' => 'STRING',
		),
		'PRODUCT_PRICE' => array(
			'PARENT' => 'PRODUCT_SETTINGS',
			'NAME' => GetMessage('S2U_COMP_PARAM_KUPIVCREDIT_PRODUCT_PRICE'),
			'TYPE' => 'STRING',
		),
	)
);