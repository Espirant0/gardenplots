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

class GardenPlotTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'garden_plot';
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
				'PLOT_ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('PLOT_ENTITY_PLOT_ID_FIELD')
				]
			),
			new IntegerField(
				'OWNER_ID',
				[
					'title' => Loc::getMessage('PLOT_ENTITY_OWNER_ID_FIELD')
				]
			),
			'OWNER' => new ReferenceField(
				'OWNER_ID',
				PeopleTable::class, Join::on('this.OWNER_ID', 'ref.PERSON_ID')
			),
			new FloatField(
				'PLOT_SIZE',
				[
					'required' => true,
					'title' => Loc::getMessage('PLOT_ENTITY_PLOT_SIZE_FIELD')
				]
			),
			new IntegerField(
				'HAS_BUILDINGS',
				[
					'required' => true,
					'title' => Loc::getMessage('PLOT_ENTITY_HAS_BUILDINGS_FIELD')
				]
			),
			new IntegerField(
				'HAS_COMMUNICATIONS',
				[
					'required' => true,
					'title' => Loc::getMessage('PLOT_ENTITY_HAS_COMMUNICATIONS_FIELD')
				]
			),
			new DateField(
				'PURCHASE_DATE',
				[
					'title' => Loc::getMessage('PLOT_ENTITY_PURCHASE_DATE_FIELD')
				]
			),
			new DateField(
				'SALE_DATE',
				[
					'title' => Loc::getMessage('PLOT_ENTITY_SALE_DATE_FIELD')
				]
			),
		];
	}
}