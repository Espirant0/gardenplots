<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$currentDate = new DateTime();
$communicationSize = count($arResult['COMMUNICATIONS']);
$buildingsSize = count($arResult['BUILDINGS']);
$plot = $arResult['PLOT'];
$title = 'Добвление нового участка';
if($plot !== [])
{
	$title = "Редактирование участка №{$plot['PLOT_ID']}";
}
?>
<div class="notification is-link">
	<h1 class="title is-3 has-text-centered"><?=$title?></h1>
</div>
<form action="/edit/" method="post" id="add-form" class="edit-form">
	<input type="hidden" name="PLOT" value="<?=$plot['PLOT_ID']?>">
	<div class="form-inner">
		<p>Владелец</p>
		<div class="control">
			<div class="select">
				<select name="PERSON">
					<?php foreach ($arResult['PEOPLE'] as $person):?>
						<option value="<?=$person['PERSON_ID']?>" <?=($person['PERSON_ID'] == $plot['OWNER_ID'])?'selected' : ''?>><?=$person['PERSON_NAME']?> <?=$person['PERSON_SURNAME']?></option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<label>
			Размер (в га)
			<input class="input" id="size" name="SIZE" type="text" value="<?=$plot['PLOT_SIZE'];?>" required/>
		</label>
		<label>
			Дата покупки
			<input class="input" id="purchase" name="PURCHASE_DATE" value="<?=$plot['PURCHASE_DATE'];?>" type="date" required max="<?= $currentDate->format('Y-m-d') ?>"/>
		</label>
		<label>
			Дата продажи
			<input class="input" id="sale" name="SALE_DATE" value="<?=$plot['SALE_DATE'];?>" type="date" required max="<?= $currentDate->format('Y-m-d') ?>"/>
		</label>

		<div id="selectors-container-communications">
			<?php $communicationCount = 0;?>
			<?php foreach ($arResult['PLOT_COMMUNICATIONS'] as $plotCommunication):?>
				<div id="communication-<?=$communicationCount?>" class="selector-container">
					<div class="select">
						<select name="COMMUNICATIONS[]">
							<option>Выберите коммуникации</option>
							<?php foreach ($arResult['COMMUNICATIONS'] as $communication):?>
								<option
										value="<?=$communication['COMMUNICATION_ID']?>"
									<?=($communication['COMMUNICATION_ID'] == $plotCommunication['COMMUNICATION_ID'])?'selected' : ''?>
								><?=$communication['COMMUNICATION_NAME']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<button type="button" class="delete"></button>
				</div>
				<?php $communicationCount++;?>
			<?php endforeach;?>
		</div>
		<button id="add-communications-btn" type="button" class="button is-success">Добавить коммуникации</button>

		<div id="selectors-container-buildings">
			<?php $buildingCount = 0;?>
			<?php foreach ($arResult['PLOT_BUILDINGS'] as $plotBuilding):?>
				<div id="communication-<?=$buildingCount?>" class="selector-container">
					<div class="select">
						<select name="BUILDINGS[]">
							<option>Выберите коммуникации</option>
							<?php foreach ($arResult['BUILDINGS'] as $buildings):?>
								<option
										value="<?=$buildings['BUILDING_ID']?>"
									<?=($buildings['BUILDING_ID'] == $plotBuilding['BUILDING_ID'])?'selected' : ''?>
								><?=$buildings['BUILDING_NAME']?></option>
							<?php endforeach;?>
						</select>
					</div>
					<button type="button" class="delete"></button>
				</div>
				<?php $buildingCount++;?>
			<?php endforeach;?>
		</div>
		<button id="add-buildings-btn" type="button" class="button is-success">Добавить строения</button>

		<button type="submit" id="add-btn" class="button is-success">Отправить</button>
	</div>
</form>

<script>
	document.addEventListener('DOMContentLoaded', () => {
		const communicationsContainer = document.getElementById('selectors-container-communications');
		const buildingsContainer = document.getElementById('selectors-container-buildings');
		const addCommunicationBtn = document.getElementById('add-communications-btn');
		const addBuildingBtn = document.getElementById('add-buildings-btn');

		const createCommunication = (id) => {
			const container = document.createElement('div');
			container.className = 'selector-container';
			container.id = `communication-${id}`;

			const selectContainer = document.createElement('div');
			selectContainer.className = 'select';
			const select = document.createElement('select');
			select.name = 'COMMUNICATIONS[]';
			selectContainer.appendChild(select);
			container.appendChild(selectContainer);
			select.innerHTML = `
         <option>Выберите коммуникации</option>
			<?php foreach ($arResult['COMMUNICATIONS'] as $communication):?>
        		 <option value="<?=$communication['COMMUNICATION_ID']?>"><?=$communication['COMMUNICATION_NAME']?></option>
         	<?php endforeach;?>
        `;

			const removeBtn = document.createElement('button');
			removeBtn.className = 'delete'
			removeBtn.addEventListener('click', () => {
				communicationsContainer.removeChild(container);
			});
			container.appendChild(removeBtn);
			return container;
		};
		const createBuilding = (id) => {
			const container = document.createElement('div');
			container.className = 'selector-container';
			container.id = `communication-${id}`;

			const selectContainer = document.createElement('div');
			selectContainer.className = 'select';
			const select = document.createElement('select');
			select.name = 'BUILDINGS[]';
			selectContainer.appendChild(select);
			container.appendChild(selectContainer);
			select.innerHTML = `
         <option>Выберите строение</option>
			<?php foreach ($arResult['BUILDINGS'] as $building):?>
        		 <option value="<?=$building['BUILDING_ID']?>"><?=$building['BUILDING_NAME']?></option>
         	<?php endforeach;?>
        `;
			const removeBtn = document.createElement('button');
			removeBtn.className = 'delete'
			removeBtn.addEventListener('click', () => {
				buildingsContainer.removeChild(container);
			});
			container.appendChild(removeBtn);
			return container;
		};
		let communicationId = <?=$arResult['PLOT_COMMUNICATIONS'];?>;
		let buildingId = <?=$arResult['PLOT_BUILDINGS'];?>;
		addCommunicationBtn.addEventListener('click', () => {
			const newSelector = createCommunication(communicationId++);
			communicationsContainer.appendChild(newSelector);
		});
		addBuildingBtn.addEventListener('click', () => {
			const newSelector = createBuilding(buildingId++);
			buildingsContainer.appendChild(newSelector);
		});
		const childElements = document.querySelectorAll('.delete');

		childElements.forEach(child => {
			child.addEventListener('click', function() {
				const parentElement = this.parentElement;
				parentElement.remove();
			});
		});
	});

	const addForm = document.getElementById('add-form');
	const addBtn = document.getElementById('add-btn');
	addBtn.addEventListener("click", () => {
		if(document.getElementById('size').value !== "" &&
			document.getElementById('purchase').value !== "" &&
			document.getElementById('sale').value !== "" )
		{
			addBtn.disabled = true;
			addForm.submit();
		}
	});
</script>