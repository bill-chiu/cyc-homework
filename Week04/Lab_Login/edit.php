<?php




session_start();


if ($_SESSION["user"]== "Guest") {
    header("location:admin.php");
    exit();
}



if (isset($_POST["btnHome"])) {

    header("Location: index.php");
    exit();
  }

if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];
if (!is_numeric($id)) {
    die("id is not a number");
}
echo $id;
require("connDB.php");
if (isset($_POST["btnOK"])) {
    $username=$_POST["txtUserName"];
    $userphone=$_POST["txtUserPhone"];
    $account = $_POST["txtUserAccount"];
    $password = $_POST["txtPassword"];

    $sql = <<<multi
    update students set 
    username='$username',
    phone='$userphone',
    account='$account',
    password='$password'
    where students .studentsId=$id
multi;


    $result = mysqli_query($link, $sql);
    $_SESSION['user'] = $username;
    header("location:index.php");
    exit();
} else {
    $sql = <<<multi
    select * from students  where studentsId =$id
multi;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .box {

            padding-left: 100px;
            padding-right: 100px;


        }
    </style>
</head>
<body>
  <form id="form1" name="form1" method="post">
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">會員系統 - 註冊</font>
        </td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者名稱</td>
        <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者電話</td>
        <td valign="baseline"><input type="text" name="txtUserPhone" id="txtUserPhone" /></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者帳號</td>
        <td valign="baseline"><input type="text" name="txtUserAccount" id="txtUserAccount" /></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>
      
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="登入" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
        </td>
      </tr>

    </table>
  </form>
</body>

</html>