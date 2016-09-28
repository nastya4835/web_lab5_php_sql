<!-- Заголовок -->
<div style="text-align: center">
  <h1 class="green_text">Обратная связь</h1>
</div>
<!-- Логика -->
<?php
  if (isset($_POST['seen']))
  {
    $fio = trim(htmlspecialchars($_POST["fio"]));
    $el_p = trim(htmlspecialchars($_POST["el_p"]));
    $theme = trim(htmlspecialchars($_POST["theme"]));
    $mes = trim(htmlspecialchars($_POST["message"]));

    $sp_mes = NULL;
    $sp_fio = NULL;
    $sp_elp = NULL;

    $flag = true;

    if (mb_strlen($fio, "UTF-8") < 15)
    {
      $sp_fio.="  Заполните поле 'ФИО'";
      $flag = false;
    }
    if((mb_strlen($el_p, "UTF-8") == 0) || (!preg_match("/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i",$el_p)))
    {
      $sp_elp.="  Поле 'Электронная почта' не заполнено, либо введен неверный E-Mail.";
      $flag = false;
    }
    if (mb_strlen($mes, "UTF-8") < 10)
    {
      $sp_mes.="  Корректно заполните поле 'Сообщение. Необходимо ввести не менее 10 символов.'";
      $flag = false;
    }

      // Если все поля заполнены корректно, то отправляем письмо
    if ($flag) {
      $to = '=?utf-8?B?'.base64_encode($el_p).'?=';
      $subject = '=?utf-8?B?'.base64_encode($theme).'?=';
      $headers  = "Content-type: text/html; charset=utf-8\r\n"; 
      $headers .= "From: Kotova Nastya <kotova4835@gmail.com>\r\n"; 
      if (mail($to, $subject, $fio . ", " . $mes, $headers)) {
        echo "<h3>ПИСЬМО ОТПРАВЛЕНО</h3>";

        // Если письмо отправилось, то сохраняем его в базу
        // соединяемся с базой
        $conn = mysql_connect("localhost","nastya4835","4835");
        mysql_select_db("mybd");
        // Составляем запрос для вставки строки в таблицу
        $query = "INSERT INTO `feedbacks` (`name`, `email`, `title`, `message`) VALUES ('". $fio . "', '" . $el_p . "', '" . $theme . "', '" . $mes . "')";
        /// Выполняем запрос
        mysql_query($query);

        $fio=$el_p=$theme=$mes=NULL;
      } else {
        echo "<h3>ПИСЬМО НЕ ОТПРАВЛЕНО</h3>";
      }
    }
  }
?>
<!-- Верстка формы -->
<div id="content">
  <form method='post'>
    <p>ФИО*: <br> <input style="width: 200px; border: solid 1px #cccccc;" type="text" name="fio" value="<?=@$fio;?>"></input><span style="background:#FF0000;"><?=@$sp_fio;?></span></p>
    
    <p>Электронная почта*: <br> <input style="width: 200px; border: solid 1px #cccccc;" type="text" name="el_p" value="<?=@$el_p;?>"></input><span style="background:#FF0000;"><?=@$sp_elp;?></span></p>
    
    <p>Тема сообщения: <br> <input style="width: 200px; border: solid 1px #cccccc;" type="text" name="theme"></input></p>
    
    <p>Сообщение*:</p>
    <p><textarea name="message" rows="10" cols="50"><?=@$mes;?></textarea><span style="background:#FF0000;"><?=@$sp_mes;?></span></p>
    <input type="hidden" name="seen" value="data"></input>
    
    <p><input type="submit"  value="Отправить"></input></p>
  </form>
</div>