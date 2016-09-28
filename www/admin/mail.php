<?
	// Проверяем был ли пост запрос
	if (isset($_POST["delete_id"])) {
		// Удаляем письмо
		// соединяемся с базой
		$conn = mysql_connect("localhost","nastya4835","4835");
		mysql_select_db("mybd");
		// составляем запрос
		$query = "DELETE FROM `feedbacks` WHERE `id`=" . $_POST["delete_id"];
		$mysqlQuery = mysql_query($query);
		mysql_close();
	} else if (isset($_POST["repeat_id"])) { 
		// Повторно отправляем письмо
		// соединяемся с базой
		$conn = mysql_connect("localhost","nastya4835","4835");
		mysql_select_db("mybd");
		mysql_query("SET NAMES 'utf8'");
		$query = "SELECT `id`, `name`, `email`, `title`, `message` FROM `feedbacks` WHERE `id`=" . $_POST["repeat_id"];
		$mysqlQuery = mysql_query($query);
		// найден ли кто-нибудь 
		$mailCount = mysql_num_rows($mysqlQuery);
		$value = NULL; 
		if ($mailCount != 0) {
			$value=mysql_fetch_array($mysqlQuery);
		}
		$to = '=?utf-8?B?'.base64_encode($value["email"]).'?=';
		$subject = '=?utf-8?B?'.base64_encode($value["title"]).'?=';
		$headers  = "Content-type: text/html; charset=utf-8\r\n"; 
		$headers .= "From: Kotova Nastya <kotova4835@gmail.com>\r\n"; 
		$message = $value["name"] . ", " . $value["message"];
		mail($to, $subject, $message, $headers);
		mysql_close();
	}
?>
	<!-- Начало таблицы с письмами -->
	<table>
	  <tr>
	    <th>ФИО</th>
	    <th>Почта</th>
	    <th>Тема</th>
	    <th>Сообщение</th>
	    <th>Удалить</th>
	    <th>Повторно отправить</th>
	  </tr>

<?
	// соединяемся с базой
	$conn = mysql_connect("localhost","nastya4835","4835");
	mysql_select_db("mybd");
	mysql_query("SET NAMES 'utf8'");
	// составляем запрос
	$query = "SELECT `id`, `name`, `email`, `title`, `message` FROM `feedbacks`;";
	$mysqlQuery = mysql_query($query);
	// найден ли кто-нибудь 
	$mailCount = mysql_num_rows($mysqlQuery);
	if ($mailCount != 0) {
		while ($row = mysql_fetch_array($mysqlQuery)) {
?>
		  <tr>
		    <td width="120px"><?=@$row["name"]?></td>
		    <td width="120px"><?=@$row["email"]?></td>
		    <td width="220px"><?=@$row["title"]?></td>
		    <td><?=@$row["message"]?></td>
		    <td width="80px"><form method="POST"><button name="delete_id" value=<?=@$row["id"]?>>Удалить</button></form></td>
		    <td width="80px"><form method="POST"><button name="repeat_id" value=<?=@$row["id"]?>>Отправить</button></form></td>
		  </tr>
<?		
		}
	}
	mysql_close();
?>
	<!-- Конец таблицы с письмами -->
	</table>