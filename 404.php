<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>
<style>.right_block.wide_, .right_block.wide_N{float:none !important;width:100% !important;}</style>
<div class="maxwidth-theme">
	<div class="page_error_block">
		<table class="page_not_found" width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td class="image">
					<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="150%" viewBox="0 0 554.66 225.907">
					  <defs>
					    <style>
					      .cls-1 {
					        fill: #1976d2;
					        fill-rule: evenodd;
					      }
					    </style>
					  </defs>
					  <path id="_404.svg" data-name="404.svg" class="cls-1" d="M599.425,435.026h-16.4V320.084a14.937,14.937,0,0,0-4.272-10.759,14.143,14.143,0,0,0-10.6-4.431,15.671,15.671,0,0,0-6.8,1.583,15.183,15.183,0,0,0-5.538,4.43l-101.326,126.9a16.537,16.537,0,0,0-3.481,10.345,14.038,14.038,0,0,0,4.589,10.444,14.441,14.441,0,0,0,10.285,4.43h87.148v48.825a14.869,14.869,0,0,0,15.248,15.19,13.688,13.688,0,0,0,10.323-4.43,14.647,14.647,0,0,0,4.43-10.76V463.027h16.4a14.383,14.383,0,0,0,10.127-3.8,13.3,13.3,0,0,0,4.114-10.061,13.753,13.753,0,0,0-4.114-10.187,14.063,14.063,0,0,0-10.127-3.956h0Zm-46.4-78.865v78.865H490.879Zm176.41,172.79q25.684,0,43.859-14.433t27.412-39.849q9.237-25.414,9.242-58.674t-9.242-58.675q-9.243-25.414-27.412-39.849t-43.859-14.433q-25.692,0-43.86,14.433T658.165,357.32q-9.245,25.416-9.242,58.675t9.242,58.674q9.237,25.416,27.412,39.849t43.86,14.433h0ZM693.879,477.18m297.546-42.154h-16.4V320.084a14.937,14.937,0,0,0-4.272-10.759,14.143,14.143,0,0,0-10.6-4.431,15.671,15.671,0,0,0-6.8,1.583,15.183,15.183,0,0,0-5.538,4.43l-101.326,126.9a16.537,16.537,0,0,0-3.481,10.345,14.038,14.038,0,0,0,4.589,10.444,14.441,14.441,0,0,0,10.285,4.43h87.148v48.825a14.869,14.869,0,0,0,15.248,15.19,13.688,13.688,0,0,0,10.323-4.43,14.647,14.647,0,0,0,4.43-10.76V463.027h16.4a14.375,14.375,0,0,0,10.125-3.8,13.3,13.3,0,0,0,4.12-10.061,13.757,13.757,0,0,0-4.12-10.187,14.055,14.055,0,0,0-10.125-3.956h0Zm-46.4-78.865v78.865H882.879ZM693.879,477.18C685.421,462.746,680.906,442.4,680.906,416s4.254-46.832,12.763-61.291,20.43-21.687,35.768-21.687,27.259,7.229,35.768,21.687S777.968,389.593,777.968,416s-4.254,46.832-12.763,61.29-20.435,21.687-35.768,21.687h0c-15.338,0-27.1-7.359-35.558-21.792" transform="translate(-451 -303.031)"/>
					</svg>
				</td>
				<td class="description">
					<div class="title404">Ошибка 404</div>
					<div class="subtitle404">Страница не найдена</div>
					<div class="descr_text404">Неправильно набран адрес или такой<br />страницы не существует</div><br/>
					<a class="btn btn-default btn-lg" href="<?=SITE_DIR?>"><span>Перейти на главную</span></a>
					<div class="back404">или <a href="javascript://" onclick="history.back();">вернуться назад</a></div>
				</td>
			</tr>
		</table>
	</div>
</div>
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/mainpage/comp_hit.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "standard.php"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>