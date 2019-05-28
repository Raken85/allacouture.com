<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="header__menu header__menu_mobile menu menu_mobile">
	<button class="menu__burger">
      	<span></span>
      	<span></span>
      	<span></span>
    </button>
    <div class="menu__container">
    	<ul class="menu__list">
<?
$previousLevel = 0;
$parent = false;
foreach($arResult as $arItem):?>
	<?$i = 0;?>
	<?if ($arItem["IS_PARENT"]):?>
		<?if($parent):$parent = false;?>
			</ul>
				</li>
		<?endif;?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="menu__item">
					<a href="<?=$arItem["LINK"]?>" class="menu__link menu__link_parent"><?=$arItem["TEXT"]?></a>
					<ul class="menu__list menu__submenu<?if ($arItem["SELECTED"]):?>menu__submenu_opened<?endif?>">
						<?$parent = true;?>
		<?else:?>
			<li class="menu__item">
				<a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a>
		<?endif?>
		<?$i++;?>
	<?else:?>	
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<?if($parent):?>
				<?$parent = false;?>
				</ul>
					</li>
			<?endif;?>
			<li class="menu__item">
				<a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a>
			</li>
		<?else:?>
			<li class="menu__item">
				<a href="<?=$arItem["LINK"]?>" class="menu__link"><?=$arItem["TEXT"]?></a>
			</li>
		<?endif?>

	<?endif?>

<?endforeach?>
		</ul>
		 <?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/mobile_contact.php"
			)
		);?>
		<?$APPLICATION->IncludeComponent("bitrix:menu", "mobile_menu_add", Array(
			"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
				"CHILD_MENU_TYPE" => "mobile_ad",	// Тип меню для остальных уровней
				"DELAY" => "N",	// Откладывать выполнение шаблона меню
				"MAX_LEVEL" => "2",	// Уровень вложенности меню
				"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
				"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
				"MENU_CACHE_TYPE" => "N",	// Тип кеширования
				"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
				"ROOT_MENU_TYPE" => "mobile_ad",	// Тип меню для первого уровня
				"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
				"MENU_THEME" => "site"
			),
			false
		);?>
	</div>
</nav>

<?endif?>