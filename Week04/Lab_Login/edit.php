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
  if (isset($_POST["btnDelete"])) {

    header("Location: delete.php");
    exit();
  }


if (!isset($_GET["id"])) {
    die("id not found.");
}
$id = $_GET["id"];
if (!is_numeric($id)) {
    die("id is not a number");
}
require("connDB.php");
if (isset($_POST["btnOK"])&&$_POST["txtUserPhone"]!=""&&$_POST["txtUserAccount"]!=""&&$_POST["txtPassword"]!="") {
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
    if( $_SESSION['id']!="1"){
    $_SESSION['user'] = $username;}
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
    <link rel="stylesheet" href="css/jquery.toast.css">
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
          <font color="#FFFFFF">會員系統 - 編輯</font><br>
          <a>hello <?= $_SESSION["user"] ?> </a>
        </td>
        
      </tr>
      
      <tr>
        <td width="100" align="center" valign="baseline">使用者名稱</td>
        <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" value="<?= $row["username"] ?>"></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者電話</td>
        <td valign="baseline"><input type="text" name="txtUserPhone" id="txtUserPhone" value="<?= $row["phone"] ?>"/></td>
      </tr>
      <tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者帳號</td>
        <td valign="baseline"><input type="text" name="txtUserAccount" id="txtUserAccount" value="<?= $row["account"] ?>"/></td>
      </tr>
      <tr>
        <td width="100" align="center" valign="baseline">使用者密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" value="<?= $row["password"] ?>"/></td>
      </tr>
      
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="修改" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
          <input type="submit" name="btnDelete" id="btnDelete" value="刪除帳號" />
        </td>
      </tr>

    </table>
  </form>
</body>

</html>