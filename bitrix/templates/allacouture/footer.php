	</main>

<footer class="page__footer footer">
  <div class="footer__inner">
    <div class="footer__top">
      <nav class="footer__menu footer__menu_1 menu menu_footer">
        <a href="catalog.html" class="menu__link title">Каталог</a>
		<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "foot_menu", Array(
			"ADD_SECTIONS_CHAIN" => "Y",	
				"CACHE_GROUPS" => "Y",	
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",	
				"COUNT_ELEMENTS" => "Y",	
				"IBLOCK_ID" => "11",	
				"IBLOCK_TYPE" => "catalog",	
				"SECTION_CODE" => "",	
				"SECTION_FIELDS" => array(	
					0 => "",
					1 => "",
				),
				"SECTION_ID" => $_REQUEST["SECTION_ID"],	
				"SECTION_URL" => "",	
				"SECTION_USER_FIELDS" => array(	
					0 => "",
					1 => "",
				),
				"SHOW_PARENT_NAME" => "Y",	
				"TOP_DEPTH" => "2",	
				"VIEW_MODE" => "TEXT",	
			),
			false
		);?>
      </nav>
      <nav class="footer__menu footer__menu_2 menu menu_footer">
        <a href="#" class="menu__link title">Медиа</a>
      <?$APPLICATION->IncludeFile(SITE_DIR."/inc/foot_media.php", array(), array(
          "MODE" => "html",
          "NAME" => "foot_media",
        )
      );?>
      </nav>
      <nav class="footer__menu footer__menu_3  menu menu_footer">
        <a href="/сollections/" class="menu__link title">Коллекции</a>
      <?$APPLICATION->IncludeFile(SITE_DIR."/inc/collections_foot.php", array(), array(
          "MODE" => "html",
          "NAME" => "collections_foot",
        )
      );?>
      </nav>


      <a href="/" class="footer__logo logo logo_footer">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/logo_footer.php", array(), array(
					"MODE" => "html",
					"NAME" => "logo_footer",
				)
			);?>

        <div class="footer__alla-copyright">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/copyright.php", array(), array(
					"MODE" => "html",
					"NAME" => "copyright",
				)
			);?>
        </div>
      </a>
      <nav class="footer__menu footer__menu_4 menu menu_footer">
        <a href="#" class="menu__link title">Справка</a>
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/foot_menu_spravka.php", array(), array(
					"MODE" => "html",
					"NAME" => "foot_menu_spravka",
				)
			);?>
      </nav>
      <div class="footer__right-col">
        <div class="footer__social social">
          <div class="social__header">
            Мы в соцсетях:
          </div>
          <div class="social__links">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/social_black.php", array(), array(
					"MODE" => "html",
					"NAME" => "social_black",
				)
			);?>  
          </div>
        </div>
        <div class="footer__messengers messengers">
          <div class="messengers__header">
            Мессенджеры:
          </div>
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/messengers_black.php", array(), array(
					"MODE" => "html",
					"NAME" => "messengers_black",
				)
			);?>
        </div>
        <div class="footer__payments payments">
          <div class="payments__header">
            Способы оплаты:
          </div>
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/payments__links.php", array(), array(
					"MODE" => "html",
					"NAME" => "messengers_black",
				)
			);?>
        </div>
      </div>
    </div>
    <div class="footer__bottom footer__bottom_desktop">
      <div class="footer__pixel-copyright pixel-copyright">
        <a href="https://pixelplus.ru" target="pixelplus">Создание сайта</a> — компания «Пиксель Плюс»
      </div>
      <a href="#" class="footer__feedback-link" data-open-popup="modal-opr">Оставьте Ваше мнение <br> о нашей компании!</a>
		<?$APPLICATION->IncludeComponent(
	"bitrix:voting.current", 
	"template1", 
	array(
		"COMPONENT_TEMPLATE" => "template1",
		"CHANNEL_SID" => "-",
		"VOTE_ID" => "2",
		"VOTE_ALL_RESULTS" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600"
	),
	false
);?>
      <button class="footer__email-btn" data-open-popup="modal-feedback">Написать руководителю</button>
    </div>
    <div class="footer__bottom footer__bottom_tablet">
      <div class="footer__bottom-col">
        <div class="footer__payments payments">
          <div class="payments__header">
            Способы оплаты:
          </div>
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/payments__links.php", array(), array(
					"MODE" => "html",
					"NAME" => "messengers_black",
				)
			);?>
        </div>
        <div class="footer__pixel-copyright pixel-copyright">
          <a href="https://pixelplus.ru" target="pixelplus">Создание сайта</a> — компания «Пиксель Плюс»
        </div>
      </div>
      <div class="footer__bottom-col">
        <button class="footer__email-btn" data-open-popup="modal-feedback">Написать руководителю</button>
      </div>
      <div class="footer__bottom-col">
        <div class="footer__messengers messengers">
          <div class="messengers__header">
            Мессенджеры:
          </div>
          <div class="messengers__links">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/messengers__links_f.php", array(), array(
					"MODE" => "html",
					"NAME" => "messengers__links_f",
				)
			);?> 
          </div>
        </div>
        <div class="footer__social social">
          <div class="social__header">
            Мы в соцсетях:
          </div>
          <div class="social__links">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/social_black_f.php", array(), array(
					"MODE" => "html",
					"NAME" => "social_black_f",
				)
			);?> 
          </div>
        </div>
        <a href="#" class="footer__feedback-link" data-open-popup="modal-opr">Оставьте Ваше мнение о нашей компании!</a>
<?$APPLICATION->IncludeComponent("bitrix:voting.current", "template1", Array(
	"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHANNEL_SID" => "-",	// Группа опросов
		"VOTE_ALL_RESULTS" => "Y",	// Показывать варианты ответов для полей типа Text и Textarea
		"VOTE_ID" => "2",	// ID опроса
	),
	false
);?>
      </div>
    </div>
<!-- Добавил 2 дива -->
    </div>
    </div>
<!--END Добавил 2 дива -->
    <div class="footer__bottom footer__bottom_mobile">
      <div class="footer__messengers messengers">
        <div class="messengers__header">
          Мессенджеры:
        </div>
        <div class="messengers__links">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/messengers__links_f.php", array(), array(
					"MODE" => "html",
					"NAME" => "messengers__links_f",
				)
			);?>
        </div>
      </div>
      <div class="footer__social social">
		<?$APPLICATION->IncludeFile(SITE_DIR."/inc/footer__social.php", array(), array(
				"MODE" => "html",
				"NAME" => "footer__social",
			)
		);?>
        <div class="social__header">
          Мы в соцсетях:
        </div>
        <div class="social__links">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/social_black_f.php", array(), array(
					"MODE" => "html",
					"NAME" => "social_black_f",
				)
			);?> 
        </div>
      </div>
      <button class="footer__email-btn" data-open-popup="modal-friends">Написать руководителю</button>
		<?/*//COption::GetOptionString("main", "email_from");
 $APPLICATION->IncludeComponent(
    "bitrix:main.feedback",
    "contact_friend",
    Array(
        "EMAIL_TO" => "flayder111@yandex.ua",
        "EVENT_MESSAGE_ID" => array(),
        "OK_TEXT" => "Спасибо, ваше сообщение принято.",
        "REQUIRED_FIELDS" => array(),
        "USE_CAPTCHA" => "N"
    )
);*/?>
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "test_plus", Array(
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
		"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
		"EDIT_URL" => "",	// Страница редактирования результата
		"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
		"LIST_URL" => "",	// Страница со списком результатов
		"SEF_MODE" => "N",	// Включить поддержку ЧПУ
		"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
		"USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
		"WEB_FORM_ID" => "2",	// ID веб-формы
		"COMPONENT_TEMPLATE" => ".default",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>
      <a href="#" class="footer__feedback-link" data-open-popup="modal-feedback">Оставьте Ваше мнение о нашей компании!</a>
      <a href="index.html" class="footer__logo logo logo_footer">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/logo_footer.php", array(), array(
					"MODE" => "html",
					"NAME" => "logo_footer",
				)
			);?>
        <div class="footer__alla-copyright">
			<?$APPLICATION->IncludeFile(SITE_DIR."/inc/copyright.php", array(), array(
					"MODE" => "html",
					"NAME" => "copyright",
				)
			);?>
        </div>
      </a>
      <div class="footer__pixel-copyright pixel-copyright">
        <a href="https://pixelplus.ru" target="pixelplus">Создание сайта</a> — компания «Пиксель Плюс»
      </div>
    </div>
  </div>
  <button class="footer__scroll-top-btn js-tipsy " original-title="Наверх"></button>
  <ul class='socials-hover'>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
	<li class='social-hover__item'></li>
  </ul>
</footer>
<!-- /подвал -->

<div class="modal-overlay closed"></div>

<div class="modal closed" id="modal-hello">
			
			<?$APPLICATION->IncludeComponent("bitrix:main.register", "popap_reg", 
array(
		"AUTH" => "Y",
		"COMPONENT_TEMPLATE" => "temp",
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
		),
		"SET_TITLE" => "N",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "PERSONAL_PHONE",
		),
		"SUCCESS_PAGE" => "",
		"USER_PROPERTY" => array(
			0 => "UF_FIO",
		),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "N"
	),
	false
);?>

  <!-- Если открывать через fancybox то он не нужен -->
  <!-- <button class="modal__close">✕</button> -->
</div>
	<?
	global $USER;
if ($USER->IsAuthorized()):
?>
	<script>
		window.no_hello_popup = true;
	</script>
<? endif; ?>

</body>
</html>
