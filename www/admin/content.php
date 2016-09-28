<?
	// Проверяем был ли пост запрос
	if (isset($_POST["delete_id"])) {
		// Удаляем текст
		// соединяемся с базой
		$conn = mysql_connect("localhost","nastya4835","4835");
		mysql_select_db("mybd");
		// составляем запрос
		$query = "DELETE FROM `content` WHERE `id` =" . $_POST["delete_id"] . ";";
		$mysqlQuery = mysql_query($query);
		mysql_close();
	}
?>
	<!-- Начало таблицы с текстами -->
	<table>
	  <tr>
	  	<th>ID</th>
	    <th>Заголовок</th>
	    <th>Текст</th>
	    <th>Удалить</th>
	    <th>Редактировать</th>
	  </tr>

<?
	// соединяемся с базой
	$conn = mysql_connect("localhost","nastya4835","4835");
	mysql_select_db("mybd");
	mysql_query("SET NAMES 'utf8'");
	// составляем запрос
	$query = "SELECT `id`, `title`, `text` FROM `content` ORDER BY `id` DESC;";
	$mysqlQuery = mysql_query($query);
	// найден ли кто-нибудь 
	$mailCount = mysql_num_rows($mysqlQuery);
	if ($mailCount != 0) {
		while ($row = mysql_fetch_array($mysqlQuery)) {
			$isEdit = isset($_POST["edit_id"]) && $_POST["repeat_id"] == $row["id"];
?>
		  <tr>
		  	<!-- http://stackoverflow.com/questions/16783708/how-to-display-raw-html-code-in-pre-or-something-like-it-but-without-escaping-it -->
		  	<td width="120px"><?=@htmlspecialchars($row["id"])?></td>
		    <td width="120px"><?=@htmlspecialchars($row["title"])?></td>
		    <td><?=@htmlspecialchars($row["text"])?></td>
		    <td width="80px"><form method="POST"><button name="delete_id" value=<?=@$row["id"]?>>Удалить</button></form></td>
	    	<td width="80px"><form action="edit.php" method="POST"><button name="edit_id" value=<?=@$row["id"]?>>Редактировать</button></form></td>
		  </tr>
<?		
		}
	}
	mysql_close();
?>
	<!-- Конец таблицы с текстами -->
	</table>