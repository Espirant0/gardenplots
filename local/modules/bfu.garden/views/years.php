<?php
/**
 * @var CMain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Gardens");

$APPLICATION->IncludeComponent('bfu:contributions_by_years', '', []);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>