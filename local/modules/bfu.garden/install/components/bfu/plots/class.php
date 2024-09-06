<?php

use Bfu\Garden\Repository\GardenRepository;

class PlotsComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$this->arResult['PLOTS'] = GardenRepository::getPlotList();
		$this->arResult['COMMUNICATIONS'] = GardenRepository::getPlotCommunicationList();
		$this->arResult['BUILDINGS'] = GardenRepository::getPlotBuildingList();
		$this->includeComponentTemplate();
	}

}