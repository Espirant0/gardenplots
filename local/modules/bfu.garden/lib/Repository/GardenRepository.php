<?php

namespace Bfu\Garden\Repository;

use Bfu\Garden\Model\BuildingsTable;
use Bfu\Garden\Model\CommunicationsTable;
use Bfu\Garden\Model\ContributionsByYearTable;
use Bfu\Garden\Model\ContributionsTable;
use Bfu\Garden\Model\GardenPlotTable;
use Bfu\Garden\Model\PeopleTable;
use Bfu\Garden\Model\PlotBuildingTable;
use Bfu\Garden\Model\PlotCommunicationTable;
use DateTime;

class GardenRepository
{
	public static function getPlotList(): array
	{
		return GardenPlotTable::getList([
			'select' => [
				'PLOT_ID',
				'OWNER_NAME' => 'OWNER.PERSON_NAME',
				'OWNER_SURNAME' => 'OWNER.PERSON_SURNAME',
				'PLOT_SIZE',
				'HAS_BUILDINGS',
				'HAS_COMMUNICATIONS',
				'PURCHASE_DATE',
				'SALE_DATE',
			],
		])->fetchAll();
	}

	public static function getContributionsList(): array
	{
		return ContributionsTable::getList([
			'select' => [
				'CONTRIBUTION_ID',
				'CONTRIBUTOR_NAME' => 'CONTRIBUTOR.PERSON_NAME',
				'CONTRIBUTOR_SURNAME' => 'CONTRIBUTOR.PERSON_SURNAME',
				'PAYMENT_DATE',
				'PAYMENT_SUM',
			],
		])->fetchAll();
	}

	public static function getPersonList(): array
	{
		return PeopleTable::getList([
			'select' => [
				'*'
			],
		])->fetchAll();
	}

	public static function getContributionsByYearsList(): array
	{
		return ContributionsByYearTable::getList([
			'select' => [
				'CONTRIBUTION_ID',
				'CONTRIBUTOR_NAME' => 'CONTRIBUTOR.PERSON_NAME',
				'CONTRIBUTOR_SURNAME' => 'CONTRIBUTOR.PERSON_SURNAME',
				'CONTRIBUTION_YEAR',
				'SUM_OF_CONTRIBUTIONS',
			],
		])->fetchAll();
	}

	public static function getPlotCommunicationList(): array
	{
		return PlotCommunicationTable::getList([
			'select' => [
				'PLOT_ID',
				'COMMUNICATION_NAME' => 'COMMUNICATION.COMMUNICATION_NAME',
			],
		])->fetchAll();
	}

	public static function getPlotBuildingList(): array
	{
		return PlotBuildingTable::getList([
			'select' => [
				'PLOT_ID',
				'BUILDING_NAME' => 'BUILDING.BUILDING_NAME',
			],
		])->fetchAll();
	}

	public static function getCommunicationList(): array
	{
		return CommunicationsTable::getList([
			'select' => ['*'],
		])->fetchAll();
	}

	public static function getBuildingList(): array
	{
		return BuildingsTable::getList([
			'select' => ['*'],
		])->fetchAll();
	}

	public static function addPerson(string $name, string $surname): void
	{
		PeopleTable::add(['PERSON_NAME' => $name, 'PERSON_SURNAME' => $surname]);
	}

	public static function deletePerson(int $id): void
	{
		PeopleTable::delete($id);
	}

	public static function deleteContribution(int $id): void
	{
		ContributionsTable::delete($id);
	}

	public static function deleteYearContribution(int $id): void
	{
		ContributionsByYearTable::delete($id);
	}

	public static function addContribution(int $personId, int $sum, string $date): void
	{
		$date = new DateTime($date);
		$date = \Bitrix\Main\Type\DateTime::createFromPhp($date);
		ContributionsTable::add([
			'CONTRIBUTOR_ID' => $personId,
			'PAYMENT_SUM' => $sum,
			'PAYMENT_DATE' => $date,
		]);
	}

	public static function addYearContribution(int $personId, int $sum, int $year): void
	{
		ContributionsByYearTable::add([
			'CONTRIBUTOR_ID' => $personId,
			'CONTRIBUTION_YEAR' => $year,
			'SUM_OF_CONTRIBUTIONS' => $sum,
		]);
	}

	public static function deletePlot(int $id): void
	{
		GardenPlotTable::delete($id);
		PlotCommunicationTable::deleteByFilter(['PLOT_ID' => $id]);
		PlotBuildingTable::deleteByFilter(['PLOT_ID' => $id]);
	}

	public static function getPlotById(int $plotId): array
	{
		$plot = GardenPlotTable::getByPrimary($plotId)->fetch();
		$plot['PURCHASE_DATE'] = date('Y-m-d', strtotime($plot['PURCHASE_DATE']));
		$plot['SALE_DATE'] = date('Y-m-d', strtotime($plot['SALE_DATE']));
		return $plot;
	}

	public static function addPlot(
		int $ownerId,
		int $size,
		string $purchaseDate,
		string $saleDate,
		int $hasBuildings,
		int $hasCommunications
	): int
	{
		$purchaseDate = new DateTime($purchaseDate);
		$saleDate = new DateTime($saleDate);
		$purchaseDate = \Bitrix\Main\Type\DateTime::createFromPhp($purchaseDate);
		$saleDate = \Bitrix\Main\Type\DateTime::createFromPhp($saleDate);
		$plot = GardenPlotTable::add([
			'OWNER_ID' => $ownerId,
			'PLOT_SIZE' => $size,
			'PURCHASE_DATE' => $purchaseDate,
			'SALE_DATE' => $saleDate,
			'HAS_COMMUNICATIONS' => $hasCommunications,
			'HAS_BUILDINGS' => $hasBuildings,
		]);
		return $plot->getId();
	}


	public static function addPlotCommunications(int $plotId, array $communications): void
	{
		foreach ($communications as $communication) {
			PlotCommunicationTable::add([
				'PLOT_ID' => $plotId,
				'COMMUNICATION_ID' => $communication,
			]);
		}
	}

	public static function addPlotBuildings(int $plotId, array $buildings): void
	{
		foreach ($buildings as $building) {
			PlotBuildingTable::add([
				'PLOT_ID' => $plotId,
				'BUILDING_ID' => $building,
			]);
		}
	}

	public static function updatePlot(
		int $plotId,
		int $ownerId,
		int $size,
		string $purchaseDate,
		string $saleDate,
		int $hasBuildings,
		int $hasCommunications
	): void
	{
		$purchaseDate = new DateTime($purchaseDate);
		$saleDate = new DateTime($saleDate);
		$purchaseDate = \Bitrix\Main\Type\DateTime::createFromPhp($purchaseDate);
		$saleDate = \Bitrix\Main\Type\DateTime::createFromPhp($saleDate);
		GardenPlotTable::update($plotId, [
			'OWNER_ID' => $ownerId,
			'PLOT_SIZE' => $size,
			'PURCHASE_DATE' => $purchaseDate,
			'SALE_DATE' => $saleDate,
			'HAS_COMMUNICATIONS' => $hasCommunications,
			'HAS_BUILDINGS' => $hasBuildings,
		]);
	}

	public static function updatePlotBuildings(int $plotId, array $buildings): void
	{
		PlotBuildingTable::deleteByFilter(['=PLOT_ID' => $plotId]);
		self::addPlotBuildings($plotId, $buildings);
	}

	public static function updatePlotCommunications(int $plotId, array $communications): void
	{
		PlotCommunicationTable::deleteByFilter(['=PLOT_ID' => $plotId]);
		self::addPlotCommunications($plotId, $communications);
	}

	public static function getBuildingsByPlotId(int $id): array
	{
		return PlotBuildingTable::getList([
			'select' => [
				'PLOT_ID',
				'BUILDING_ID',
				'BUILDING_NAME' => 'BUILDING.BUILDING_NAME',
			],
			'filter' => [
				'=PLOT_ID' => $id,
			],
		])->fetchAll();
	}

	public static function getCommunicationsByPlotId(int $id): array
	{
		return PlotCommunicationTable::getList([
			'select' => [
				'PLOT_ID',
				'COMMUNICATION_ID',
				'COMMUNICATION_NAME' => 'COMMUNICATION.COMMUNICATION_NAME',
			],
			'filter' => [
				'=PLOT_ID' => $id,
			],
		])->fetchAll();
	}
}