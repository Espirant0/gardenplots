<?php
namespace Bfu\Garden\Model;

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\IntegerField,
	Bitrix\Main\ORM\Fields\StringField,
	Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);
class BuildingsTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'buildings';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
			new IntegerField(
				'BUILDING_ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('_ENTITY_BUILDING_ID_FIELD')
				]
			),
			new StringField(
				'BUILDING_NAME',
				[
					'required' => true,
					'validation' => [__CLASS__, 'validateBuildingName'],
					'title' => Loc::getMessage('_ENTITY_BUILDING_NAME_FIELD')
				]
			),
		];
	}

	/**
	 * Returns validators for BUILDING_NAME field.
	 *
	 * @return array
	 */
	public static function validateBuildingName()
	{
		return [
			new LengthValidator(null, 255),
		];
	}
}