<?php

use Bfu\Garden\Repository\GardenRepository;

class AddContributionComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		$table = (string)request()['table'];
		$id = (int)request()['id'];
		if($id <= 0)
		{
			LocalRedirect('/404/');
		}
		if($table === "people")
		{
			GardenRepository::deletePerson($id);
			LocalRedirect('/people/');
		}

		if($table === "contributions"){
			GardenRepository::deleteContribution($id);
			LocalRedirect('/contributions/');
		}

		if($table === "year_contributions")
		{
			GardenRepository::deleteYearContribution($id);
			LocalRedirect('/contributions_by_year/');
		}

		if($table === "plots")
		{
			GardenRepository::deletePlot($id);
			LocalRedirect('/plots/');
		}
	}

}