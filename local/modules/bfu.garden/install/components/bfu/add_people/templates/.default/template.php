<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<form action="/contributions/" method="get">
	<button class="button is-success">Назад</button>
</form>

<div class="add_form">
	<form action="/add_people/" method="post" id="add-form">
		<div class="control">
			<label>
				Имя
				<input class="input" id="name" name="NAME" type="text" required>
			</label>
		</div>
		<div class="control">
			<label>
				Фамилия
				<input class="input" id="surname" name="SURNAME" type="text" required>
			</label>
		</div>
		<div class="btn-inner">
			<button id="add-btn" type="submit" class="button is-success">Добавить запись</button>
		</div>
	</form>
</div>

<script>
	const addForm = document.getElementById('add-form');
	const addBtn = document.getElementById('add-btn');
	addBtn.addEventListener("click", () => {
		if(document.getElementById('name').value !== "" &&
			document.getElementById('surname').value !== ""
		{
			addBtn.disabled = true;
			addForm.submit();
		}
	});
</script>