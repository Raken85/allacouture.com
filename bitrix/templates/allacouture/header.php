<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
  use \Bitrix\Main\Page\Asset;
?>
<?IncludeTemplateLangFile(__FILE__);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?$APPLICATION->ShowTitle()?></title>
  <?
		Asset::getInstance()->addCss('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/styles.css');
		//Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/add_styles.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/add_styles.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles_leon.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles_antero.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles_ivan.css');
		Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/styles_new.css');
		Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');
		Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js');
		Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js');
		Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js');
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/slick.min.js');
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/phone-codes.js');
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/intlTelInput.min.js');
		Asset::getInstance()->addJs('https://unpkg.com/jarallax@1.9/dist/jarallax.min.js');
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/tipsy.min.js');
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.mCustomScrollbar.concat.min.js');
		// Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/parallax.min.js');
		Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/main.js');
  ?>
	<?$APPLICATION->ShowHead();?>
</head>
<body class="page 
<?= $APPLICATION->GetCurPage(false) === '/friends/' ? 'page__friends' : ''?>
<?= $APPLICATION->GetCurPage(false) === '/сollections/' ? 'page__collection' : ''?>
<?= $APPLICATION->GetCurPage(false) === '/contacts/' ? 'page__contacts' : ''?>
<?= $APPLICATION->GetCurPage(false) === '/media/about/' ? 'page__about' : ''?>
<?= $APPLICATION->GetCurPage(false) === '/media/news/' ? 'page__news' : ''?>
<?= $APPLICATION->GetCurPage(false) === '/' ? 'page__main' : ''?>
<?= $APPLICATION->GetCurPage(false) === '/сollections/detail.php' ? 'page__collection_detail' : ''?>
<?= $APPLICATION->GetCurPage(false) === '/media/news/detail.php' ? 'page__news_detail' : ''?>
">

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{latest-api-version}'
    });
    FB.AppEvents.logPageView();   
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<?$APPLICATION->ShowPanel();?>
<header class="page__header header">
  <div class="header__top">
    <div class="header__inner">
      <div class="header__left">
        <div class="header__callback">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/cont.php", array(), array(
					"MODE" => "html",
					"NAME" => "cont",
				)
			);?> 
        </div>
        <div class="header__social">
          <div class="social social_black">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/social_black.php", array(), array(
					"MODE" => "html",
					"NAME" => "social_black",
				)
			);?>  
          </div>
          <div class="messengers messengers_black">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/messengers_black.php", array(), array(
					"MODE" => "html",
					"NAME" => "messengers_black",
				)
			);?>
          </div>
        </div>
      </div>
      <div class="header__logo logo">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/logo.php", array(), array(
				"MODE" => "html",
				"NAME" => "logo",
				)
			);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"text_slader", 
	array(
		"ACTIVE_DATE_FORMAT" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_SPEED" => "5000",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "Content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "text_slader"
	),
	false
);?>
      </div>
      <div class="header__right">
        <div class="header__lang">
          <div class="header__lang-wrapper">
            <a href="#" class="lang-option uk"></a>
            <a href="#" class="lang-option ru"></a>
          </div>
        </div>

        <div class="header__nav">
							<?
							global $USER;
							if ($USER->IsAuthorized()){
							?>
								<a href="<?=SITE_DIR?>personal/" class="header-link header-link_icon_user">
									<!-- <span class="header-link__counter">2</span> -->
								</a>
							<?}else{?>
								<a href="<?=SITE_DIR?>login/" class="header-link header-link_icon_user">
									<!-- <span class="header-link__counter">2</span> -->
								</a>
							<?}?>
          <a href="lk-favourites.html" class="header-link header-link_icon_fav">
            <span class="header-link__counter">2</span>
          </a>
          <a href="basket.html" class="header-link header-link_icon_cart">
            <span class="header-link__counter">20</span>
          </a>
          <a href="basket.html" class="header__cart-sum"><span>9 699</span> ₽</a>
        </div>
      </div>
    </div>
  </div>
  <div class="header__bottom">
    <div class="header__inner">
      <div class="header__sitemap menu menu_sitemap">
        <button class="menu__burger"></button>
        <div class="menu__container">
          <a href="#" class="menu__link">ссылка</a>
          <a href="#" class="menu__link">ссылка</a>
          <a href="#" class="menu__link">ссылка</a>
        </div>
      </div>
      <div class="header__search search">
        <button class="search__btn"></button>
        <div class="search__container">
			<?$APPLICATION->IncludeComponent("bitrix:search.form", "main_search", Array(
	"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
		"USE_SUGGEST" => "N",	// Показывать подсказку с поисковыми фразами
	),
	false
);?>
        </div>
      </div> 
		<?$APPLICATION->IncludeComponent("bitrix:menu", "top_menu", Array(
			"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
				"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
				"DELAY" => "N",	// Откладывать выполнение шаблона меню
				"MAX_LEVEL" => "2",	// Уровень вложенности меню
				"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
				"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
				"MENU_CACHE_TYPE" => "N",	// Тип кеширования
				"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
				"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
				"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
				"COMPONENT_TEMPLATE" => "horizontal_multilevel",
				"MENU_THEME" => "site"
			),
			false
		);?>
      <div class="header__right">
        <div class="header-link">
          <div class="header__lang header__lang--scroll">
            <div class="header__lang-wrapper">
              <a href="#" class="lang-option lang-option--scroll uk"></a>
              <a href="#" class="lang-option lang-option--scroll ru"></a>
            </div>
          </div>
        </div>
        <a href="#" class="header-link header-link_icon_gift"></a>
      </div>
    </div>
  </div>
  <div class="header__top header__top_mobile">
    <div class="header__inner">
      	<?$APPLICATION->IncludeComponent("bitrix:menu", "mobile_menu", Array(
			"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
				"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
				"DELAY" => "N",	// Откладывать выполнение шаблона меню
				"MAX_LEVEL" => "2",	// Уровень вложенности меню
				"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
				"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
				"MENU_CACHE_TYPE" => "N",	// Тип кеширования
				"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
				"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
				"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
				"COMPONENT_TEMPLATE" => "horizontal_multilevel",
				"MENU_THEME" => "site"
			),
			false
		);?>
		<?$APPLICATION->IncludeFile(SITE_DIR."/inc/logo_mob.php", array(), array(
				"MODE" => "html",
				"NAME" => "logo_mob",
			)
		);?>
    </div>
  </div>
  <div class="header__bottom header__bottom_mobile">
    <div class="header__inner">
	  <div class="header__left_mobile">
		<a href="#" class="header-link header-link_icon_gift"></a>
	  </div>
      <div class="header__promo">
        &nbsp;
        <!-- Промокод активирован! -->
      </div>
      <div class="header__right">
        <a href="lk-favourites.html" class="header-link header-link_icon_fav">
          <span class="header-link__counter">2</span>
        </a>
        <?
          global $USER;
          if ($USER->IsAuthorized()){
          ?>
            <a href="<?=SITE_DIR?>personal/" class="header-link header-link_icon_user">
              <!-- <span class="header-link__counter">2</span> -->
            </a>
          <?}else{?>
            <a href="<?=SITE_DIR?>login/" class="header-link header-link_icon_user">
              <!-- <span class="header-link__counter">2</span> -->
            </a>
        <?}?>
        <a href="basket.html" class="header-link header-link_icon_cart">
          <span class="header-link__counter">20</span>
        </a>
      </div>
    </div>
  </div>
</header>


	<main class="page__main">
	
	<?$curPage = $APPLICATION->GetCurPage();?>
	<?if ($curPage != '/'):?>
		<?$APPLICATION->IncludeComponent(
      "bitrix:breadcrumb",
      "",
      Array(
        "PATH" => "",
        "SITE_ID" => "s1",
        "START_FROM" => "0"
      )
    );?>
	<?endif;?>
