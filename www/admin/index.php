<?
  session_start();
  header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
  <? 
    $titlePage = 'Админка'; 
    include '../header_footer/base_meta.php';
  ?>

  <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #cccccc;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .container{width:350px;}
    .left{float:left;width:100px;}
    .right{float:right;width:100px;}
    .center{margin:0 auto;width:100px;}
  </style>
</head>
<body>
  <?
    // Проверяем, чтобы пользователь был залогинен и был админом
    if (!$_SESSION["name"] || $_SESSION["isadmin"] == 0) {
      echo "Вы не администратор";
      return;
    }
  ?>
  <!-- Кнопки выбора -->
  <div class="container">
    <!-- ПОЧТА -->
    <div class="left">
      <form method="GET">
        <button name="mail" style="height: 40px;">Просмотреть почту</button>
      </form>
    </div>
    <!-- КОНТЕНТ -->
    <div class="right">
      <form method="GET">
        <button name="content" style="height: 40px;">Просмотреть контент</button>
      </form>   
    </div>
    <!-- КОНТЕНТ -->
    <div class="center">
      <form method="GET">
        <button name="users" style="height: 40px;">Пользователи</button>
      </form>   
    </div>
  </div>
  
  <? 
    // Кнопка просмотра почты
    if (isset($_GET["mail"])) {
      include 'mail.php';
    } 
    // Кнопка просмотра текстов страниц 
    else if (isset($_GET["content"])) {
?>
      <form action="edit.php" method="GET">
        <button name="new_text" style="height: 20px;">Добавить новый текст</button>
      </form>
<?
      include 'content.php';
    } 
    // Кнопка просмотра пользователей
    else if (isset($_GET["users"])) {
      include 'users.php';
    }
  ?>
</body>
</html>