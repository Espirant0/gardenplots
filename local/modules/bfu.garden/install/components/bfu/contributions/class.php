<?php

use Bfu\Garden\Repository\GardenRepository;

class ContributionsComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$this->arResult['CONTRIBUTIONS'] = GardenRepository::getContributionsList();
		$this->includeComponentTemplate();
	}

}