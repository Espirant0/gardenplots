<?php

namespace Bfu\Garden\Model;

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\IntegerField,
	Bitrix\Main\ORM\Fields\StringField,
	Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

/**
 * Class Table
 *
 * Fields:
 * <ul>
 * <li> COMMUNICATION_ID int mandatory
 * <li> COMMUNICATION_NAME string(255) mandatory
 * </ul>
 *
 * @package Bitrix\
 **/

class CommunicationsTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'communications';
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
				'COMMUNICATION_ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('_ENTITY_COMMUNICATION_ID_FIELD')
				]
			),
			new StringField(
				'COMMUNICATION_NAME',
				[
					'required' => true,
					'validation' => [__CLASS__, 'validateCommunicationName'],
					'title' => Loc::getMessage('_ENTITY_COMMUNICATION_NAME_FIELD')
				]
			),
		];
	}

	/**
	 * Returns validators for COMMUNICATION_NAME field.
	 *
	 * @return array
	 */
	public static function validateCommunicationName()
	{
		return [
			new LengthValidator(null, 255),
		];
	}
}