<div class="catalog__left">
    <div class="sidebar-menu__wr">
        <div class="sidebar-menu__title">
            Каталог товаров
            <div class="sidebar-menu__close" onclick="o2.popups.mainCatalogMenuHide()">
                <svg role="img" class="close-mobile">
                    <use xlink:href="#close-mobile"></use>
                </svg>
            </div>
            <div class="devider devider_main-catalog"></div>
        </div>
        <?php
            foreach ($arResult['SECTIONS'] as $key => $section)
            {
                ?>
                <ul class="sidebar-menu">
                <li class="catalog-menu__name <?=($key == 0)?'catalog-menu__name_mt0':''?>">
                    <a href="<?=$section['URL']?>"><?=$section['NAME']?></a>
                </li>
                <?php
                    foreach ($section['SECTIONS'] as $subSection)
                    {
                        ?>
                        <li class="catalog-menu__item">
                            <a href="<?=$subSection['URL']?>"><?=$subSection['NAME']?></a>
                        </li>
                        <?
                    }
                ?>
                <li class="sidebar-menu__buttons">
                    <div class="sidebar-menu__show sidebar-menu--btn-active" onclick="o2.popups.sidebarMenuShowOther(this)">Смотреть всё
                        <svg role="img" class="ic-down-arrow">
                            <use xlink:href="#ic-down-arrow"></use>
                        </svg>
                    </div>
                    <div class="sidebar-menu__hide" onclick="o2.popups.sidebarMenuHideOther(this)">Скрыть
                        <svg role="img" class="ic-up-arrow">
                            <use xlink:href="#ic-up-arrow"></use>
                        </svg>
                    </div>
                </li>
                </ul>
                <?
            }
        ?>
    </div>
</div>