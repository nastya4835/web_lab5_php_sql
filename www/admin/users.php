<?
	// Проверяем был ли пост запрос
	if (isset($_POST["delete_id"])) {
		// Удаляем текст
		// соединяемся с базой
		$conn = mysql_connect("localhost","nastya4835","4835");
		mysql_select_db("mybd");
		// составляем запрос
		$query = "DELETE FROM `users` WHERE `id` =" . $_POST["delete_id"] . ";";
		$mysqlQuery = mysql_query($query);
		mysql_close();
	} else if (isset($_POST["remove_admin_id"])) {
		// соединяемся с базой
		$conn = mysql_connect("localhost","nastya4835","4835");
		mysql_select_db("mybd");
		// составляем запрос
		$query = "UPDATE `users` SET `isadmin`=0 WHERE `id` =" . $_POST["remove_admin_id"] . ";";
		$mysqlQuery = mysql_query($query);
		mysql_close();
	} else if (isset($_POST["add_admin_id"])) {
		// соединяемся с базой
		$conn = mysql_connect("localhost","nastya4835","4835");
		mysql_select_db("mybd");
		// составляем запрос
		$query = "UPDATE `users` SET `isadmin`=1 WHERE `id` =" . $_POST["add_admin_id"] . ";";
		$mysqlQuery = mysql_query($query);
		mysql_close();
	}
?>
	<!-- Начало таблицы с текстами -->
	<table>
	  <tr>
	    <th>Имя</th>
	    <th>Почта</th>
	    <th>Дать права администратора</th>
	    <th>Удалить</th>
	  </tr>

<?
	// соединяемся с базой
	$conn = mysql_connect("localhost","nastya4835","4835");
	mysql_select_db("mybd");
	mysql_query("SET NAMES 'utf8'");
	// составляем запрос
	$query = "SELECT `id`, `name`, `email`, `isadmin` FROM `users` ORDER BY `id` ASC;";
	$mysqlQuery = mysql_query($query);
	// найден ли кто-нибудь 
	while ($row = mysql_fetch_array($mysqlQuery)) {
?>
		  <tr>
		    <td width="120px"><?=@$row["name"]?></td>
		    <td><?=@$row["email"]?></td>
<?
			if ($row["isadmin"] == 1) {
?>
			    <td width="80px"><form method="POST"><button name="remove_admin_id" value=<?=@$row["id"]?>>Забрать права администратора</button></form></td>
<?
			} else {
?>
			    <td width="80px"><form method="POST"><button name="add_admin_id" value=<?=@$row["id"]?>>Дать права администратора</button></form></td>
<?
			}
?>
	    	<td width="80px"><form method="POST"><button name="delete_id" value=<?=@$row["id"]?>>Удалить</button></form></td>
		  </tr>
<?		
	}
	mysql_close();
?>
	<!-- Конец таблицы с текстами -->
	</table>