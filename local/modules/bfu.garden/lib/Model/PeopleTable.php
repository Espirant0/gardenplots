<?php

namespace Bfu\Garden\Model;

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\IntegerField,
	Bitrix\Main\ORM\Fields\StringField,
	Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

class PeopleTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'people';
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
				'PERSON_ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('_ENTITY_PERSON_ID_FIELD')
				]
			),
			new StringField(
				'PERSON_NAME',
				[
					'required' => true,
					'validation' => [__CLASS__, 'validatePersonName'],
					'title' => Loc::getMessage('_ENTITY_PERSON_NAME_FIELD')
				]
			),
			new StringField(
				'PERSON_SURNAME',
				[
					'required' => true,
					'validation' => [__CLASS__, 'validatePersonSurname'],
					'title' => Loc::getMessage('_ENTITY_PERSON_SURNAME_FIELD')
				]
			),
		];
	}

	/**
	 * Returns validators for PERSON_NAME field.
	 *
	 * @return array
	 */
	public static function validatePersonName()
	{
		return [
			new LengthValidator(null, 255),
		];
	}

	/**
	 * Returns validators for PERSON_SURNAME field.
	 *
	 * @return array
	 */
	public static function validatePersonSurname()
	{
		return [
			new LengthValidator(null, 255),
		];
	}
}