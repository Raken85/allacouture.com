<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<? if (!$_POST["endcursor"]): ?>

<section class="page__section section section_bg_letters">
      <div class="section__inner section__inner_border_bottom">
        <a class="section__header" href="https://www.instagram.com/allacouture/">
          @allacouture <br>
          <?=GetMessage("TMBIT_INSTAGRAMPOSTS_MY_V")?>
        </a>
        <div class="section__content">
          <div class="instagram"  data-id="<?=$arResult["INSTAGRAM"]["id"]?>" data-endcursor="<?=$arResult["INSTAGRAM"]["end_cursor"]?>">
<? endif; ?>
	<? if (isset($arResult["INSTAGRAM"]["posts"])): ?>
		<?$i=0; foreach ($arResult["INSTAGRAM"]["posts"] as $key => $post):
			if ($i>=6) break;?>
			<div class="instagram__item">
              <img src="<?=$post->node->thumbnail_src?>">
            </div>
		<? $i++; endforeach;?>
	<? else: ?>
		<p><?=GetMessage("TMBIT_INSTAGRAMPOSTS_ZAPISI_NE_NAYDENY")?></p>
	<? endif; ?>
<? if (!$_POST["endcursor"]): ?>

</div>
        </div>
      </div>
    </section>
<? endif; ?>
