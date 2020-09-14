<ul class="footer__top-list">
    <li class="footer__top-title">
        <?=$arParams['TITLE']?>
    </li>
    <?php
        foreach ($arResult as $menuItem)
        {
            ?>
            <li class="footer__top-item">
                <a class="footer__top-link" href="<?=$menuItem['LINK']?>">
                    <?=$menuItem['TEXT']?>
                </a>
            </li>
            <?
        }
    ?>
</ul>