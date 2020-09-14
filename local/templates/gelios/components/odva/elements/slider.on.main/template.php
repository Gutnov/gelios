<div class="main-slider">
    <div class="main-slider__wrapper">
        <?php
            foreach ($arResult['ITEMS'] as $slideItem)
            {
                ?>
                <div class="main-slider__item">
                    <picture>
                        <source data-srcset="<?=CFile::GetPath($slideItem['PROPERTIES']['PICTURE_288x240_1X']['~VALUE'])?> 1x, <?=CFile::GetPath($slideItem['PROPERTIES']['PICTURE_288x240_2X']['~VALUE'])?> 2x" media="(max-width: 740px)">
                        <source data-srcset="<?=CFile::GetPath($slideItem['PROPERTIES']['PICTURE_1000x240_1X']['~VALUE'])?> 1x, <?=CFile::GetPath($slideItem['PROPERTIES']['PICTURE_1000x240_2X']['~VALUE'])?> 2x">
                        <img class="lazy-image" data-src="img/banner-1000-x-240.png" alt="">
                    </picture>
                    <div class="main-slider__text">
                        <h2><?=$slideItem['NAME']?></h2>
                        <div class="main-slider__sale"><?=$slideItem['PROPERTIES']['LITLE_TITLE']['~VALUE']?></div>
                        <a href="<?=$slideItem['PROPERTIES']['LINK']['~VALUE']?>" class="more-btn">Подробнее</a>
                    </div>
                </div>
                <?
            }
        ?>
    </div>
    <div class="main-slider__arrows-prev slider-prev">
        <svg role="img" class="left-normal">
            <use xlink:href="#left-normal"></use>
        </svg>
        <svg role="img" class="left-hover">
            <use xlink:href="#left-hover"></use>
        </svg>
    </div>
    <div class="main-slider__arrows-next slider-next">
        <svg role="img" class="right-normal">
            <use xlink:href="#right-normal"></use>
        </svg>
        <svg role="img" class="right-hover">
            <use xlink:href="#right-hover"></use>
        </svg>
    </div>
</div>