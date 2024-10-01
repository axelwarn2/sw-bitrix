<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="inner-wrap">
    <div class="menu-block popup-wrap">
        <a href="" class="btn-menu btn-toggle"></a>
        <div class="menu popup-block">
            <?if (!empty($arResult)):?>
            <ul class="">
                <?php
                $previousLevel = 0;
                foreach($arResult as $arItem):?>

                    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                    <?endif?>

                    <?if ($arItem["IS_PARENT"]):?>
                        <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                            <li><a href="<?=$arItem["LINK"]?>" class="<?=($arItem["SELECTED"]) ? 'root-item-selected' : 'root-item'?>">
                                <?=$arItem["TEXT"]?></a>
                                <ul>
                        <?else:?>
                            <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
                                <a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
                                <ul>
                        <?endif?>
                    <?else:?>
                        <?if ($arItem["PERMISSION"] > "D"):?>
                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                <li><a href="<?=$arItem["LINK"]?>" class="<?=($arItem["SELECTED"]) ? 'root-item-selected' : 'root-item'?>">
                                    <?=$arItem["TEXT"]?></a></li>
                            <?else:?>
                                <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
                                    <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
                            <?endif?>
                        <?else:?>
                            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                <li><a href="" class="<?=($arItem["SELECTED"]) ? 'root-item-selected' : 'root-item'?>" 
                                    title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                            <?else:?>
                                <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                            <?endif?>
                        <?endif?>
                    <?endif?>

                <?php
                $previousLevel = $arItem["DEPTH_LEVEL"];
                endforeach?>

                <?if ($previousLevel > 1):// Закрываем теги для последнего уровня ?>
                    <?=str_repeat("</ul></li>", ($previousLevel - 1));?>
                <?endif?>
            </ul>
            <a href="" class="btn-close"></a>
            <?endif?>
        </div>
        <div class="menu-overlay"></div>
    </div>
</div>
