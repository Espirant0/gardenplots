<?php

use Bfu\Garden\Repository\GardenRepository;

class PlotsComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$method = Bitrix\Main\Context::getCurrent()->getRequest()->isPost();
		if ($method) {
			$ownerId = (int)request()['PERSON'];
			$size = (int)request()['SIZE'];
			$purchaseDate = request()['PURCHASE_DATE'];
			$saleDate = request()['SALE_DATE'];
			$buildings = request()['BUILDINGS'];
			$communications = request()['COMMUNICATIONS'];
			$hasCommunications = 0;
			$hasBuildings = 0;
			if (isset($communications)) {
				$communications = array_unique($communications);
				$hasCommunications = 1;
			}
			if (isset($buildings)) {
				$buildings = array_unique($buildings);
				$hasBuildings = 1;
			}
			$plotId = request()['PLOT'];
			if ($plotId === '') {
				$plot = GardenRepository::addPlot($ownerId, $size, $purchaseDate, $saleDate, $hasBuildings, $hasCommunications);
				if ($hasBuildings === 1) {
					GardenRepository::addPlotBuildings($plot, $buildings);
				}
				if ($hasCommunications === 1) {
					GardenRepository::addPlotCommunications($plot, $communications);
				}
			} else {
				GardenRepository::updatePlot($plotId, $ownerId, $size, $purchaseDate, $saleDate, $hasBuildings, $hasCommunications);
				if ($hasBuildings === 1) {
					GardenRepository::updatePlotBuildings($plotId, $buildings);
				}
				if ($hasCommunications === 1) {
					GardenRepository::updatePlotCommunications($plotId, $communications);
				}
			}

			LocalRedirect('/plots/');
		}
		$id = request()['id'];
		if (!isset($id)) {
			$plot = [];
			$plotBuildings = [];
			$plotCommunications = [];
		} else {
			$plot = GardenRepository::getPlotById($id);
			$plotBuildings = GardenRepository::getBuildingsByPlotId($id);
			$plotCommunications = GardenRepository::getCommunicationsByPlotId($id);
		}
		$this->arResult['PLOT'] = $plot;
		$this->arResult['PLOT_BUILDINGS'] = $plotBuildings;
		$this->arResult['PLOT_COMMUNICATIONS'] = $plotCommunications;
		$this->arResult['PLOTS'] = GardenRepository::getPlotList();
		$this->arResult['COMMUNICATIONS'] = GardenRepository::getCommunicationList();
		$this->arResult['BUILDINGS'] = GardenRepository::getBuildingList();
		$this->arResult['PEOPLE'] = GardenRepository::getPersonList();
		$this->includeComponentTemplate();
	}

}