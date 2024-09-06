<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<div class="notification is-link">
	<h1 class="title is-3 has-text-centered">Платежи по годам</h1>
</div>
<form action="/add_year_contribution/" method="get">
	<button class="button is-success">Добавить запись</button>
</form>
<div class="contributions">
	<table class="table">
		<thead>
		<tr>
			<th>№</th>
			<th>Плательщик</th>
			<th>Год</th>
			<th>Сумма</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($arResult['CONTRIBUTIONS'] as $contribution):?>
			<tr>
				<td><?=$contribution['CONTRIBUTION_ID']?></td>
				<td><?=$contribution['CONTRIBUTOR_NAME']?> <?=$contribution['CONTRIBUTOR_SURNAME']?></td>
				<td><?=$contribution['CONTRIBUTION_YEAR']?></td>
				<td><?=$contribution['SUM_OF_CONTRIBUTIONS']?> руб</td>
				<td>
					<form action="/delete/year_contributions/<?=$contribution['CONTRIBUTION_ID']?>/">
						<button
								class="delete"
								onclick="return window.confirm('Вы уверены, что хотите удалить эту запись?');"
						>
						</button>
					</form>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>
