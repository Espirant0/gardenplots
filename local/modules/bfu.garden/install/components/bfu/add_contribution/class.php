<?php

use Bfu\Garden\Repository\GardenRepository;

class AddContributionComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$method = Bitrix\Main\Context::getCurrent()->getRequest()->isPost();
		if($method)
		{
			$personId = (int)request()['PERSON'];
			$sum = (int)request()['SUM'];
			$date = request()['DATE'];
			GardenRepository::addContribution($personId, $sum, $date);
			LocalRedirect('/contributions/');
		}
		$this->arResult['PEOPLE'] = GardenRepository::getPersonList();
		$this->includeComponentTemplate();
	}

}