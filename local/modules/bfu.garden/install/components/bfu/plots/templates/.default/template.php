<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="notification is-link">
	<h1 class="title is-3 has-text-centered">Участки</h1>
</div>
<div class="plots">
	<div class="grid-container">
		<?php foreach ($arResult['PLOTS'] as $plot): ?>
			<div class="card">
				<header class="card-header">
					<p class="card-header-title"><strong>Участок №</strong> <?= $plot['PLOT_ID'] ?></p>
					<button class="card-header-icon" aria-label="more options">
				  <span class="icon">
					<i class="fas fa-angle-down" aria-hidden="true"></i>
				  </span>
					</button>
				</header>
				<div class="card-content">
					<div class="owner">
						<strong>Владелец:</strong> <?= $plot['OWNER_NAME']; ?> <?= $plot['OWNER_SURNAME']; ?></div>
					<div class="size"><strong>Размер:</strong> <?= $plot['PLOT_SIZE'] ?> га</div>
					<div class="size"><strong>Дата покупки:</strong> <?= $plot['PURCHASE_DATE'] ?></div>
					<div class="size"><strong>Дата продажи:</strong> <?= $plot['SALE_DATE'] ?></div>
					<div class="hover-blocks">
						<div class="dropdown is-hoverable">
							<div class="dropdown-trigger">
								<button class="button" aria-haspopup="true" aria-controls="dropdown-menu4">
									<span>Коммуникации</span>
								</button>
							</div>
							<div class="dropdown-menu" id="dropdown-menu4" role="menu">
								<div class="dropdown-content">
									<?php if ($plot['HAS_COMMUNICATIONS'] == '1'): ?>
										<?php foreach ($arResult['COMMUNICATIONS'] as $communication): ?>
											<?php if ($plot['PLOT_ID'] == $communication['PLOT_ID']): ?>
												<div class="dropdown-item">
													<?= $communication['COMMUNICATION_NAME']; ?>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php else: ?>
										<div class="dropdown-item">
											Отсутствует
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="dropdown is-hoverable">
							<div class="dropdown-trigger">
								<button class="button" aria-haspopup="true" aria-controls="dropdown-menu4">
									<span>Строения</span>
								</button>
							</div>
							<div class="dropdown-menu" id="dropdown-menu4" role="menu">
								<div class="dropdown-content">
									<?php if ($plot['HAS_BUILDINGS'] == '1'): ?>
										<?php foreach ($arResult['BUILDINGS'] as $building): ?>
											<?php if ($plot['PLOT_ID'] == $building['PLOT_ID']): ?>
												<div class="dropdown-item">
													<?= $building['BUILDING_NAME']; ?>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php else: ?>
										<div class="dropdown-item">
											Отсутствует
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<footer class="card-footer">
					<a href="/plot_form/<?=$plot['PLOT_ID']?>/" class="card-footer-item">Изменить</a>
					<a href="/delete/plots/<?=$plot['PLOT_ID']?>/"
					   class="card-footer-item"
					   onclick="return window.confirm('Вы уверены, что хотите удалить этот участок?');"
					>
						Удалить
					</a>
				</footer>
			</div>
		<?php endforeach; ?>
	</div>
</div>

