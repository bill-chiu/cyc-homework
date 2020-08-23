<?php

session_start();

$userName = "Guest";
if (isset($_SESSION["user"])) {
  $userName = $_SESSION["user"];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Lab - index</title>
</head>

<body>
  <form id="form1" name="form1" method="post">
    <table width="450" border="0" align="center" cellpadding="20" cellspacing="0" bgcolor="#F2F2F2">
      <tr>
        <td align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">會員系統 - 首頁</font>
        </td>
      </tr>
      <tr>
        <td colspan="" align="center" bgcolor="#F2F2F2">

          <p>[<a href="admin.php">管理資料</a>]
            <?php
            if ($_SESSION["login_session"] == false) { ?>
              [<a href="login.php">登入帳號</a>]</a>
            <?php } else { ?>

              [<a href="sign_out.php">登出帳號</a>]</p>
        <?php } ?>
        [<a href="add.php">註冊帳號</a>]
  
        [<a href="edit.php?id=<?=$_SESSION['id']?>">修改帳號</a>]
      



        
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">您好 <?= $userName ?> &nbsp;</td>
      </tr>
    </table>
  </form>


</body>

</html>