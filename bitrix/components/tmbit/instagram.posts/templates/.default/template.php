<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<? if (!$_POST["endcursor"]): ?>
<div class="instagram">
	<h1><?=GetMessage("TMBIT_INSTAGRAMPOSTS_MY_V")?></h1>
	<ul class="instagram-list" data-id="<?=$arResult["INSTAGRAM"]["id"]?>" data-endcursor="<?=$arResult["INSTAGRAM"]["end_cursor"]?>">
<? endif; ?>
	<? if (isset($arResult["INSTAGRAM"]["posts"])): ?>
		<? foreach ($arResult["INSTAGRAM"]["posts"] as $key => $post): ?>
			<li>
				<a href="https://www.instagram.com/p/<?=$post->node->shortcode?>" target="_blank">
					<img src="<?=$post->node->thumbnail_src?>">
					<div class="instagram-info">
						<div class="instagram-icon instagram-icon--likes">
							<span><? echo number_format($post->node->edge_media_preview_like->count, 0, '.', ' '); ?> <?=GetMessage("TMBIT_INSTAGRAMPOSTS_")?></span>
						</div>
						<div class="instagram-icon instagram-icon--comments">
							<span><? echo number_format($post->node->edge_media_to_comment->count, 0, '.', ' '); ?> <?=GetMessage("TMBIT_INSTAGRAMPOSTS_")?></span>
						</div>
					</div>
				</a>
			</li>
		<? endforeach; ?>
	<? else: ?>
		<p><?=GetMessage("TMBIT_INSTAGRAMPOSTS_ZAPISI_NE_NAYDENY")?></p>
	<? endif; ?>
<? if (!$_POST["endcursor"]): ?>
	</ul>
	<a class="instagram-more"><?=GetMessage("TMBIT_INSTAGRAMPOSTS_POKAZATQ_ESE")?></a>
</div>
<? endif; ?>
