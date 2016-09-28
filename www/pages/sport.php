<?
  header('Content-Type: text/html; charset=utf-8');
  $pathBegin = '../';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
  <? 
    $titlePage = 'Спорт'; 
    include $pathBegin . 'header_footer/base_meta.php';
  ?>
  <link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/styles.css" />
  <link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/button_styles.css" />
  <link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/font_styles.css">
  <script type="text/javascript" src="<?=@$pathBegin;?>js/jquery-2.2.3.js"></script>
  <script type="text/javascript" src="<?=@$pathBegin;?>js/main.js"></script>
  <script type="text/javascript" src="<?=@$pathBegin;?>js/jQueryRotateCompressed.2.2.js"></script>
</head>

<body topmargin="0">
  <div class="center_div">
    <?
      include $pathBegin . 'header_footer/header.php';
      include $pathBegin . 'header_footer/menu.php';
    ?>

    <!-- Тексты -->
      <div>
        <?
          // Добавляем тексты на страницу с данными id
          $ids = array(7, 8, 9, 10, 11, 12);

          // соединяемся с базой
          $conn = mysql_connect("localhost","nastya4835","4835"); 
          mysql_select_db("mybd"); 
          mysql_query("SET NAMES 'utf8'");

          // составляем запрос
          $query = "SELECT `title`, `text` FROM `content` WHERE `id` IN (". implode(',', array_map('intval', $ids)) . ");";
          $mysqlQuery = mysql_query($query);
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
            <div>
              <h1 class="green_text"><?=@ $row["title"]?></h1>
              <?=@ $row["text"]?>
              <a target="_blank" href="../pages/image_viewer.php?image=naklon.jpg"><img class="rotate1 sport_img_right" alt="Разминка" src="../images/naklon.jpg" title="Разминка очень важна" /></a>
            </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
            <div>
              <h2><?=@ $row["title"]?></h2>
              <?=@ $row["text"]?>
            </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
            <div>
              <a target="_blank" href="../pages/image_viewer.php?image=bicycle.jpg"><img id="rotate2" class="sport_img_left" alt="Упражнение велосипед" src="../images/bicycle.jpg" title="Упражнение велосипед" /></a>
              <h2><?=@ $row["title"]?></h2>
              <?=@ $row["text"]?>
            </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
            <div>
              <a target="_blank" href="../pages/image_viewer.php?image=hands.jpg"><img class="rotate1 sport_img_right" alt="Упражнения для груди" src="../images/hands.jpg" title="Упражнения для груди" /></a>
              <h2><?=@ $row["title"]?></h2>
              <?=@ $row["text"]?>
            </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
            <div>
              <h2><?=@ $row["title"]?></h2>
              <?=@ $row["text"]?>
            </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
            <div>
              <a target="_blank" href="../pages/image_viewer.php?image=feet.jpg"><img id="rotate3" class="sport_img_left" alt="Упражнение для бедер и ягодиц" src="../images/feet.jpg" title="Упражнение для бедер и ягодиц" /></a>
              <h2><?=@ $row["title"]?></h2>
              <?=@ $row["text"]?>
            </div>
        <?
          }
          mysql_close();
        ?>
      </div>
  </div>
</body>
</html>