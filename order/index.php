<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"template1", 
	array(
		"ACTION_VARIABLE" => "soa-action",
		"ADDITIONAL_PICT_PROP_11" => "-",
		"ADDITIONAL_PICT_PROP_12" => "-",
		"ADDITIONAL_PICT_PROP_13" => "-",
		"ADDITIONAL_PICT_PROP_14" => "-",
		"ADDITIONAL_PICT_PROP_29" => "-",
		"ADDITIONAL_PICT_PROP_32" => "-",
		"ADDITIONAL_PICT_PROP_35" => "-",
		"ALLOW_APPEND_ORDER" => "Y",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "Y",
		"ALLOW_USER_PROFILES" => "Y",
		"BASKET_IMAGES_SCALING" => "standard",
		"BASKET_POSITION" => "before",
		"BRAND_PROPERTY" => "",
		"COMPATIBLE_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "template1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"DATA_LAYER_NAME" => "dataLayer",
		"DELIVERIES_PER_PAGE" => "8",
		"DELIVERY_FADE_EXTRA_SERVICES" => "Y",
		"DELIVERY_NO_AJAX" => "Y",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"DISPLAY_IMG_HEIGHT" => "90",
		"DISPLAY_IMG_WIDTH" => "90",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"HIDE_ORDER_DESCRIPTION" => "N",
		"MESS_ADDITIONAL_PROPS" => "Дополнительные свойства",
		"MESS_AUTH_BLOCK_NAME" => "Авторизация",
		"MESS_AUTH_REFERENCE_1" => "Символом \"звездочка\" (*) отмечены обязательные для заполнения поля.",
		"MESS_AUTH_REFERENCE_2" => "После регистрации Вы получите информационное письмо.",
		"MESS_AUTH_REFERENCE_3" => "Личные сведения, отправленные интернет-магазину при регистрации или иным образом, не будут без разрешения пользователя передаваться третьим организациям и лицам, за исключением, когда этого требует закон или судебное решение.",
		"MESS_BACK" => "Назад",
		"MESS_BASKET_BLOCK_NAME" => "Товары в заказе",
		"MESS_BUYER_BLOCK_NAME" => "Данные по доставке",
		"MESS_COUPON" => "Купон",
		"MESS_DELIVERY_BLOCK_NAME" => "Доставка",
		"MESS_DELIVERY_CALC_ERROR_TEXT" => "Вы можете продолжить оформление заказа, а чуть позже менеджер магазина свяжется с вами и уточнит информацию по доставке.",
		"MESS_DELIVERY_CALC_ERROR_TITLE" => "Не удалось рассчитать стоимость доставки.",
		"MESS_ECONOMY" => "Экономия",
		"MESS_EDIT" => "изменить",
		"MESS_FAIL_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.Обратите внимание на развернутый блок с информацией о заказе. Здесь вы можете внести необходимые изменения или оставить как есть и нажать кнопку \"#ORDER_BUTTON#\".",
		"MESS_FURTHER" => "Далее",
		"MESS_INNER_PS_BALANCE" => "На вашем пользовательском счете:",
		"MESS_NAV_BACK" => "Назад",
		"MESS_NAV_FORWARD" => "Вперед",
		"MESS_NEAREST_PICKUP_LIST" => "Ближайшие пункты:",
		"MESS_ORDER" => "Оформить заказ",
		"MESS_ORDER_DESC" => "Комментарии к заказу:",
		"MESS_PAYMENT_BLOCK_NAME" => "Оплата",
		"MESS_PAY_SYSTEM_PAYABLE_ERROR" => "Вы сможете оплатить заказ после того, как менеджер проверит наличие полного комплекта товаров на складе. Сразу после проверки вы получите письмо с инструкциями по оплате. Оплатить заказ можно будет в персональном разделе сайта.",
		"MESS_PERIOD" => "Срок доставки",
		"MESS_PERSON_TYPE" => "Тип плательщика",
		"MESS_PICKUP_LIST" => "Пункты самовывоза:",
		"MESS_PRICE" => "Стоимость",
		"MESS_PRICE_FREE" => "Бесплатно",
		"MESS_REGION_BLOCK_NAME" => "Регион доставки",
		"MESS_REGION_REFERENCE" => "Выберите свой город в списке. Если Вы не нашли свой город, выберите \"другое местоположение\", а город впишите в поле \"Город\".",
		"MESS_REGISTRATION_REFERENCE" => "Впервые на сайте? Чтобы Ваши заказы сохранялись, пожалуйста заполните регистрационную форму.",
		"MESS_REG_BLOCK_NAME" => "Регистрация",
		"MESS_SELECT_PICKUP" => "Выбрать",
		"MESS_SELECT_PROFILE" => "Выберите профиль",
		"MESS_SUCCESS_PRELOAD_TEXT" => "Вы заказывали в нашем интернет-магазине, поэтому мы заполнили все данные автоматически.Если все заполнено верно, нажмите кнопку \"#ORDER_BUTTON#\".",
		"MESS_USE_COUPON" => "Применить купон",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => SITE_DIR."auth/",
		"PATH_TO_BASKET" => SITE_DIR."basket/",
		"PATH_TO_PAYMENT" => SITE_DIR."order/payment/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "8",
		"PICKUPS_PER_PAGE" => "5",
		"PICKUP_MAP_TYPE" => "yandex",
		"PRODUCT_COLUMNS" => "",
		"PRODUCT_COLUMNS_HIDDEN" => array(
			0 => "PREVIEW_PICTURE",
		),
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "NOTES",
			2 => "PRICE_FORMATED",
		),
		"PROPS_FADE_LIST_1" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "4",
			4 => "5",
			5 => "7",
		),
		"PROPS_FADE_LIST_2" => array(
		),
		"PROP_1" => "",
		"PROP_2" => "",
		"PROP_3" => "",
		"PROP_4" => "",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "standard",
		"SET_TITLE" => "Y",
		"SHOW_BASKET_HEADERS" => "Y",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "N",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "Y",
		"SHOW_MAP_FOR_DELIVERIES" => array(
		),
		"SHOW_MAP_IN_PROPS" => "Y",
		"SHOW_NEAREST_PICKUP" => "Y",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "Y",
		"SHOW_ORDER_BUTTON" => "final_step",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_STORES_IMAGES" => "Y",
		"SHOW_TOTAL_ORDER_BUTTON" => "Y",
		"SHOW_VAT_PRICE" => "N",
		"SKIP_USELESS_BLOCK" => "N",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "blue",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "Y",
		"USE_CUSTOM_ERROR_MESSAGES" => "Y",
		"USE_CUSTOM_MAIN_MESSAGES" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PHONE_NORMALIZATION" => "Y",
		"USE_PRELOAD" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "Y",
		"YM_GOALS_COUNTER" => "",
		"YM_GOALS_EDIT_BASKET" => "BX-basket-edit",
		"YM_GOALS_EDIT_DELIVERY" => "BX-delivery-edit",
		"YM_GOALS_EDIT_PAY_SYSTEM" => "BX-paySystem-edit",
		"YM_GOALS_EDIT_PICKUP" => "BX-pickUp-edit",
		"YM_GOALS_EDIT_PROPERTIES" => "BX-properties-edit",
		"YM_GOALS_EDIT_REGION" => "BX-region-edit",
		"YM_GOALS_INITIALIZE" => "BX-order-init",
		"YM_GOALS_NEXT_BASKET" => "BX-basket-next",
		"YM_GOALS_NEXT_DELIVERY" => "BX-delivery-next",
		"YM_GOALS_NEXT_PAY_SYSTEM" => "BX-paySystem-next",
		"YM_GOALS_NEXT_PICKUP" => "BX-pickUp-next",
		"YM_GOALS_NEXT_PROPERTIES" => "BX-properties-next",
		"YM_GOALS_NEXT_REGION" => "BX-region-next",
		"YM_GOALS_SAVE_ORDER" => "BX-order-save"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>