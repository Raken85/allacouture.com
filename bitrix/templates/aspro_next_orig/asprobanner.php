<?
/*
add to header.php
<script type="text/javascript">
$(document).ready(function(){
	$.ajax({
		url: '<?=SITE_TEMPLATE_PATH?>/asprobanner.php',
		type: 'post',
		success: function(html){
			if(!$('.form_demo-switcher').length){
				$('body').append(html);
			}
		}
	});
});
</script>
*/
?>
<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?CAsproBanner::Init(array(
	'MODULE_NAME' => 'aspro.next',
	'MODULE_NAME_SHORT' => 'next',
	'JIVOSITE_WID' => 'OA65oj6ZPH',
	'ROISTAT_ID' => 0,
	'SHOW_FORM' => true,
	'FORM_ID' => '15',
	'FORM_SCRIPTS' => false,
	'SCRIPTS' => array(
		'VK' => array(
			'demo' => "<script type=\"text/javascript\">(window.Image ? (new Image()) : document.createElement('img')).src = 'https://vk.com/rtrg?p=VK-RTRG-146222-dO8u8';</script>",
		),
		'FB' => "<!-- Facebook Pixel Code -->
			<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
			n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
			document,'script','//connect.facebook.net/en_US/fbevents.js');

			fbq('init', '479393465598449');
			fbq('track', \"PageView\");</script>
			<noscript><img height=\"1\" width=\"1\" style=\"display:none\"
			src=\"https://www.facebook.com/tr?id=479393465598449&ev=PageView&noscript=1\"
			/></noscript>
			<!-- End Facebook Pixel Code -->",
	),
));?>
<?
class CAsproBanner{
	static $arConfig = array();

	static function IsCompositeEnabled(){
		static $result;
		if($result == NULL){
			$result = false;
			if(class_exists('CHTMLPagesCache')){
				if(method_exists('CHTMLPagesCache', 'GetOptions')){
					if($arHTMLCacheOptions = CHTMLPagesCache::GetOptions()){
						if($arHTMLCacheOptions['COMPOSITE'] === 'Y'){
							$result = true;
						}
					}
				}
			}
		}
		return $result;
	}

	static function Init($arConfig){
		self::$arConfig = $arConfig;

		self::ShowScripts();
		if(strpos($_SERVER['SERVER_NAME'], 'partner') === false){
			if(self::IsCompositeEnabled()){
				Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("asprobanner-banner-block");
			}
			?>
			<?//$_COOKIE["ASPROBANNER"] = 1;?>
			<?if(!isset($_REQUEST["noads"])):?>
				<?if(!$GLOBALS['USER']->IsAdmin()):?>
					<?self::ShowRoistat();?>
					<?self::ShowJivoSite();?>
					<?self::ShowDemoForm();?>
				<?endif;?>
			<?else:?>
				<script type="text/javascript">
				$(document).ready(function() {
					document.cookie="ASPROBANNER=0; path=/;";
					document.cookie="ASPROJIVOSITE=0; path=/;";
				});
				</script>
			<?endif;?>
			<?
			if(self::IsCompositeEnabled()){
				Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("asprobanner-banner-block", "");
			}
		}
	}

	static function ShowRoistat(){
		?>
		<?if(self::$arConfig['ROISTAT_ID']):?>
			<script type="text/javascript">
			(function(w, d, s, h, id) {
			w.roistatProjectId = id; w.roistatHost = h;
			var p = d.location.protocol == "https:" ? "https://" : "http://";
			var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
			var js = d.createElement(s); js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
			})(window, document, 'script', 'cloud.roistat.com', '<?=self::$arConfig['ROISTAT_ID']?>');
			</script>
		<?endif;?>
		<?
	}

	static function ShowJivoSite(){
		?>
		<?if(self::$arConfig["JIVOSITE_WID"] && (!isset($_COOKIE["ASPROJIVOSITE"]) || $_COOKIE["ASPROJIVOSITE"] !== "0")):?>
			<!-- BEGIN JIVOSITE CODE {literal} -->
			<script type="text/javascript">
			(function(){ var widget_id = '<?=self::$arConfig["JIVOSITE_WID"]?>';
			var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
			<!-- {/literal} END JIVOSITE CODE -->
		<?endif;?>
		<?
	}

	static function ShowScripts(){
		if(array_key_exists('SCRIPTS', self::$arConfig)){
			foreach(self::$arConfig['SCRIPTS'] as $script => $code){
				if(is_array($code)){
					foreach($code as $site => $code_){
						if(strlen($code_)){
							if(strpos($_SERVER['SERVER_NAME'], $site) !== false){
								echo $code_;
							}
						}
					}
				}
				else{
					if(strlen($code)){
						echo $code;
					}
				}
			}
		}
	}

	static function ShowDemoForm(){
		?>
		<?if(self::$arConfig['SHOW_FORM'] && (isset(self::$arConfig['FORM_ID']) && self::$arConfig['FORM_ID'])):?>
			<?if(self::$arConfig['FORM_SCRIPTS']):?>
				<script type="text/javascript" src="https://aspro.ru/include/metronic/frontend/plugins/jquery-validation/dist/jquery.validate.min.js?145606232921933"></script>
				<script type="text/javascript" src="https://aspro.ru/include/metronic/frontend/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js?145606232931230"></script>
			<?endif;?>
			<style type="text/css">
				.style-switcher:not(.new1){-webkit-transition:left ease .1s;moz-transition:left ease .1s;ms-transition:left ease .1s;o-transition:left ease .1s;transition:left ease .1s;}
				.style-switcher .header{position: relative;}
				.form_demo-switcher{position:fixed;left:-376px;top:0;width:376px;bottom:0;background:#fff;opacity:0;visibility:hidden;-webkit-transition:left ease 0.3s,opacity ease 0.3s;moz-transition:left ease 0.3s,opacity ease 0.3s;ms-transition:left ease 0.3s,opacity ease 0.3s;o-transition:left ease 0.3s,opacity ease 0.3s;transition:left ease 0.3s,opacity ease 0.3s;}
				.form_demo-switcher.active{left:0px !important;opacity:1;visibility:visible;}
				.form_demo-switcher.ziup{z-index:1060 !important;}
				.form_demo-switcher .switch, .style-switcher .header:after, #theme_switcher:after {
					background:url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACoAAADJCAYAAABVE6B3AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6RjhGRDMwNEQxQjI1MTFFNkI2RjJBRTkyQjQ2REIxQzQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6RjhGRDMwNEUxQjI1MTFFNkI2RjJBRTkyQjQ2REIxQzQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpGOEZEMzA0QjFCMjUxMUU2QjZGMkFFOTJCNDZEQjFDNCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpGOEZEMzA0QzFCMjUxMUU2QjZGMkFFOTJCNDZEQjFDNCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Ph6E0ZEAAAY3SURBVHja7FzPa1RXFL7RiaGtBUNsCoZIUoOCFjUpSiHdlEoW4saFBLo3+Bco/gVBd66aJttCCJF2026CxU27aEoblLRFDSYgCkkTDGgE48/7vckZ7rzMTOLMd987z3cvXN7Mjcg3597z67vnvKamH/9+Y3SNp3bO2jlu54id61jcYfSN3XZ+aec1O/+ws0MrUHcct/MXO1u0A8U4ZudQFoBifJsVoL1ZAdqSFaAmAA1AA9AA9H0Geungp+aLPR96BdrEiEdfn+2Nnn+tPjPXH66a0fll8/jFK31AV84cNa3NO8vWJi3gsYVlc2PpiR6gGOc69pg+u/14fvZRS2n9/tpzc/Xukhm1oFUAjZ/Z4SP7ytZwLAZ+m6v7SNC0HsoEgHMDh8tAYusBDn8f6d1f9/9fYIAEOHe7BeDVe4vRE3/Dv8GxGEwTqICE5CYfPjZj8yvRVrvntNFBAQoNv24ByjZXGlfuLm6SeurKpNYzTZzsrnok/vz6kB6gUBJovDtOtX8cgWS51gJra8Qk4SwOde21pqiTpkg0iV6YeVACC4ACEsp14uYdXS407o3gMuUHqArz3G2GiZpfW4/W42dXRZhXVRo/zehQJpbCBIOf5KBFT7VGz9S/OoA2EmwkCvTyP482eSh3TaUyialimKT8KlMlg++uMaSbL4kyg4/MeyaKRBHN1xoMWocCdKq/x3v0lC9lQrox9VVPxOgh5BucXqDTjhSJghUBWDwlRUZmCtCqkjsJngEWWaj4fOT7rICFnopgy11SF9/bfr6tT5nizHP8e/BM75V5cre5dVfBKtCu4ufmgv2+s6RgKnKmWtrNAEpRplogWXaUIlFITKgbmKPLs48avq7xpkyQ6sWD7RHlKJJk3C9503qEfPBIYj9ZSR7V4MO/jxzvLIFkXS/Szijob/h2CaDdOyZVZzTu64vXOC+L39dfUcgIqsEXo48jUI1JSRXowO9zEUCxp92RZypseCpFQQnzLCa29bWSPkg+VaBi5N81jU4cqNwr+YxXCyaBwXCjVKBxCnwryjxVifq6yqECFQlK/ZN68wTfz64so3kmcZ/wTqh/gmmSKEqsQiPa7y0LlcqcspiygdjUm3mCUjGvcPKV1+MsokrMPZeusWd4JkoqMvz5vigGrcQzVYsDUgEqYFyigc1HUZM7V3nYeb03Dp9VS0IFKgWDsJ2TG65TbpknSa6U45mcAlZsP9g8uFD8AJYtDTUlAWgAqhUo3CjyefBReLKub+hAL1pDL/k8nogDVAIVjyT2U1VQUmkwbkIyqUyJlBNlQqJuh0PqEq0VJKsCeuP/J6XMU/UZlfydXTiYX63fKuNUx49WY54ZQPO59UGZTIYuxOhZqFwzso0/7YwiDkXQLBE9yt8QOAMwg4Sg3dzFO2sBcPjIoY0WzFUdyiTphsuKCHOiKmcSMOyo3pt5cqXHvr6hABUX6faATpzsokqZAhQFWVAet6IMn7E2trCiy45i24e695pvPinm9L/aYJr5ioV8lmXCnva1fhB9RrslU6I0oJX6lM93tUWl7owEj/6eEoByOf24x0pVogIGabOYKvh5sHmsAhiqwXdTDnboR1UmV3ripWBL3fV6f0AivcuMdIWy9T6DEapEpax9O6PeyJ9yRs91tNLyd69AhXjwCTSfBEQ1SkddEWE1kkwdUJ9EBBVoIxW3QZnKciZy07/3VATBhxuXqmvBKKbH3ZsaBUDlDE7P6zmjiPAFJHIkyZMqvV4pVaBuhI8eUEz3jUWqI3zVlWRuFqqydFh67tARLpouZ1ZVKxsCZ+T18W5GabxmkBCBe1IdlISWYBNagkNLMG+ElmCWjw8twT4Mvhj90BKsmXigaj2UKN59g89QMFbORH0xlfvOHCiVgFTj611wmaB04rfL6uJR+HP4+Kn+A6Vrb1wvMhWNYvDhmeRVX5VMFwMsrZ8JrULuu8ajNRLI/OZMgc0zgc0LbB5nBDbPBDYvsHn1eaEkU5W6gW71utky0xJePfuOqXImgCaRKmdq6/NzRrcTxqm4bNhOGKeOgFC59T6brILWB6ABaAAagAag6sfTrACdzQrQ8SwAxeXV99qB3rLztJ3PCwrBrdn5n50/2PmdnetYfCvAACPTcE3owEhaAAAAAElFTkSuQmCC') no-repeat scroll center center rgba(0, 0, 0, 0);height:201px;position:absolute;right:-42px;top:0px;width:42px;cursor:pointer;border-radius:0 6px 6px 0;opacity:0;
				}
				.form_demo-switcher .body .forms h2{
					background: #009dbf url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAfCAYAAAD5h919AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OUFBRjY1MzUxQ0Q3MTFFNkFCRDg4OTY5NDFBNkY0RDQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OUFBRjY1MzYxQ0Q3MTFFNkFCRDg4OTY5NDFBNkY0RDQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5QUFGNjUzMzFDRDcxMUU2QUJEODg5Njk0MUE2RjRENCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5QUFGNjUzNDFDRDcxMUU2QUJEODg5Njk0MUE2RjRENCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PnGxVqMAAAGBSURBVHja3JbLSsNAFIYnxYWoaLszxZWQFgTdeUHwAXwNFXwPl+5FEbvQrWQtiEsXdSUoCAXXcalNvSHU+B/5A8EmTWZIQvGHj0w659I5czKJCoJAZWADHIFH8AU+QQccgOUsMdIMquA8GK5vcAomTRPNgFsG64E9sMSAU2AF7IN32rTBhEmiMwaQEs0PsXNYUlFLN9Ei6IM30MywBwtcWZ++AzYVFa8tIHPHoKPS9QAO6bMba5HwD+9YivWMXSms0uc+bt76rd+gPsA4qIEXlU1V8Ez72t/JpEThj5bSU6JfRZWk0hM5wAXdyPLDUugQ9esyphPuUQPXG25mEZLmWJPWc9mWF8DWaOc0bMYUubIiWeI0qIOnnFdjAw/0JJFpK2u1/Mi29yZL4XGcWbql81h3xf2sl1E6q8jS7UTG20WWzuTAHe2uM9aYgc+1ycP9P08GP3IA5q1ZXl8l0RVvTiITeWgOtDi+lD1qYtAu48UXftbKC9AP8pPPmA3J8SPAAOjH/g+wOgriAAAAAElFTkSuQmCC') no-repeat scroll 30px 21px;font-size:15px;color:#fff;font-weight:600;padding:26px 60px 29px 81px;text-align:left;margin:0px;position:relative;height:83px;box-sizing:border-box;
				}
				.form_demo-switcher .body .forms h2 .close-tab{position:absolute;content:"";top:35px;right:30px;width:12px;height:12px;background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NzBGQTY0OEUxQ0UyMTFFNjlDMzhEQUU3ODQ0RTc4NjEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NzBGQTY0OEYxQ0UyMTFFNjlDMzhEQUU3ODQ0RTc4NjEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo3MEZBNjQ4QzFDRTIxMUU2OUMzOERBRTc4NDRFNzg2MSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo3MEZBNjQ4RDFDRTIxMUU2OUMzOERBRTc4NDRFNzg2MSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pt2EaE4AAACXSURBVHjalJIxDoMwDEWNBxYESyk9HgOMXIrrAV1asXQJ39JHQq4RwtJbnP+iJE6WUhLUA3zBT+LKQQneyvAAOlAEYev1zNTKnWfwAq2TCvYaZj4Zj3RcmMBIwffWXYgk8WFrHAUviQ9bqdwsPdl9Io1/CD0Jj+RPUg6lDS64BlKunOAzuqCTLFPtr1TbUC6+RgWWTYABAPqEOcI9VJ6DAAAAAElFTkSuQmCC') 0px 0px no-repeat;cursor:pointer;
				}
				.form_demo-switcher .body .forms h2 .close-tab:hover{background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OThBNDk4NkMxRDdDMTFFNkE5QTRFQTY3OEU2OEU0OUUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OThBNDk4NkQxRDdDMTFFNkE5QTRFQTY3OEU2OEU0OUUiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5OEE0OTg2QTFEN0MxMUU2QTlBNEVBNjc4RTY4RTQ5RSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5OEE0OTg2QjFEN0MxMUU2QTlBNEVBNjc4RTY4RTQ5RSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PsosqygAAAB5SURBVHjanFJBDoAgDGu8yhWeIP//ivIe5xaZQVLUuKQJYS3rNiAiUCyKUM8MoXLg5F2xKiIh291WOdnVRc4onSg2ORMFTyQiiuyhtnQvolV7v62IWcSEewje4q8l1nQaNT0/jDWxsfriymBxLroWZ8gfvoZxcAgwAH5juasObWDCAAAAAElFTkSuQmCC') 0px 0px no-repeat;
				}
				.form_demo-switcher .body .forms.success h2 .close-tab{background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDRERUMwMjAxRDdGMTFFNkI4MDc5OTNBMjgwNzRBMzkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDRERUMwMjExRDdGMTFFNkI4MDc5OTNBMjgwNzRBMzkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDowNERFQzAxRTFEN0YxMUU2QjgwNzk5M0EyODA3NEEzOSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDowNERFQzAxRjFEN0YxMUU2QjgwNzk5M0EyODA3NEEzOSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PmTvfD0AAAC7SURBVHjajJI9DsIwDIXdrLDC0p2Kv4GxI3ACLgo3IDMLLBRxARjKHQjvRQG5VhBY+horfraTOhJCkGJ7HIE+/RyMURN9OiJyBWewfm4WD1HmdqcBlj2YgrHD5w4uYA58EmixBzPQgFvBNggMVRUGlinH6z12jwmpmk0SK+bGJyGTJFYcNdK1ID/Mmer6zE3yuz/iy/l56VUuiXPoYT3kLmgKcU41O5Rgkrsg/NZ0Kt+jr/54GhX9lwADAMkAi40HsqxcAAAAAElFTkSuQmCC') 0px 0px no-repeat;
				}
				.form_demo-switcher .body .forms.success h2 .close-tab:hover{background: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAwAAAAMCAYAAABWdVznAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Mzk4NEIxQjkxRDdGMTFFNjk4MkFDQTNEMkVFNDJDQjMiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6Mzk4NEIxQkExRDdGMTFFNjk4MkFDQTNEMkVFNDJDQjMiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDozOTg0QjFCNzFEN0YxMUU2OTgyQUNBM0QyRUU0MkNCMyIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDozOTg0QjFCODFEN0YxMUU2OTgyQUNBM0QyRUU0MkNCMyIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pqn62mcAAACMSURBVHjanJI7CoAwEEQ3ptQ2KbQ397+EHkALtdcTWKsTWCGEUcGFRyA7s58QY60VRAs2sAuPCtRgKVQ8gQ44Io53vWqCoEMFRnDq6WJXxSW5IWrvhCcmxwpJUi030a6pITexEaXIFjzlK/6OxJb2T0uXL8/q2bO24GALZqaoCUa/RgDrx9dowHwJMAAQaTdwORoP/AAAAABJRU5ErkJggg==') 0px 0px no-repeat;
				}
				.form_demo-switcher .error-block-form{padding: 27px 30px 0px;margin: 0px 0px -20px;}
				.style-switcher .header:after {display:block;content:'';top:43px;}
				.form_demo-switcher + .style-switcher .header:after {display: none;}
				#theme_switcher:after {content:'';display:block;top:50%;margin-top:-100%;right:-44px;box-shadow: 4px 4px 15px;}
				#theme_switcher .form_demoarea {width:42px;height:229px;position:absolute;top:0;cursor:pointer;right:-44px;top:50%;margin-top:-100%;z-index:102;}
				#theme_switcher.closed {display:none;}
				.form_demo-switcher + #theme_switcher.closed {z-index: 99;}
				.form_demo-switcher .body{height:100%;margin:0px !important;}
				.form_demo-switcher .body .forms{height:100%;}
				.form_demo-switcher .body .forms *{font-family: Arial, Helvetica, sans-serif;}
				.form_demo-switcher .body .forms form{overflow-y:auto;overflow-x:hidden;position:absolute;top:83px;bottom:0;}
				.form_demo-switcher .body .forms form::-webkit-scrollbar{width: 8px;}
				.form_demo-switcher .body .forms form::-webkit-scrollbar-track{border-radius: 8px;}
				.form_demo-switcher .body .forms form::-webkit-scrollbar-thumb{border-radius: 8px;background:#999;border:2px solid #fff;}
				.form_demo-switcher .body .forms form::-webkit-scrollbar-thumb:window-inactive {background:#999;border:2px solid #fff;}
				.form_demo-switcher .body .forms .body_block{padding:27px 30px;color:#36444a;font-size:13px;}
				.form_demo-switcher .body .forms.success .body_block{font-size:14px;}
				.form_demo-switcher .body .forms.success h2{background: #f7f8f8 url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAAfCAYAAACCox+xAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTgxMTcxMzkxRDdFMTFFNjhCMURDRTlCRDRCQTVDNEEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OTgxMTcxM0ExRDdFMTFFNjhCMURDRTlCRDRCQTVDNEEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5ODExNzEzNzFEN0UxMUU2OEIxRENFOUJENEJBNUM0QSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5ODExNzEzODFEN0UxMUU2OEIxRENFOUJENEJBNUM0QSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pj9XrgkAAAGfSURBVHja3JexS8NAFMabIihitaMtxUWqIIjiYF2Kgy7d3UQHKwj+G4IO/gGCWhHdlDqqlEoXBUUHJ0EHwaVd1VZwsn4nX+CWNNfwQmIf/LhHeO/y5d3l5WJFCpWIT5YFi2AeDIEf8AbK4BDc68GWD0LiYA8stIhpgmOwDr7UhaiwiAFQoYgG2AAToA/EQAZsg2+wDK5Arx8VOQJL4AXkwKtDXBpcgGFwAPKSQsbBI592Cjy7xI+BB9ANJiWXZoVLvWsgQtkT2GHOmqSQOY6nbeSccJyVFJLWntTU7MqlJIX0cHxvI8eOjUcjIbHQCVHrWwQf7Hpe0Ltmk3MVtb3jZDcK1UdG4NyxNfthah/MuL3SqiJbFHEJkn/dVoYk51Rzb7qpVRVRJexnYk24GglQBXXeo2VF7ICaD8tizxn7d2+NqeVY6ir9wIQUuO4J+qFoaFaQQlY1Px+kkHMHv/O+NYFbl4eca+mN6lVItuPPI5/aB0raBjk2TISU6e9riRKW0rpvyeQYMIrxNgwHIxUwDc54bpCyOufMmPxw/QowADXZYEBXmDMcAAAAAElFTkSuQmCC') no-repeat scroll 30px 21px;color:#009dbf;
				}
				.form_demo-switcher .body .forms .body_block .star{color:#d2362f;font-size:13px;font-weight: normal;line-height: 0;margin: 0 0 0 1px;position: relative;top:0px;}
				.form_demo-switcher .body .forms .body_block input{color:#000000;font-size:15px;background:#f0f4f8;border:1px solid #d3dbe5;line-height:20px;border-radius:2px;padding:9px 13px;height: auto;width:100%;box-sizing:border-box;}
				.form_demo-switcher .body .forms .body_block label{padding:0px 0px 5px;display:block;font-size: 13px;}
				.form_demo-switcher .body .forms .body_block label.error {color: #e62222 !important;font-size: 12px;position: absolute;top: 1px;right: 0px;}
				.form_demo-switcher .body .forms .body_block input.error{background: #fdf4f4;border-color:#e62222 }
				.form_demo-switcher .body .forms .body_block .more_text{color:#88888a;font-size:12px;display: block;margin: 3px 0px 0px 0px;}
				.form_demo-switcher .body .forms .body_block .form-group{margin: 0px 0px 14px;position:relative;}
				.form_demo-switcher .body .forms .body_block button{cursor: pointer;font-size: 16px;line-height: 20px;background: #00acf5;color: #fff;font-weight:600;-webkit-border-radius: 2px;-moz-border-radius: 2px;border-radius: 2px;text-align: center;padding: 10px 18px 12px;display: inline-block;border: none;outline: none;position: relative;width: auto;vertical-align: middle;-webkit-appearance: none;text-transform: none;}
				.form_demo-switcher .body .forms .body_block button:hover, .form_demo-switcher .body .forms .body_block button:active, .form_demo-switcher .body .forms .body_block button:active{background:#32bdf6;}
				.form_demo-switcher .body .forms .body_block .form-footer{padding:6px 0px 0;margin:0;}
				.fademask_ext{position: fixed;top: 0px;left: 0px;background: #374246;width: 100%;height: 100%;min-height: 100%;opacity: 0.8;z-index: 1050;}
				.style-switcher{z-index:1052;}
				.sp-container.custom_picker_container{z-index:1080;}

				@media (max-width:432px){
					.form_demo-switcher, .fademask_ext{display:none;}
				}
			</style>
			<script type="text/javascript">
				function getAjaxForm(callback){
					$.ajax({
						url:'https://aspro.ru/demo/form/index.php',
						type:'POST',
						data:{
							'AJAX_FORM': 'Y',
							'FORM_ID': <?=self::$arConfig['FORM_ID']?>
						},
						success:function(html){
							var loc = location.origin;

							$('.form_demo-switcher').css({
								'opacity': 1,
								'visibility': 'visible'
							});
							$('.form_demo-switcher .switch').css({
								'opacity': 1,
								'visibility': 'visible'
							});

							$('.form_demo-switcher .body').html(html);
							$('.form_demo-switcher .body .url-input-block-rs').val(loc);
							$('.form_demo-switcher .body .code-input-block-r').val('<?=self::$arConfig['MODULE_NAME']?>');
							$('.form_demo-switcher .body .url-input-block-r').val('<?=self::$arConfig['MODULE_NAME_SHORT']?>');

							if(typeof callback === 'function'){
								callback();
							}
						}
					})
				}

				$(document).ready(function(){
					$(document).on('click', '.fademask_ext', function(){
						$('.form_demo-switcher .close-tab').trigger('click');
					});

					$(document).on('click', '.form_demo-switcher .close-tab', function(){
						$('.form_demo-switcher .switch').trigger('click');
					});

					var $StyleSwitcher = $('.style-switcher').length ? $('.style-switcher') : $('#theme_switcher');
					var isNewStyleSwitcher = $StyleSwitcher.hasClass('style-switcher');
					var $OverSite = $('.oversite_button');
					var $DemoSwitcher = $('.form_demo-switcher');

					setTimeout(function(){
						$('.style-switcher .switch,.style-switcher .switch_presets').unbind('click');
						/*$(document).on('click', '.style-switcher .switch', function(e){
							e.preventDefault();

							if($StyleSwitcher.hasClass('active')){
								// hide style swither
								$StyleSwitcher.addClass('closes');
								setTimeout(function(){
									$StyleSwitcher.removeClass('active');
									if(typeof HideHintBlock === 'function'){
										HideHintBlock();
									}
								}, 200);

								$.removeCookie('styleSwitcher', {path: '/'});
							}
							else{
								if(typeof HideHintBlock === 'function'){
									HideHintBlock();
								}

								if($DemoSwitcher.hasClass('active')){
									// hide demo form
									$DemoSwitcher.removeClass('active');

									setTimeout(function(){
										$DemoSwitcher.removeClass('ziup');
										$('.fademask_ext').remove();

										// show style swither
										if(typeof ShowOverlay === 'function'){
											ShowOverlay();
										}
										$StyleSwitcher.removeClass('closes').addClass('active');
									}, 300);
								}
								else{
									// show style swither
									if(typeof ShowOverlay === 'function'){
										ShowOverlay();
									}
									$StyleSwitcher.removeClass('closes').addClass('active');
								}

								$.cookie('styleSwitcher', 'open', {path: '/'});
							}
						});*/

						$('.style-switcher .switch,.style-switcher .switch_presets').click(function(e){
							e.preventDefault();
							var styleswitcher = $(this).closest('.style-switcher');
							var presets = styleswitcher.find('.presets');
							var parametrs = styleswitcher.find('.parametrs');
							var bSwitchPresets = $(this).hasClass('switch_presets');

							if(styleswitcher.hasClass('active')){

								// current switch type
								var typeSwitcher = $.cookie('styleSwitcherType');

								// change switcher bgcolor
								styleswitcher.find('.switch').removeClass('active');
								styleswitcher.find('.switch_presets').removeClass('active');

								if((bSwitchPresets && typeSwitcher === 'presets') || (!bSwitchPresets && typeSwitcher === 'parametrs')){
									HideHintBlock(true);

									// remove switcher type
									$.removeCookie('styleSwitcherType', {path: '/'});

									// save switcher as hidden
									$.removeCookie('styleSwitcher', {path: '/'});

									// hide switcher with transition
									styleswitcher.addClass('closes');
									setTimeout(function(){
										styleswitcher.removeClass('active');
									}, 500)
								}
								else{
									HideHintBlock(false);

									// save switcher type
									$.cookie('styleSwitcherType', (bSwitchPresets ? 'presets' : 'parametrs'), {path: '/'});

									// hide switcher title
									styleswitcher.find('.header .title').hide();

									// set presets visible or hidden with transition and change switcher bgcolor
									if(bSwitchPresets){
										styleswitcher.find('.header .title.title-presets').show();
										styleswitcher.find('.switch_presets').addClass('active');
										presets.addClass('active');
									}
									else{
										styleswitcher.find('.header .title.title-parametrs').show();
										styleswitcher.find('.switch').addClass('active');
										presets.removeClass('active');
									}
								}
							}
							else{
								HideHintBlock(true);

								if($DemoSwitcher.hasClass('active')){
									// hide demo form
									$DemoSwitcher.removeClass('active');

									setTimeout(function(){
										$DemoSwitcher.removeClass('ziup');
										$('.fademask_ext').remove();

										// change switcher bgcolor
										$(this).addClass('active');

										// save switcher type
										$.cookie('styleSwitcherType', (bSwitchPresets ? 'presets' : 'parametrs'), {path: '/'});

										// hide switcher title
										styleswitcher.find('.header .title').hide();

										// set presets visible or hidden immediately before adding .active to .style-switcher
										if(bSwitchPresets){
											styleswitcher.find('.header .title.title-presets').show();
											presets.addClass('active');
										}
										else{
											styleswitcher.find('.header .title.title-parametrs').show();
											presets.removeClass('active');
										}

										// show overlay
										ShowOverlay();

										// show switcher with transition
										styleswitcher.removeClass('closes').addClass('active');

										// save switcher as open
										$.cookie('styleSwitcher', 'open', {path: '/'});
									}, 300);
								}
								else{
									// change switcher bgcolor
									$(this).addClass('active');

									// save switcher type
									$.cookie('styleSwitcherType', (bSwitchPresets ? 'presets' : 'parametrs'), {path: '/'});

									// hide switcher title
									styleswitcher.find('.header .title').hide();

									// set presets visible or hidden immediately before adding .active to .style-switcher
									if(bSwitchPresets){
										styleswitcher.find('.header .title.title-presets').show();
										presets.addClass('active');
									}
									else{
										styleswitcher.find('.header .title.title-parametrs').show();
										presets.removeClass('active');
									}

									// show overlay
									ShowOverlay();

									// show switcher with transition
									styleswitcher.removeClass('closes').addClass('active');

									// save switcher as open
									$.cookie('styleSwitcher', 'open', {path: '/'});
								}
							}
						});
					}, 50);

					if($StyleSwitcher.length || $OverSite.length){
						var top = ($OverSite.length ? (parseInt($OverSite.css('top')) + $OverSite.outerHeight()) : (isNewStyleSwitcher ? (parseInt($StyleSwitcher.css('top')) + parseInt($StyleSwitcher.find('.switch').css('top')) + $StyleSwitcher.find('.switch').outerHeight()) : (parseInt($StyleSwitcher.css('top')) + $StyleSwitcher.outerHeight()))) + 2;
						var zindex = isNewStyleSwitcher ? 1051 : 100;
						$('<div class="form_demo-switcher" style="z-index:' + zindex + '"><div class="switch" style="top:' + top + 'px;"></div><div class="body"></div></div>').insertBefore((isNewStyleSwitcher ? '.style-switcher' : '#theme_switcher'));
						var $DemoSwitcher = $('.form_demo-switcher');

						getAjaxForm(function(){
							$DemoSwitcher.find('.switch').click(function(){
								if(typeof HideOverlay === 'function'){
									HideOverlay();
								}

								if($DemoSwitcher.hasClass('active')){
									// hide demo form
									$DemoSwitcher.removeClass('active');

									setTimeout(function(){
										$DemoSwitcher.removeClass('ziup');
										$('.fademask_ext').remove();
									}, 300);
								}
								else{
									if($StyleSwitcher.hasClass('active')){
										// hide style swither
										$StyleSwitcher.addClass('closes');
										setTimeout(function(){
											$StyleSwitcher.removeClass('active');

											// show demo form
											$('<div class="fademask_ext"></div>').appendTo($('body'));
											$DemoSwitcher.addClass('ziup');
											$DemoSwitcher.addClass('active');
										}, 200);

										$.removeCookie('styleSwitcher', {path: '/'});
									}
									else{
										// show demo form
										$('<div class="fademask_ext"></div>').appendTo($('body'));
										$DemoSwitcher.addClass('ziup');
										$DemoSwitcher.addClass('active');
									}
								}
							});
						});
					}
				})
			</script>
		<?endif;?>
		<?
	}
}
?>