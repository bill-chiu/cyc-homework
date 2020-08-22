<?php

session_start();

$userName = "Guest";
if (isset($_SESSION["uid"])) {
  $userName = $_SESSION["uid"];
}
if (isset($_POST["btnLogin"])) {
  header("Location: login.php");
}
if (isset($_POST["btnOut"])) {
  $userName = "Guest";
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
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
      <tr>
        <td align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">會員系統 - 首頁</font>
        </td>
      </tr>
      <tr>
        <td colspan="" align="center" bgcolor="#F2F2F2">
   
        <?php
        if ($userName == "Guest") { ?>
           <input type="submit" name="btnLogin" id="btnLogin" value="登入" action="login.php" />
          
        <?php } else { ?>
                <input type="submit" name="btnOut" id="btnOut" value="登出" action="index.php"/>
        <?php } ?>


        <!-- | <a href="secret.php">會員專用頁</a></td> -->


        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#CCCCCC">您好 <?= $userName ?> &nbsp;</td>
      </tr>
    </table>
  </form>


</body>

</html>