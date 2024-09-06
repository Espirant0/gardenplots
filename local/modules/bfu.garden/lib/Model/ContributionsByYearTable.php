<?php

namespace Bfu\Garden\Model;

use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\FloatField,
	Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);

/**
 * Class YearTable
 *
 * Fields:
 * <ul>
 * <li> CONTRIBUTION_ID int mandatory
 * <li> CONTRIBUTOR_ID int mandatory
 * <li> CONTRIBUTION_YEAR unknown mandatory
 * <li> SUM_OF_CONTRIBUTIONS double optional
 * </ul>
 *
 * @package Bitrix\By
 **/

class ContributionsByYearTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'contributions_by_year';
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
					'title' => Loc::getMessage('YEAR_ENTITY_CONTRIBUTION_ID_FIELD')
				]
			),
			new IntegerField(
				'CONTRIBUTOR_ID',
				[
					'required' => true,
					'title' => Loc::getMessage('YEAR_ENTITY_CONTRIBUTOR_ID_FIELD')
				]
			),
			'CONTRIBUTOR' => new ReferenceField(
				'CONTRIBUTOR_ID',
				PeopleTable::class, Join::on('this.CONTRIBUTOR_ID', 'ref.PERSON_ID')
			),
			new IntegerField(
			'CONTRIBUTION_YEAR',
				[
					'required' => true,
					'title' => Loc::getMessage('YEAR_ENTITY_CONTRIBUTION_YEAR_FIELD')
				]
			),
			new FloatField(
				'SUM_OF_CONTRIBUTIONS',
				[
					'title' => Loc::getMessage('YEAR_ENTITY_SUM_OF_CONTRIBUTIONS_FIELD')
				]
			),
		];
	}
}