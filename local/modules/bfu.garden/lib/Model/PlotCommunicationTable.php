<?php

namespace Bfu\Garden\Model;

use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Data\Internal\DeleteByFilterTrait;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);

class PlotCommunicationTable extends DataManager
{
	use DeleteByFilterTrait;
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'plot_communication';
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
					'required' => true,
					'title' => Loc::getMessage('COMMUNICATION_ENTITY_PLOT_ID_FIELD')
				]
			),
			'PLOT' => new ReferenceField(
				'PLOT_ID',
				GardenPlotTable::class, Join::on('this.PLOT_ID', 'ref.PLOT_ID')
			),
			new IntegerField(
				'COMMUNICATION_ID',
				[
					'primary' => true,
					'required' => true,
					'title' => Loc::getMessage('COMMUNICATION_ENTITY_COMMUNICATION_ID_FIELD')
				]
			),
			'COMMUNICATION' => new ReferenceField(
				'COMMUNICATION_ID',
				CommunicationsTable::class, Join::on('this.COMMUNICATION_ID', 'ref.COMMUNICATION_ID')
			),
		];
	}
}