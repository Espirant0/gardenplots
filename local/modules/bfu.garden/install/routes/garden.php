<?php

use Bitrix\Main\Routing\Controllers\PublicPageController;
use Bitrix\Main\Routing\RoutingConfigurator;

return function (RoutingConfigurator $routes) {

	$routes->get('/', new PublicPageController('/local/modules/bfu.garden/views/main.php'));
	$routes->get('/plots/', new PublicPageController('/local/modules/bfu.garden/views/plots.php'));
	$routes->get('/plot_form/{id}/', new PublicPageController('/local/modules/bfu.garden/views/plot_form.php'));
	$routes->get('/plot_form/', new PublicPageController('/local/modules/bfu.garden/views/plot_form.php'));
	$routes->get('/contributions/', new PublicPageController('/local/modules/bfu.garden/views/contributions.php'));
	$routes->get('/add_contribution/', new PublicPageController('/local/modules/bfu.garden/views/add_contribution.php'));
	$routes->get('/people/', new PublicPageController('/local/modules/bfu.garden/views/people.php'));
	$routes->get('/add_people/', new PublicPageController('/local/modules/bfu.garden/views/add_people.php'));
	$routes->get('/contributions_by_year/', new PublicPageController('/local/modules/bfu.garden/views/years.php'));
	$routes->post('/add_people/',new PublicPageController('/local/modules/bfu.garden/views/add_people.php'));
	$routes->post('/add_contribution/',new PublicPageController('/local/modules/bfu.garden/views/add_contribution.php'));
	$routes->get('/delete/{table}/{id}/', new PublicPageController('/local/modules/bfu.garden/views/delete.php'));
	$routes->get('/add_year_contribution/', new PublicPageController('/local/modules/bfu.garden/views/add_year_contribution.php'));
	$routes->post('/add_year_contribution/', new PublicPageController('/local/modules/bfu.garden/views/add_year_contribution.php'));
	$routes->get('/404/', new PublicPageController('/local/modules/bfu.garden/views/404.php'));
	$routes->post('/edit/', new PublicPageController('/local/modules/bfu.garden/views/plot_form.php'));
};