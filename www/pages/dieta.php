<?
	header('Content-Type: text/html; charset=utf-8');
	$pathBegin = '../';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
	<? 
		$titlePage = 'Диеты'; 
		include '../header_footer/base_meta.php';
	?>
	<link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/styles.css" />
	<link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/button_styles.css" />
	<link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/font_styles.css" />
</head>

<body topmargin="0">
	<div class="center_div">
		<?
			include $pathBegin . "header_footer/header.php";
			include $pathBegin . "header_footer/menu.php";
		?>

		<div>
			<br><em>Чтобы не быть обманутыми и иметь отменное здоровье ознакомьтесь с основными мифами о диетах, чтобы ваш процесс похудения был приятным и без дальнейших осложнений.</em>

			<h1 class="green_text">9 основных мифов о диетах</h1>
		</div>

		<div class="dieta_main_div">
			<div class="dieta_row">
				<div class="dieta_cell">
					<div class="dieta_cell_img">
						<img class="dieta_img" src="<?=@$pathBegin;?>images/diety1.jpg" />
						<div align="right">
							<strong>МИФ:</strong><br>
							<span>Чем реже Вы кушаете, тем быстрее теряете вес</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Врачи-диетологи утверждают, что пищу следует принимать почаще, но порции должны быть маленькими. Если Вы едите редко, то между приемами пищи будете испытывать сильное чувство голода. И в результате за один прием пищи Вы съедите намного больше, чем обычно.
					</div> 
				</div>
				<div class="dieta_cell">
					<div class="dieta_cell_img">
						<img class="dieta_img" src="<?=@$pathBegin;?>images/diety3.jpg" />
						<div align="right">
							<strong>МИФ:</strong><br>
							<span>Нельзя употреблять жиры</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Без вреда для здоровья можно лишь ограничить содержание жиров в рационе, потому что некоторые незаменимые кислоты содержатся только в жирах.
					</div>
				</div>
			</div>

			<div class="dieta_row">
				<div class="dieta_cell">
					<div class="dieta_cell_img">
						<img class="dieta_img" src="<?=@$pathBegin;?>images/diety2.jpg" />
						<div align="right">
							<strong>МИФ:</strong><br>
							<span>Самая эффективная диета – самая жесткая и строгая</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Если Вы строго ограничиваете свой рацион питания, ваш организм тяжело это переносит. Ухудшается самочувствие, так как Вы недополучаете многие полезные вещества. Могут обостриться хронические заболевания пищеварительного тракта.
					</div>
				</div>
				<div class="dieta_cell">
					<div class="dieta_cell_img">
						<img class="dieta_img" src="<?=@$pathBegin;?>images/diety5.jpg" />
						<div align="right">
							<strong>МИФ:</strong><br>
							<span>Полное голодание – быстрый результат</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Давно доказано, что медленное снижение веса намного эффективнее быстрого. К тому же, оно безопасно для организма.
					</div>
				</div>
			</div>

			<div class="dieta_row">
				<div class="dieta_cell">
					<div class="dieta_cell_img">
						<img class="dieta_img" src="<?=@$pathBegin;?>images/diety4.jpg" />
						<div align="right">
							<strong>МИФ:</strong><br>
							<span>Кушать только овощи и фрукты – мол, вкусно и полезно</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Такие диеты основаны на низкой калорийности фруктов и овощей. Но этот способ похудения не подходит людям старше 40 лет, а также имеющим гастриты, хронические язвы, гастроэнтериты, болезни почек и печени.
					</div>		
				</div>
				<div class="dieta_cell">
					<div class="dieta_cell_img">
							<img class="dieta_img" src="<?=@$pathBegin;?>images/diety7.jpg" />
							<div align="right">
							<strong>МИФ:</strong><br>
							<span>Чем более длительна диета, тем она эффективнее</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Не зря большинство диет рассчитано на определенный промежуток времени, ведь постепенно организм привыкнет к вашему рациону питания и начнет откладывать жиры «про запас».
					</div>					
				</div>
			</div>

			<div class="dieta_row">
				<div class="dieta_cell">
					<div class="dieta_cell_img">
						<img class="dieta_img" src="<?=@$pathBegin;?>images/diety6.jpg" />
						<div align="right">
							<strong>МИФ:</strong><br>
							<span>Диета, эффективная для вашей подруги Маши, поможет и Вам</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Диета должна быть строго индивидуальной, с учетом особенностей вашей физиологии.
					</div>					
				</div>
				<div class="dieta_cell">
					<div class="dieta_cell_img">
						<img class="dieta_img" src="<?=@$pathBegin;?>images/diety9.jpg" />
						<div align="right">
							<strong>МИФ:</strong><br>
							<span>«Быстрые диеты» - самые эффективные</span>
						</div>
					</div>
					<div>
						<strong>НА САМОМ ДЕЛЕ:</strong><br>
						Такие диеты помогают быстро похудеть, но вес потом возвращается так же быстро, и становится еще больше, чем до диеты.
					</div>			
				</div>
			</div>

			<div>
				<div class="dieta_cell_img">
					<img class="dieta_img" src="<?=@$pathBegin;?>images/diety8.jpg" />
					<div>
						<strong>МИФ:</strong><br>
						<span>Не остановимся, пока не найдем самую лучшую диету</span>
					</div>
				</div>
				<div style="padding: 4px">
					<strong>НА САМОМ ДЕЛЕ:</strong><br>
					Вы доведете себя до такого состояния, что потом не сможете восстановить нормальный обмен веществ.
				</div>
			</div>
		</div>
		
		<div>
			<p>Выбирайте диеты правильно, не стремитесь получить все и сразу – так не бывает. Постепенна потеря веса, легкие физические нагрузки и прогулки на свежем воздухе сделают из вас красотку, главное верить в свои силы и быть оптимистически настроенной!</p>
		</div>
	</div>
</body>
</html>