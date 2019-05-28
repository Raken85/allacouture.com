<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme, $arRegion;
$arRegions = CNextRegionality::getRegions();
if($arRegion)
	$bPhone = ($arRegion['PHONES'] ? true : false);
else
	$bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
?>
<div class="top-block top-block-v1">
	<div class="maxwidth-theme">
		<div class="row flex-row">
			<?if($arRegions):?>
				<div class="top-block-item col-md-2">
					<div class="top-description">
						<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
							array(
								"COMPONENT_TEMPLATE" => ".default",
								"PATH" => SITE_DIR."include/top_page/regionality.list.php",
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_TEMPLATE" => "include_area.php"
							),
							false
						);?>
					</div>
				</div>
			<?endif;?>
			<div class="top-block-item pull-left">
				<?$APPLICATION->IncludeComponent("aspro:social.info.next", "new_socials", Array(
	"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"COMPONENT_TEMPLATE" => ".default",
		"TITLE_BLOCK" => "",	// Заголовок блока
		"COMPOSITE_FRAME_MODE" => "A",	// Голосование шаблона компонента по умолчанию
		"COMPOSITE_FRAME_TYPE" => "AUTO",	// Содержимое компонента
	),
	false
);?>
			</div>
			<div class="top-block-item pull-right show-fixed top-ctrl">
				<div class="personal_wrap">
					<div class="personal top login twosmallfont fff">
						<?=CNext::ShowCabinetLink(true, true);?>
					</div>
				</div>
			</div>
			<div class="top-block-item pull-right visible-lg">
				<div class="address twosmallfont inline-block">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/top_page/site-address-top.php", array(), array(
							"MODE" => "html",
							"NAME" => "Address",
							"TEMPLATE" => "include_area.php",
						)
					);?>
				</div>
			</div>
			<div class="top-block-item pull-right">
				<div class="phone-block">
					<?if($bPhone):?>
						<div class="inline-block">
							<?CNext::ShowHeaderPhones();?>
						</div>
					<?endif?>
					<?if($arTheme['SHOW_CALLBACK']['VALUE'] == 'Y'):?>
					<div class="animate-load btn btn-default white btn-sm" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback" onclick="yaCounter46773159.reachGoal('zakazat-zvonok'); return true;">
						<span><?=GetMessage("CALLBACK")?></span>
					</div>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="header-v2 header-wrapper long">
	<div class="maxwidth-theme">
		<div class="logo_and_menu-row">
			<div class="logo-row">
				<div class="row">
					<div class="logo-block col-md-2 col-sm-3">
						<div class="logo<?=$logoClass?>">
						<? if ($APPLICATION->GetCurPage(false) !== '/'){ ?>
<a href="/">
<img src="/upload/logo.svg" alt="AllaCouture" title="AllaCouture">
</a>
<? }else{ ?>

							<?=CNext::ShowLogo();?>
						<?} ?>
						</div>
					</div>
					<div class="col-md-10 menu-row">
						<div class="right-icons pull-right">
							<div class="pull-right">
								<?=CNext::ShowBasketWithCompareLink('', 'big', '', 'wrap_icon wrap_basket baskets');?>
							</div>
							<div class="pull-right">
								<div class="wrap_icon wrap_cabinet">
									<button class="top-btn inline-search-show twosmallfont">
										<?=CNext::showIconSvg("search big", SITE_TEMPLATE_PATH."/images/svg/Search_big_black.svg");?>
									</button>
								</div>
							</div>
						</div>
						<div class="menu-only">
							<nav class="mega-menu sliced">
								<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
									array(
										"COMPONENT_TEMPLATE" => ".default",
										"PATH" => SITE_DIR."include/menu/menu.top.php",
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "",
										"AREA_FILE_RECURSIVE" => "Y",
										"EDIT_TEMPLATE" => "include_area.php"
									),
									false, array("HIDE_ICONS" => "Y")
								);?>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div><?// class=logo-row?>
	</div>
	<div class="line-row visible-xs"></div>
</div>
