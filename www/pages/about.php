<?
	header('Content-Type: text/html; charset=utf-8');
	$pathBegin = '../';
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/font_styles.css" />
</head>
<body>
	<p>Введите имя папки, размер которой хотите узнать</p>
	<form method="GET">
		<input name="dirName" value="<?=@$_GET["dirName"]?>"></input>
		<input type="submit" value="Обновить"></input>
	</form>
	<?
		function recursiveDirSize($path) {
			$size = 0;
			$ite = new RecursiveDirectoryIterator($path);
			foreach(new RecursiveIteratorIterator($ite) as $cur) {
				$size += $cur->getSize();
			}
			return $size;
		}

		$dirName = dirname(__FILE__) . "\\" . $_GET["dirName"];
		if (!file_exists($dirName)) {
			echo "Папка не существует";
			return;
		}


		echo "Размер папки: " . $dirName . "<br>";
		$s = recursiveDirSize($dirName);
		$kb = round($s/1024, 2);
		if ($kb/1024 > 0) {
			echo round($kb/1024, 2).' mb ';
		} else {
			echo $kb .' kb ';
		}
	?>
	<p><center><a style="text-decoration:none; color:#4183c4;" href="<? echo $pathBegin; ?>index.php">На главную</a></center></p>
</body>
</html>
