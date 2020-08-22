<?php
//啟用session
session_start();

//如果沒有驗證碼

$img1 = 1;

function randowverif()
{

  $_SESSION['verification1 '] = rand(0, 9);
  $_SESSION['verification2 '] = rand(0, 9);
  $_SESSION['verification3 '] = rand(0, 9);
  $_SESSION['verification4 '] = rand(0, 9);
  
  global $img1;
  global $img2;
  global $img3;
  global $img4;
  $img1 = $_SESSION['verification1 '] . '.GIF';
  $img2 = $_SESSION['verification2 '] . '.GIF';
  $img3 = $_SESSION['verification3 '] . '.GIF';
  $img4 = $_SESSION['verification4 '] . '.GIF';
}


if (!isset($_POST["Verif"])) {
  randowverif();
}
$_SESSION['verification '] = $_SESSION['verification1 '] * 1000 + $_SESSION['verification2 '] * 100 + $_SESSION['verification3 '] * 10 + $_SESSION['verification4 '];

$username = "";
$password = "";
$verif = "";

//如果按下按鈕

if (isset($_POST["btnOK"])) {
  $username = $_POST["txtUserName"];
  $password = $_POST["txtPassword"];
  $verif = $_POST["Verif"];
}


if (isset($_POST["btnHome"])) {

  header("Location: index.php");
}
// 檢查是否輸入使用者名稱和密碼
if ($username != "" && $password != "") {
  // 建立MySQL的資料庫連接 
  require("connDB.php");
  // 建立SQL指令字串
  $sql = "SELECT * FROM students WHERE `password`='$password' AND `username`='$username'";

  // 執行SQL查詢
  $result = mysqli_query($link, $sql);
  $total_records = mysqli_num_rows($result);
  // 是否有查詢到使用者記錄

  if ($total_records > 0 && $_SESSION['verification '] == $verif) {
    // && $_SESSION['verification '] == $verif
    // 成功登入, 指定Session變數
    $_SESSION['user'] = $username;
    $_SESSION["login_session"] = true;

    header("Location: index.php");
  } else {  // 登入失敗
    randowverif();
    if (!$total_records > 0) {
      echo "<center><font color='red'>";
      echo "使用者名稱或密碼錯誤!<br/>";
      echo "</font>";
    } else {
      echo "<center><font color='red'>";
      echo "驗證碼錯誤!<br/>";
      echo "</font>";
    }

    $_SESSION["login_session"] = false;
  }
  mysqli_close($link);  // 關閉資料庫連接  
} else {
  randowverif();

  echo "<center><font color='red'>";
  echo "使用者名稱或密碼未輸入!<br/>";
  echo "</font>";
}

?>

<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Lab - Login</title>
</head>

<body>
  <form id="form1" name="form1" method="post">

    測試用帳密:jay / 1234

    jolin / 1234
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">會員系統 - 登入</font>
        </td>
      </tr>
      <tr>
        <td width="80" align="center" valign="baseline">使用者帳號</td>
        <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>
      </tr>
      <tr>
        <td width="80" align="center" valign="baseline">使用者密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>
      <tr>
        <td>
          <font size="2">驗證碼:</font>
          <p><img src="<?php echo "images/" . $img1 ?>" width="75" height="75" /></p>
          <p><img src="<?php echo "images/" . $img2 ?>" width="75" height="75" /></p>
          <p><img src="<?php echo "images/" . $img3 ?>" width="75" height="75" /></p>
          <p><img src="<?php echo "images/" . $img4 ?>" width="75" height="75" /></p>
        </td>

        <td><input type="text" name="Verif" size="15" maxlength="10" />
        </td>

      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="登入" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" onclick="index.php" />
        </td>
      </tr>

    </table>
  </form>
</body>

</html>