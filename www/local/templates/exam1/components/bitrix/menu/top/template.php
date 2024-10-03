<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<?php if (!empty($arResult)): ?>
<nav class="nav">
    <div class="inner-wrap">
        <div class="menu-block popup-wrap">
            <a href="#" class="btn-menu btn-toggle"></a>
            <div class="menu popup-block">
                <ul class="">
                    <li class="main-page"><a href="/">Главная</a>
                    </li>
                    <?php
						$previousLevel = 0;

						foreach ($arResult as $arItem): ?>
                    <?php if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
                    <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
                    <?php endif; ?>

                    <?php if ($arItem["IS_PARENT"]): ?>
                    <?php if ($arItem["DEPTH_LEVEL"] === 1): ?>
                    <li>
                        <a href="<?= $arItem["LINK"] ?>" class="<?= $arItem["SELECTED"] ? 'root-item-selected' : 'root-item' ?> 
											<?= $arItem['PARAMS']['COLOR_STYLE'] ?? '' ?>">
                            <?= $arItem["TEXT"] ?>
                        </a>
                        <ul>
                            <?php else: ?>
                            <li<?= $arItem["SELECTED"] ? ' class="item-selected"' : '' ?>>
                                <a href="<?= $arItem["LINK"] ?>" class="parent"><?= $arItem["TEXT"] ?> </a>
                                <ul>
                                    <?php endif; ?>

                                    <?php if (!empty($arItem['PARAMS']['DESCRIPTION'])): ?>
                                    <div class="menu-text">Это текст для пункта "<?= $arItem["TEXT"] ?>"</div>
                                    <?php endif; ?>

                                    <?php else: ?>
                                    <?php if ($arItem["PERMISSION"] > "D"): ?>
                                    <?php if ($arItem["DEPTH_LEVEL"] === 1): ?>
                                    <li>
                                        <a class="<?= $arItem['PARAMS']['COLOR_STYLE'] ?? '' ?>"
                                            href="<?= $arItem["LINK"] ?>"
                                            class="<?= $arItem["SELECTED"] ? 'root-item-selected' : 'root-item' ?>">
                                            <?= $arItem["TEXT"] ?>
                                        </a>
                                    </li>
                                    <?php else: ?>
                                    <li<?= $arItem["SELECTED"] ? ' class="item-selected"' : '' ?>>
                                        <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    </li>
                    <?php endif; ?>
                    <?php else: ?>
                    <li>
                        <a href="#"
                            class="<?= $arItem["DEPTH_LEVEL"] === 1 ? ($arItem["SELECTED"] ? 'root-item-selected' : 'root-item') : 'denied' ?>"
                            title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>">
                            <?= $arItem["TEXT"] ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php $previousLevel = $arItem["DEPTH_LEVEL"]; ?>
                    <?php endforeach; ?>

                    <?php if ($previousLevel > 1): ?>
                    <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
                    <?php endif; ?>
                </ul>
                <div class="menu-clear-left"></div>
                <a href="#" class="btn-close"></a>
            </div>
            <div class="menu-overlay"></div>
        </div>
    </div>
</nav>
<?php endif; ?>
