<?php

namespace Bfu\Garden\Model;

use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\DateField,
	Bitrix\Main\ORM\Fields\FloatField,
	Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);
class ContributionsTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'contributions';
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
				'CONTRIBUTION_ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('_ENTITY_CONTRIBUTION_ID_FIELD')
				]
			),
			new IntegerField(
				'CONTRIBUTOR_ID',
				[
					'required' => true,
					'title' => Loc::getMessage('_ENTITY_CONTRIBUTOR_ID_FIELD')
				]
			),
			'CONTRIBUTOR' => new ReferenceField(
				'CONTRIBUTOR_ID',
				PeopleTable::class, Join::on('this.CONTRIBUTOR_ID', 'ref.PERSON_ID')
			),
			new DateField(
				'PAYMENT_DATE',
				[
					'required' => true,
					'title' => Loc::getMessage('_ENTITY_PAYMENT_DATE_FIELD')
				]
			),
			new FloatField(
				'PAYMENT_SUM',
				[
					'required' => true,
					'title' => Loc::getMessage('_ENTITY_PAYMENT_SUM_FIELD')
				]
			),
		];
	}
}