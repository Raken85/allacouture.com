<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$bxajaxid = CAjax::GetComponentID($component->__name, $component->__template->__name);
if($_GET["bxajaxid"]) $APPLICATION->RestartBuffer();
?>
<?if(!$_GET["bxajaxid"]):?>
<section class="page__section section section_small page__section--friends" id="section-friends">
  <div class="section__inner">
    <div class="section__before-text">
		<a class="section__header" href="/friends/">
		Наши друзья
		</a>
    </div>
<?endif;?>
    <?if(!empty($arResult['ITEMS'])):?>
    <?if(!$_GET["bxajaxid"]):?>  
    <div class="section__content">
      <div class="friends">
        <div class="friends__catalog">
          
          <div class="friends__catalog-header">
			  <?/*form class="friends__catalog-search" action="/search/index.php" method="GET">
              <input type="text" name="q" placeholder="Поиск по друзьям">
              <button type="submit"></button>
            </form>
			  <button class="friends__become button button_big" data-open-popup="modal-friends">Стать другом</button*/?>
            <?if($arParams["DISPLAY_TOP_PAGER"]):?>
			  <?= preg_replace('/href="(\/[^"]*)"/', 'href="$1#section-friends"', $arResult["NAV_STRING"]) ?><br />
            <?endif;?>
          </div>
          <div class="friends__catalog-list" id="comp_<?=$bxajaxid?>">
        <?endif;?>
		
		
			<?
				$i = 1;
				foreach($arResult["ITEMS"] as $ex => $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
								<div class="friend-card" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="friend-card__img">
					<div class="slider slider_friend">
					
					  <?/*if(!empty($arItem['SIZE_IMG'])):?>
						<?foreach ($arItem['SIZE_IMG'] as $k => $galleryImage):?>
						  <div class="slider__slide">
						  <img src="<?=$galleryImage['src']?>" data-src="<?=$galleryImage['src']?>" rel="gallery-group" data-lightgroup="gallery-group">
						  </div>
						<?endforeach;?>
					  <?endif;*/?>
					  
						<?if(is_array($arItem["DETAIL_PICTURE"])):?>
						<div class="slider__slide">
							<img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" data-src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
							<!-- Это кнопка перехода в каталог для первого фото. прям нужную ссылку можно вставлять-->
									<?if($arItem["PROPERTIES"]["GALLERY"]["VALUE"]>""):?>
										<a href="#" class="button js-button-fancy-catalog button-fancy-catalog">Перейти в каталог <?= $ex + 1?></a>
									<?endif;?>
						</div>
						<?elseif(is_array($arItem["PREVIEW_PICTURE"])):?>
						<div class="slider__slide">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" data-src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
							<!-- Это кнопка перехода в каталог для первого фото. прям нужную ссылку можно вставлять-->
									<?if($arItem["PROPERTIES"]["GALLERY"]["VALUE"]>""):?>
										<a href="#" class="button js-button-fancy-catalog button-fancy-catalog">Перейти в каталог <?= $ex + 1?></a>
									<?endif;?>
						</div>
						<?endif?>
						
						<?foreach ($arItem["PROPERTIES"]["GALLERY"]["VALUE"] as $ex => $files):?> 
						<? $arFile = CFile::GetFileArray($files); 
							if( $arFile) :?>
								<div class="slider__slide">
									<img src="<?=$arFile["SRC"]?>" data-src="<?=$arFile["SRC"]?>" rel="gallery-group-<?=$i?>" data-lightgroup="gallery-group-<?=$i?>">
									<!-- Это кнопка перехода в каталог для фото в слайдере который скрыт. Но туда выводятся все остальные картинки из компонента-->

									<?if($arItem["PROPERTIES"]["GALLERY"]["VALUE"]>""):?>
										<a href="#" class="button js-button-fancy-catalog button-fancy-catalog">Перейти в каталог <?= $ex + 1?></a>
									<?endif;?>
								</div>
							<? endif; ?> 
						<?endforeach?>
		
					</div>
				</div>
                <div class="friend-card__name">
                  <span><?=$arItem['NAME']?></span>
					<?if($arItem["PROPERTIES"]["GALLERY"]["VALUE"]>""):?>
						<a href="#" class="js-open-friends-gallery" data-fancy-lightgroup="gallery-group-<?=$i?>">Посмотреть все фото</a>
					<?endif;?>
<?/*foreach ($arItem["1PROPERTIES"]["GALLERY"]["VALUE"] as $files):?> 
	<? $arFile = CFile::GetFileArray($files); 
		if( $arFile) :?>
			<a href="<?=$arFile["SRC"]?>" data-title="<?=$arFile["ORIGINAL_NAME"]?>">
				<img src="<?=$arFile["SRC"]?>" alt="img">
			</a>
		<? endif; ?> 
<?endforeach*/?>

                </div>
				<div class="friend-card__hover">
					<a href="#" class="full js-open-friends-gallery" data-fancy-lightgroup="gallery-group-<?=$i?>"></a>
					<h2><?=$arItem['NAME']?></h2>
					<p><?=$arItem['PREVIEW_TEXT']?></p>
					<?/*a href="#" class="friend-card__goto button button_big">
					  Перейти в каталог
</a*/?>
			  	</div>
            </div>
            <?
	            $i++;
	            endforeach;?>
			
			
            <?if($arResult["NAV_RESULT"]->nEndPage > 1 && $arResult["NAV_RESULT"]->NavPageNomer<$arResult["NAV_RESULT"]->nEndPage):?>
              <div id="btn_<?=$bxajaxid?>" style="width: 100%; text-align: center; margin-top: 25px; -webkit-flex: 0 0 100%;-ms-flex: 0 0 100%;flex: 0 0 100%;max-width: 100%;">
                <button data-ajax-id="<?=$bxajaxid?>" id="ajax_press" data-show-more="<?=$arResult["NAV_RESULT"]->NavNum?>" data-next-page="<?=($arResult["NAV_RESULT"]->NavPageNomer + 1)?>" data-max-page="<?=$arResult["NAV_RESULT"]->nEndPage?>" class="section__showmore button-more--friends button button_big">Показать еще</button>
              </div>
            <?endif;?>
            <?if(!$_GET["bxajaxid"]):?>
          </div>
        </div>
      </div>
    </div>
      
      <?endif;?>
    <?endif;?>
<?if(!$_GET["bxajaxid"]):?>
  </div>
</section>





<div class="modal closed" id="modal-friends">
    <div class="modal__header">
      <span>Стать другом</span>
    </div>
    <div class="modal__before-text modal__before-text_small">
      <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
          "AREA_FILE_SHOW" => "file",
          "AREA_FILE_SUFFIX" => "inc",
          "EDIT_TEMPLATE" => "",
          "PATH" => "/include/friends/quest.php"
        )
      );?>
      
    </div>

<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new", 
	"quest_friends", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "3",
		"COMPONENT_TEMPLATE" => "quest_friends",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
);?>

  </div>



<?else: exit;?>
<?endif;?>


