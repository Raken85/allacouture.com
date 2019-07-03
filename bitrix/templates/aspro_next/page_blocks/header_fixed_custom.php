<?
global $arTheme, $arRegion;
if($arRegion)
	$bPhone = ($arRegion['PHONES'] ? true : false);
else
	$bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
?>
<div class="wrapper_inner">
	<div class="logo-row v1 row margin0">
		<div class="pull-left">
			<div class="inner-table-block sep-left nopadding logo-block">
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
		</div>
		<div class="pull-left">
			<div class="inner-table-block menu-block rows sep-left">
				<div class="title"><i class="svg svg-burger"></i><?=GetMessage("S_MOBILE_MENU")?>&nbsp;&nbsp;<i class="fa fa-angle-down"></i></div>
				<div class="navs table-menu js-nav">
					<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
						array(
							"COMPONENT_TEMPLATE" => ".default",
							"PATH" => SITE_DIR."include/menu/menu.top_fixed_field.php",
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "",
							"AREA_FILE_RECURSIVE" => "Y",
							"EDIT_TEMPLATE" => "include_area.php"
						),
						false, array("HIDE_ICONS" => "Y")
					);?>
				</div>
			</div>
		</div>
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
		<div class="pull-left col-md-3 nopadding hidden-sm hidden-xs search animation-width">

		</div>
		<div class="pull-right">
			<?CNext::ShowBasketWithCompareLink('top-btn inner-table-block', 'big');?>
		</div>
		<div class="pull-right">
			<div class="inner-table-block small-block">
				<div class="wrap_icon wrap_cabinet">
					<a rel="nofollow" title="Мой кабинет" class="personal-link dark-color" href="/personal/">
						<i class="svg inline big svg-inline-cabinet" aria-hidden="true" title="Мой кабинет">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 17">
								<defs>
									<style>
										.uscls-1 {
											fill: #222;
											fill-rule: evenodd;
										}
									</style>
								</defs>
								<path d="M13.969,16a1,1,0,1,1-2,0H11.927C11.578,14.307,9.518,13,7,13s-4.575,1.3-4.924,3H2.031a1,1,0,0,1-2,0,0.983,0.983,0,0,1,.1-0.424C0.7,12.984,3.54,11,7,11S13.332,13,13.882,15.6a1.023,1.023,0,0,1,.038.158c0.014,0.082.048,0.159,0.058,0.243H13.969ZM7,10a5,5,0,1,1,5-5A5,5,0,0,1,7,10ZM7,2a3,3,0,1,0,3,3A3,3,0,0,0,7,2Z"></path>
							</svg>
						</i>
					</a>
					<?/*<?=CNext::ShowCabinetLink(true, false, 'big');?>*/?>
				</div>
			</div>
			<div class="inner-table-block small-block nopadding inline-search-show" data-type_search="fixed">
				<div class="search-block top-btn">
					<button class="top-btn inline-search-show twosmallfont">
						<i class="svg inline svg-inline-search big" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 21"><path data-name="Rounded Rectangle 106" d="M1590.71,131.709a1,1,0,0,1-1.42,0l-4.68-4.677a9.069,9.069,0,1,1,1.42-1.427l4.68,4.678A1,1,0,0,1,1590.71,131.709ZM1579,113a7,7,0,1,0,7,7A7,7,0,0,0,1579,113Z" transform="translate(-1570 -111)"></path></svg>
						</i>
					</button>
					<?/*<i class="svg svg-search lg"></i>*/?>
				</div>
		</div>
		</div>
		<?if($arTheme['SHOW_CALLBACK']['VALUE'] == 'Y'):?>
			<div class="pull-right">
				<div class="inner-table-block">
					<div class="animate-load btn btn-default white btn-sm" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback">
						<span><?=GetMessage("CALLBACK")?></span>
					</div>
				</div>
			</div>
		<?endif;?>
		<?if($bPhone):?>
			<div class="pull-right logo_and_menu-row">
				<div class="inner-table-block phones">
					<?CNext::ShowHeaderPhones();?>
				</div>
			</div>
		<?endif;?>

	</div>
</div>
<?if((CSite::inDir("/catalog/")||CSite::inDir("/order/"))&&0){?>
	<style>
	#header{
		display:none;
	}
	#headerfixed{
		display:block!important;
		opacity:1!important;
		top:0!important;
	}
	.breadcrumbs{
		margin-top:50px;
	}
	</style>
	<?}?>
<?if(CSite::inDir("/personal/")||CSite::inDir("/order/")){?>
	<style>
	#pagetitle{
		display:none;
	}
	</style>
<?};?>