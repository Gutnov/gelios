<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
$arResult["sUrlPath"] = preg_replace('/page\/[0-9]+\//', '', $arResult["sUrlPath"]);
?>
<div class="whom-list__bottom">
	<?php
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=($arResult["NavPageNomer"]+1)?>/" class="whom-list__button" onclick="o2.popups.manyPayForm(this, event)">показать еще</a>
			<?php
		}
	?>
	<div class="whom-list__pagination">

		<?php
		if($arResult["bDescPageNumbering"] === true)
		{
			?>
			<ul class="">
			<?php
			if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
			{
				if($arResult["bSavePage"])
				{
					?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=($arResult["NavPageNomer"]+1)?>/">
						<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
							<defs>
								<clipPath id="dqlaa">
									<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
								</clipPath>
							</defs>
							<g>
								<g>
									<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
								</g>
							</g>
						</svg>
					</a></li>

					<?php
				}
				else
				{
					if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1))
					{
						?>
						<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
								<defs>
									<clipPath id="dqlaa">
										<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
									</clipPath>
								</defs>
								<g>
									<g>
										<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
									</g>
								</g>
							</svg>
						</a></li>
						<?php
					}
					else
					{
						?>
						<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=($arResult["NavPageNomer"]+1)?>/">
							<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
								<defs>
									<clipPath id="dqlaa">
										<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
									</clipPath>
								</defs>
								<g>
									<g>
										<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
									</g>
								</g>
							</svg>
						</a></li>
						<?php
					}
				}
			}
			else
			{
				?>
				<li><svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
					<defs>
						<clipPath id="dqlaa">
							<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
						</clipPath>
					</defs>
					<g>
						<g>
							<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
						</g>
					</g>
				</svg></li>
				<?php
			}
			?>

			<?php
			while($arResult["nStartPage"] >= $arResult["nEndPage"])
			{
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
				if ($arResult["nStartPage"] == $arResult["NavPageNomer"])
				{
					?>
					<li><?=$NavRecordGroupPrint?></li>
					<?php
				}
				elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false)
				{
					?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a></li>
					<?php
				}
				else
				{
					?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=$arResult["nStartPage"]?>/"><?=$NavRecordGroupPrint?></a></li>
					<?php
				}
				$arResult["nStartPage"]--;
			}
			?>


			<?php
			if ($arResult["NavPageNomer"] > 1)
			{
				?>
				<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=($arResult["NavPageNomer"]-1)?>/">
					<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
						<defs>
							<clipPath id="dqlaa">
								<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
							</clipPath>
						</defs>
						<g>
							<g>
								<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
							</g>
						</g>
					</svg>
				</a></li>
				<?php
			}
			else
			{
				?>
				<li><svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
					<defs>
						<clipPath id="dqlaa">
							<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
						</clipPath>
					</defs>
					<g>
						<g>
							<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
						</g>
					</g>
				</svg></li>
				<?php
			}
			?>

			<?php
		}
		else
		{
			?>

			<ul class="">

			<?php
			if ($arResult["NavPageNomer"] > 1)
			{
				if($arResult["bSavePage"])
				{
					?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=($arResult["NavPageNomer"]-1)?>/">
						<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
							<defs>
								<clipPath id="dqlaa">
									<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
								</clipPath>
							</defs>
							<g>
								<g>
									<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
								</g>
							</g>
						</svg>
					</a></li>

					<?php
				}
				else
				{
					if ($arResult["NavPageNomer"] > 2)
					{
						?>
						<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=($arResult["NavPageNomer"]-1)?>/">
							<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
								<defs>
									<clipPath id="dqlaa">
										<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
									</clipPath>
								</defs>
								<g>
									<g>
										<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
									</g>
								</g>
							</svg>
						</a></li>
						<?php
					}
					else
					{
						?>
						<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
								<defs>
									<clipPath id="dqlaa">
										<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
									</clipPath>
								</defs>
								<g>
									<g>
										<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
									</g>
								</g>
							</svg>
						</a></li>
						<?php
					}
				}
			}
			else
			{
				?>
				<li><svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
					<defs>
						<clipPath id="dqlaa">
							<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
						</clipPath>
					</defs>
					<g>
						<g>
							<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
						</g>
					</g>
				</svg></li>
				<?php
			}
			while($arResult["nStartPage"] <= $arResult["nEndPage"])
			{
				if ($arResult["nStartPage"] == $arResult["NavPageNomer"])
				{
					?>
					<li class="whom-list__bottom_active"><?=$arResult["nStartPage"]?></li>
					<?php
				}
				elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false)
				{
					?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li>
					<?php
				}
				else
				{
					?>
					<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=$arResult["nStartPage"]?>/"><?=$arResult["nStartPage"]?></a></li>
					<?php
				}
				$arResult["nStartPage"]++;
			}
			if($arResult["NavPageNomer"] < $arResult["NavPageCount"])
			{
				?>
				<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryString?>page/<?=($arResult["NavPageNomer"]+1)?>/">
					<svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
						<defs>
							<clipPath id="dqlaa">
								<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
							</clipPath>
						</defs>
						<g>
							<g>
								<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
							</g>
						</g>
					</svg>
				</a></li>
				<?php
			}
			else
			{
				?>
				<li><svg xmlns="http://www.w3.org/2000/svg" width="2.5rem" height="2.1rem" viewBox="0 0 25 21">
					<defs>
						<clipPath id="dqlaa">
							<path fill="#00011d" d="M12.5 20.73L.509.73H24.49z" />
						</clipPath>
					</defs>
					<g>
						<g>
							<path fill="none" stroke-miterlimit="50" stroke-width="8" d="M12.5 20.73v0L.509.73v0H24.49v0z" clip-path="url(&quot;#dqlaa&quot;)" />
						</g>
					</g>
				</svg></li>
				<?php
			}
			?>
			</ul>
			<?php
		}
		?>
	</div>
</div>