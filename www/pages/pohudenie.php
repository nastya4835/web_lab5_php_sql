<?
  header('Content-Type: text/html; charset=utf-8');
  $pathBegin = '../';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
  <? 
    $titlePage = 'Похудение'; 
    include $pathBegin . "header_footer/base_meta.php";
  ?>
  <link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/styles.css" />
  <link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/button_styles.css" />
  <link rel="stylesheet" type="text/css" href="<?=@$pathBegin;?>css/font_styles.css">
</head>

<body topmargin="0">
  <div class="center_div">
    <?
      include $pathBegin . "header_footer/header.php";
      include $pathBegin . "header_footer/menu.php";
    ?>

    <!-- Тексты -->
      <div>
        <?
          // Добавляем тексты на страницу с данными id
          $ids = array(13, 14, 15, 16, 17, 18, 19);

          // соединяемся с базой
          $conn = mysql_connect("localhost","nastya4835","4835"); 
          mysql_select_db("mybd"); 
          mysql_query("SET NAMES 'utf8'");

          // составляем запрос
          $query = "SELECT `title`, `text` FROM `content` WHERE `id` IN (". implode(',', array_map('intval', $ids)) . ");";
          $mysqlQuery = mysql_query($query);
          // Количество найденных текстов
          $count = mysql_num_rows($mysqlQuery);
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
              <div>
                <h1 class="green_text"><?=@ $row["title"]?></h1>
                <div style="text-align: center">
                  <?=@ $row["text"]?>
                </div>
              </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
              <div>
                <h2><?=@ $row["title"]?></h2>
                <a target="_blank" href="../pages/image_viewer.php?image=pohudenie1.jpg"><img class="pohudenie_img1" src="../images/pohudenie1.jpg" title="За ужином - минимум калорий" /></a>
                <?=@ $row["text"]?>
              </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
              <div>
                <h2><?=@ $row["title"]?></h2>
                <a target="_blank" href="../pages/image_viewer.php?image=pohudenie2.jpg"><img class="pohudenie_img2" src="../images/pohudenie2.jpg" title="Убавьте порции" /></a>
                <?=@ $row["text"]?>
              </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
              <div>
                <h2><?=@ $row["title"]?></h2>
                <a target="_blank" href="../pages/image_viewer.php?image=pohudenie3.jpg"><img class="pohudenie_img3"  src="../images/pohudenie3.jpg" title="Растягивайте удовольствие" /></a>
                <?=@ $row["text"]?>
              </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
              <div>
                <h2><?=@ $row["title"]?></h2>
                <a target="_blank" href="../pages/image_viewer.php?image=pohudenie4.jpg"><img class="pohudenie_img3" src="../images/pohudenie4.jpg" title="Питайтесь малокалорийными продуктами" /></a>
                <?=@ $row["text"]?>
              </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
              <div>
                <h2><?=@ $row["title"]?></h2>
                <a target="_blank" href="../pages/image_viewer.php?image=pohudenie5.jpg"><img class="pohudenie_img5" src="../images/pohudenie5.jpg" title="Тяните время" /></a>
                <?=@ $row["text"]?>
              </div>
        <?
          }
          if ($row = mysql_fetch_array($mysqlQuery)) {
        ?>
              <div>
                <h2><?=@ $row["title"]?></h2>
                <a target="_blank" href="../pages/image_viewer.php?image=pohudenie6.jpg"><img class="pohudenie_img3" src="../images/pohudenie6.jpg" title="Дайте себе физическую нагрузку" /></a>
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