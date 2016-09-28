<?
  header('Content-Type: text/html; charset=utf-8');
  $pathBegin = '../';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
  <? 
    $titlePage = 'Витамины'; 
    include $pathBegin . 'header_footer/base_meta.php';
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

    <!-- Тексты -->
    <div>
      <?
        // Добавляем тексты на страницу с данными id
        $ids = array(4, 5, 6);

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

            <a target="_blank" href="../pages/image_viewer.php?image=vitamini.jpg"><img alt="Витамины в питании" src="../images/vitamini.jpg" class="vitamini_img" title="Витамины в продуктах питания - овощи" /></a>

            <?=@ $row["text"]?>
          </div>
      <?
        }
        while ($row = mysql_fetch_array($mysqlQuery)) {
      ?>
          <div>
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