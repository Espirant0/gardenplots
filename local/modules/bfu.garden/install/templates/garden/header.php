<?php
/**
 * @var CMain $APPLICATION
 */
?><!doctype html>
<html lang="<?= LANGUAGE_ID; ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php $APPLICATION->ShowTitle(); ?></title>

	<?php
	$APPLICATION->ShowHead();
	?>
</head>
<body>
<?php $APPLICATION->ShowPanel(); ?>

<section class="section">
	<nav class="breadcrumb is-centered has-bullet-separator" aria-label="breadcrumbs">
		<ul>
			<li><a href="/plot_form/" class="navbar-item">
					Добавить участок
				</a></li>
			<li><a href="/plots/" class="navbar-item">
					Участки
				</a></li>
			<li><a href="/contributions/" class="navbar-item">
					Платежи
				</a></li>
			<li><a href="/contributions_by_year/" class="navbar-item">
					Платежи по годам
				</a></li>
			<li><a href="/people/" class="navbar-item">
					Владельцы и плательщики
				</a></li>
		</ul>
	</nav>
	<!--<div class="container nav-container">
		<nav class="navbar" role="navigation" aria-label="main navigation">
			<div id="navbarBasicExample" class="navbar-menu">
				<div class="navbar-start">
					<a href="/" class="navbar-item">
						Добавить участок
					</a>
					<a href="/plots/" class="navbar-item">
						Участки
					</a>
					<a href="/contributions/" class="navbar-item">
						Платежи
					</a>
					<a href="/contributions_by_year/" class="navbar-item">
						Платежи по годам
					</a>
				</div>
			</div>
		</nav>
	</div>-->
	<div class="container">
