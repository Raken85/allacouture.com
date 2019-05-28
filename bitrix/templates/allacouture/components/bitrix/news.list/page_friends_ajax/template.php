<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$APPLICATION->RestartBuffer();
?>

<?foreach($arResult["ITEMS"] as $arItem):?>
<div class="friend-card">
  <div class="friend-card__img">
    <div class="slider slider_friend">
      <?if(!empty($arItem['SIZE_IMG'])):?>
        <?foreach ($arItem['SIZE_IMG'] as $k => $galleryImage):?>
          <div class="slider__slide">
            <img src="<?=$galleryImage['src']?>" alt="<?=$arItem['NAME']?>">
          </div>
        <?endforeach;?>
      <?endif;?>
    </div>
  </div>
    <div class="friend-card__name">
      <span><?=$arItem['NAME']?></span>
      <a href="#">Посмотреть все фото</a>
      <div class="friend-card__hover">
        <h2><?=$arItem['NAME']?></h2>
        <p><?=$arItem['PREVIEW_TEXT']?></p>
        <a href="#" class="friend-card__goto button button_big">
          Перейти в каталог
        </a>
      </div>
    </div>
</div>
<?endforeach;?>
