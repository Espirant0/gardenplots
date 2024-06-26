<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;

function __gardenMigrate(int $nextVersion, callable $callback)
{
	global $DB;
	$moduleId = 'garden';

	if (!ModuleManager::isModuleInstalled($moduleId))
	{
		return;
	}

	$currentVersion = intval(Option::get($moduleId, '~database_schema_version', 0));

	if ($currentVersion < $nextVersion)
	{
		include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/update_class.php');
		$updater = new \CUpdater();
		$updater->Init('', 'mysql', '', '', $moduleId, 'DB');

		$callback($updater, $DB, 'mysql');
		Option::set($moduleId, '~database_schema_version', $nextVersion);
	}
}

/*__gardenMigrate(2, function($updater, $DB)
{
	if ($updater->CanUpdateDatabase())
	{
		$DB->query('CREATE TABLE IF NOT EXISTS up_projector_issues (
			ID INT(11) NOT NULL AUTO_INCREMENT,
			PROJECT_ID INT(11) NOT NULL,
			NAME VARCHAR(255) NOT NULL,
			PRIMARY KEY(ID)
		);');
	}
});*/
