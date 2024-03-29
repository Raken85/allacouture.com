<div class="mobilemenu-v1 scroller">
	<div class="wrap">
	
		<?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"top_mobile",
			Array(
				"COMPONENT_TEMPLATE" => "top_mobile",
				"MENU_CACHE_TIME" => "3600000",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_USE_GROUPS" => "N",
				"MENU_CACHE_GET_VARS" => array(
				),
				"DELAY" => "N",
				/*"MAX_LEVEL" => \Bitrix\Main\Config\Option::get("aspro.next", "MAX_DEPTH_MENU", 2),*/
				"MAX_LEVEL" => "3",
				"ALLOW_MULTI_SELECT" => "Y",
				"ROOT_MENU_TYPE" => "top_content_multilevel",
				"CHILD_MENU_TYPE" => "submenu_fixed",
				"CACHE_SELECTED_ITEMS" => "N",
				"ALLOW_MULTI_SELECT" => "Y",
				"USE_EXT" => "Y"
			)
		);?>
		
		<?
		// show regions
		CNext::ShowMobileRegions();

		// show cabinet item
		CNext::ShowMobileMenuCabinet();

		// show basket item
		
		CNext::ShowMobileMenuBasket();

		// use module options for change contacts
//CNext::ShowMobileMenuContacts();

		?>
		<?$APPLICATION->IncludeComponent(
			"aspro:social.info.next",
			"mobile",
			array(
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600000",
				"CACHE_GROUPS" => "N",
				"COMPONENT_TEMPLATE" => ".default"
			),
			false
		);?>
	</div>
</div>
<script>
    $('#mobilemenu ul.top > li:last-child').css({
        'font-size': '15px',
        'font-weight': 'bold',
        'margin-left': '-31px',
        'border-bottom': '1px solid #f2f2f2'
    });
    $('#mobilemenu ul.top > li:last-child').prependTo('.social-icons ul');
</script>