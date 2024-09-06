<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$currentDate = new DateTime();
?>
<div class="notification is-link">
	<h1 class="title is-3 has-text-centered">Добавить выплату</h1>
</div>
<form action="/contributions/" method="get">
	<button class="button is-success">Назад</button>
</form>

<div class="add_form">
	<form action="/add_contribution/" id="add-form" method="post">
		<div class="control">
			<div class="select">
				<select name="PERSON">
					<?php foreach ($arResult['PEOPLE'] as $person):?>
						<option value="<?=$person['PERSON_ID']?>"><?=$person['PERSON_NAME']?> <?=$person['PERSON_SURNAME']?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="control">
			<input class="input" type="number" id="sum" name="SUM" placeholder="Сумма" required>
		</div>
		<div class="control">
			<input class="input" type="date" name="DATE" id="date" placeholder="Дата" max="<?= $currentDate->format('Y-m-d') ?>" required>
		</div>
		<div class="btn-inner">
			<button type="submit" id="add-btn" class="button is-success">Добавить запись</button>
		</div>
	</form>
</div>

<script>
	const addForm = document.getElementById('add-form');
	const addBtn = document.getElementById('add-btn');
	addBtn.addEventListener("click", () => {
		if(document.getElementById('sum').value !== "" &&
			document.getElementById('date').value !== ""
		{
			addBtn.disabled = true;
			addForm.submit();
		}
	});
</script>