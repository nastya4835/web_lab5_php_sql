<?
  session_start();
  if (isset($_POST["logout"])) {
    unset($_SESSION['name']);
    unset($_SESSION['isadmin']);
    session_destroy();
    session_start();
  }
  header('Content-Type: text/html; charset=utf-8');

  function checkEmail($mail) {
    if (strlen($mail)==0) return true;
    
    if (!preg_match("/^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i",$mail)) {
        return false;
      }
    return true;
  }

  if (!isset($_SESSION["name"])) {
    // Показываем форму Авторизация
    $isLogin = false;
    // Показываем форму Регистрация
    $isRegister = false;
    // Показываем форму Восстановление пароля
    $isForgot = false;
    //Это POST запрос
    $isPost = false;

    // Общая переменная для хранения email
    $email = '';
    // Флаг, указывающий на валидность
    $emailIsValid = true;
    $loginIsValid = true;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['seen']) && !isset($_POST["logout"])) {
      if (isset($_POST['register_form'])) {
        $email = $_POST['reg_email'];
        $login = $_POST['reg_login'];
        $password = $_POST['reg_pass'];
        $repassword = $_POST['reg_repass'];

        $isRegister = true;
      } else if (isset($_POST['login_form'])) {
        $login = $_POST['auth_login'];
        $password = $_POST['auth_pass'];
        $isPost = true;
        $isLogin = true;
      } else if (isset($_POST['forgot_form'])) {
        $email = $_POST['forgot_email'];

        $isForgot = true;
      }

      $emailIsValid = checkEmail($email);
      $loginIsValid = strlen($login) >= 5;
      if ($isForgot) {
        $passIsValid = true;
      } else {
        $passIsValid = strlen($password) >= 4 && $login != $password && ($isRegister ? $password == $repassword : true); 
      }
      
      if ($emailIsValid && $passIsValid) {

        // соединяемся с базой
        $conn = mysql_connect("localhost","nastya4835","4835"); 
        mysql_select_db("mybd"); 

        // составляем запрос
        $query = "SELECT `name`, `email`, `password`, `isadmin` FROM `users` WHERE `name` = '". $login . "' OR `email` = '" . $email . "';";
        $mysqlQuery = mysql_query($query);
        // найден ли кто-нибудь 
        $usersCount = mysql_num_rows($mysqlQuery);
        $value = NULL; 
        if ($usersCount != 0) {
          $value=mysql_fetch_array($mysqlQuery);
        }

        if ($isLogin && $value["password"] == $password) {
          // записываем логин и емейл в сессию
          $_SESSION['isadmin'] = $value['isadmin'];
          $_SESSION['name'] = $value['name'];
        } else if ($isRegister) {
          if ($value == NULL) {
            $query = "INSERT INTO `users` (`email`, `name`, `password`) VALUES ('". $email . "', '" . $login . "', '" . $password . "')";
            if (mysql_query($query)) {
              $_SESSION['isadmin'] = 0;
              $_SESSION['name'] = $login;
            }
          } else {
            $badUserName = true;
          }
        } else if ($isForgot && $value != NULL) {
          $to = '=?utf-8?B?'.base64_encode($value["email"]).'?=';
          $subject = '=?utf-8?B?'.base64_encode("Восстановление пароля").'?=';
          $headers  = "Content-type: text/html; charset=utf-8\r\n"; 
          $headers .= "From: Kotova Nastya <kotova4835@gmail.com>\r\n"; 
          $message = "Ваш пароль: " . $value["password"]; 
          if (mail($to, $subject, $message, $headers)) {
            echo "<h3>ПИСЬМО ОТПРАВЛЕНО</h3>";
          } else {
            echo "<h3>ПИСЬМО НЕ ОТПРАВЛЕНО</h3>";
          }
        }

        mysql_close();
      }
    } else {
      $isLogin = true;
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
  <? 
    $titlePage = 'Здоровый образ жизни и правильное питание'; 
    include 'header_footer/base_meta.php';
  ?>
  <link rel="stylesheet" type="text/css" href="css/semantic.css" />
  <link rel="stylesheet" type="text/css" href="css/styles.css" />
  <link rel="stylesheet" type="text/css" href="css/button_styles.css" />
  <link rel="stylesheet" type="text/css" href="css/font_styles.css" />
  <link rel='stylesheet prefetch' href="form/css/font-awesome.min.css" />
  <link rel="stylesheet" href="form/css/style.css" media="screen" type="text/css" />
  <script type="text/javascript" src="js/jquery-2.2.3.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/semantic.js"></script>
</head>

<body topmargin="0">
  <!-- Время -->
  <span id="doc_time" class="clock">Дата и время</span>
    <script type="text/javascript"> 
    clock();
    </script>
  <input style="margin: 10px"  id="b1" value="Отличный сайт!" onclick="alert('Спасибо!');" type="button"/>
  <!-- Основной контент -->
  <div id="image123" class="center_div">
    <!-- Шапка -->
    <?
      include 'header_footer/header.php';
    ?>

    <div class="indicator loading"><img src="images/indicator.gif" alt=""></div>

    <!-- Выбор цвета -->
    <select style="margin: 10px" class="ui dropdown" id="background_page">
      <option value=0>Черный фон</option>
      <option value=1 selected>Белый фон</option>
      <option value=2>Туманно-розовый</option>
      <option value=3>Оливковый</option>
      <option value=4>Желто-зеленый</option>
      <option value=5>Бирюзовый</option>
    </select>
    
    <!-- Подключаем меню и проверяем авторизованный пользователь или нет -->
    <?
      include 'header_footer/menu.php';
      if ($_SESSION["name"]) {
    ?>
      <!-- Если пользователь авторизован – приветствуем его -->
      <h2 style="color:#01DF01" >Привет, <?=@ $_SESSION["name"] ?></h2>
      <form method="POST">
        <input type="submit" name="logout" value="Выйти">
      </form>
    <? 
      } else {
        // Если пользователь не авторизован показываем форму регистрации/авторизации
        include 'registration_div.php';
      }
    ?>

    <!-- Тексты -->
    <div>
      <?
        // Добавляем тексты на страницу с данными id
        $ids = array(1, 2, 3);

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
            <h1 class="green_text"><blink><?=@ $row["title"]?></blink></h1>
            <div id="animate">
              <em><?=@ $row["text"]?></em>
            </div>
          </div>
      <?
        }
        if ($row = mysql_fetch_array($mysqlQuery)) {
      ?>
          <div>
            <h2 class="green_text"><?=@ $row["title"]?></h2>
            
            <a target="_blank" href="pages/image_viewer.php?image=eda.jpg"><img class="index_img1" alt="Правильное питание" src="images/eda.jpg" title="Правильное питание - почему оно необходимо?" /></a>
            
            <?=@ $row["text"]?>
          </div>
      <?
        }
        if ($row = mysql_fetch_array($mysqlQuery)) {
      ?>
          <div>
            <h2 class="green_text"><?=@ $row["title"]?></h2>

            <div class="div_style">           
              <a target="_blank" href="pages/image_viewer.php?image=slide_1.jpg"><img class="index_img2 img_style hidden" id="img_1" src="images/slide_1.jpg"></a>          
              <a target="_blank" href="pages/image_viewer.php?image=slide_2.jpg"><img class="index_img2 img_style hidden" id="img_2" src="images/slide_2.jpg"></a>          
              <a target="_blank" href="pages/image_viewer.php?image=slide_3.jpg"><img class="index_img2 img_style hidden" id="img_3" src="images/slide_3.jpg"></a>          
              <a target="_blank" href="pages/image_viewer.php?image=slide_4.jpg"><img class="index_img2 img_style hidden" id="img_4" src="images/slide_4.jpg"></a>          
              <a target="_blank" href="pages/image_viewer.php?image=23.jpg"><img class="index_img2 img_style hidden" id="img_5" src="images/23.jpg"></a>        
            </div>

            <?=@ $row["text"]?>
          </div>
      <?
        }
        while ($row = mysql_fetch_array($mysqlQuery)) {
?>
          <div>
            <h2 class="green_text"><?=@ $row["title"]?></h2>
            <?=@ $row["text"]?>
          </div>  
<?
        }
      ?>
    </div>

    <!-- Обратная связь только для авторизованных пользователей -->
    <?
    mysql_close();

    if ($_SESSION["name"]) {
      include 'feedback_div.php';
    } 
    ?>
    <!-- О сайте -->
    <p><center><a href="<? echo $pathBegin; ?>pages/about.php">О сайте</a></center></p>
  </div>
</body>
</html>