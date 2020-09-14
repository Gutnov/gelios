<div class="catalog-menu">
    <div class="container">
        <ul class="catalog-menu__wrapper">
        <?php
            foreach ($arResult['SECTIONS'] as $section)
            {
                ?>
                <li class="catalog-menu__name catalog-menu__name_mt0">
                    <a href="<?=$section['URL']?>"><?=$section['NAME']?></a>
                </li>
                <?
                if(!empty($section['SECTIONS']))
                {
                    foreach ($section['SECTIONS'] as $childSection)
                    {
                        ?>
                        <li class="catalog-menu__item">
                            <a href="<?=$childSection['URL']?>"><?=$childSection['NAME']?></a>
                        </li>
                        <?
                    }
                }
            }
            ?>
        </ul>
    </div>
</div>