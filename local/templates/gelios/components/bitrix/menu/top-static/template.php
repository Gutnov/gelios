<div class="top-menu">
    <div class="container">
        <ul class="top-menu__list">
        	<?php
        	foreach ($arResult as $menuItem)
        	{
        		?><li><a href="<?=$menuItem['LINK']?>" class="top-menu__item"><?=$menuItem['TEXT']?></a></li><?
        	}
        	?>
        </ul>
    </div>
    <div class="devider devider_bottom"></div>
</div>
<div class="top-menu__questions-wrapper">
    <div class="container">
        <div class="top-menu__questions">
            <svg role="img" class="ic-support">
                <use xlink:href="#ic-support"></use>
            </svg>
            <div class="top-menu__questions-content">
                <h3 class="top-menu__questions-title">Остались вопросы?</h3>
                <div class="top-menu__questions-text">Обратитесь в нашу службу <br> поддержки</div>
                <button class="simple-button simple-button_questions">Перейти</button>
            </div>

        </div>
    </div>
</div>