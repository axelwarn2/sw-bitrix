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
$Img = SITE_TEMPLATE_PATH.'/img/rew/no_photo.jpg';
?>
<?php foreach($arResult["ITEMS"] as $arItem): ?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
	if (isset($arItem["PREVIEW_PICTURE"]["SRC"])) {
		$Img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width' => 39, 'height' => 39), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$Img = $Img["src"];
	}
	?>

	<div class="item">
		<div class="side-block side-opin">
			<div class="inner-block">
				<div class="title">
					<div class="photo-block">
						<img src="<?=$Img?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
					</div>
					<div class="name-block"><a href="<?= $arItem["DETAIL_PAGE_URL"]."/"?>"><?=$arItem["NAME"];?></a></div>
					<div class="pos-block"><?= $arItem["PROPERTIES"]["COMPANY"]["VALUE"]?>,
					<?= $arItem["PROPERTIES"]["POSITION"]["VALUE"]?></div>
				</div>
				<div class="text-block"><?=substr($arItem["PREVIEW_TEXT"], 0, 150 );?>...</div>
			</div>
		</div>
	</div>
<?endforeach;?>
