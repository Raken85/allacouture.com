<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<style>
    .sections_wrapper{
        margin-top: 40px;
    }
    .wraps > .wrapper_inner {
        padding-bottom: 10px;
    }
</style>
<?@include_once('page_blocks/'.$arParams["SECTIONS_TYPE_VIEW"].'.php');?>	
