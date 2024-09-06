<?php

use Bfu\Garden\Repository\GardenRepository;

class AddPeopleComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$method = Bitrix\Main\Context::getCurrent()->getRequest()->isPost();
		if ($method) {
			$name = (string)request()['NAME'];
			$surname = (string)request()['SURNAME'];
			GardenRepository::addPerson($name, $surname);
			LocalRedirect('/people/');
		}
		$this->arResult['PEOPLE'] = GardenRepository::getPersonList();
		$this->includeComponentTemplate();
	}
}