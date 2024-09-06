<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<div class="notification is-link">
	<h1 class="title is-3 has-text-centered">Владельцы и плательщики</h1>
</div>
<form action="/add_people/" method="get">
	<button class="button is-success">Добавить запись</button>
</form>
<div class="contributions">
	<table class="table">
		<thead>
		<tr>
			<th>№</th>
			<th>Имя</th>
			<th>Фамилия</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($arResult['PEOPLE'] as $person):?>
			<tr>
				<td><?=$person['PERSON_ID']?></td>
				<td><?=$person['PERSON_NAME']?></td>
				<td><?=$person['PERSON_SURNAME']?></td>
				<td>
					<form action="/delete/people/<?=$person['PERSON_ID']?>/">
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

