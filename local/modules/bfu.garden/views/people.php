<?php
/**
 * @var CMain $APPLICATION
 */
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Gardens");

$APPLICATION->IncludeComponent('bfu:people', '', []);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>