<?
  session_start();
  if (!isset($POST["save_id"])) {
    header('Content-Type: text/html; charset=utf-8');
  }
  if (isset($_POST["save_id"])) {
      $conn = mysql_connect("localhost","nastya4835","4835");
      mysql_select_db("mybd");
      mysql_query("SET NAMES 'utf8'");
      
      $query = "UPDATE `content` SET `title`='" . $_POST["title"] . "', `text`='" . $_POST["text"] ."' WHERE `id` = " . $_POST["save_id"] . ";";
      $mysqlQuery = mysql_query($query);

      mysql_close();

      header( 'Location: /admin/?content=', true, 303 );
      return;
    } else if (isset($_POST["new_id"])) {
      $conn = mysql_connect("localhost","nastya4835","4835");
      mysql_select_db("mybd");
      mysql_query("SET NAMES 'utf8'");
      
      $query = "INSERT INTO `content` (`title`, `text`) VALUES ('" . $_POST["title"] . "', '" . $_POST["text"] . "');";
      $mysqlQuery = mysql_query($query);

      mysql_close();

      header( 'Location: /admin/?content=', true, 303 );
      return;
    }
?>

<!DOCTYPE html>
<html>
<head>
  <?
    $titlePage = 'Редактор'; 
    include '../header_footer/base_meta.php';
  ?>
  
  <script src="../ckeditor/ckeditor.js"></script>

  <style>
    .container{ 
      min-width:820px;
      max-width: 100%;
    }
    .left{
      float:left;
      min-width:500px;
      max-width: 600px;
    }
    .right{
      float:right;
      min-width:500px;
      max-width: 600px;
    }
  </style>
</head>
<body>
<?
  $title = null;
  $text = null;
  // Проверяем был ли пост запрос
  if (isset($_POST["edit_id"])) {
    // Удаляем текст
    // соединяемся с базой
    $conn = mysql_connect("localhost","nastya4835","4835");
    mysql_select_db("mybd");
    mysql_query("SET NAMES 'utf8'");
    // составляем запрос
    $query = "SELECT `title`, `text` FROM `content` WHERE `id` = " . $_POST["edit_id"] . ";";
    $mysqlQuery = mysql_query($query);
    $count = mysql_num_rows($mysqlQuery);
    if ($count == 1) {
      $row = mysql_fetch_array($mysqlQuery);
      $title = $row["title"];
      $text = $row["text"];
    } else {
      mysql_close();
      echo "Ошибка запроса текста";
      return;
    }
    mysql_close();
  } else if (!isset($_GET["new_text"])) {
    echo "Ошибка";
    return;
  }
?>

  <form method="POST">
<?
  if (isset($_GET["new_text"])) {
?>
    <button name="new_id" value="">Сохранить</button>
<?
  } else {
?>
    <button name="save_id" value=<?=@$_POST["edit_id"]?>>Сохранить</button>
<?
  }
?>
    <div class="container">
      <!-- Заголовок -->
      <div class="left">
        <h3>Заголовок</h3>
        <textarea name="title" id="editor1" rows="10" cols="80">
          <?=@$title?>
        </textarea>
      </div>
      <!-- Текст -->
      <div class="right">
        <h3>Текст</h3>
        <textarea name="text" id="editor2" rows="10" cols="80">
          <?=@$text?>
        </textarea>
      </div>
    </div>
  </form>

  <!-- http://ckeditor.com/download -->
  <!-- http://docs.ckeditor.com/#!/guide/dev_installation -->
  <script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
  </script>

</body>
</html>