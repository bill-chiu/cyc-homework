<?php

session_start();
require("connDB.php");
$sql = "SELECT * from students";
$result = mysqli_query($link, $sql);


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Lag - Member Page</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

  <table width="600" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <tr>
      <td align="center" bgcolor="#CCCCCC">
        <font color="#FFFFFF">會員系統 － 會員專用</font>
      </td>
    </tr>
    <tr>

      <td align="center" valign="baseline">
       
      <?php  if ($_SESSION["login_session"] == false) { ?>
     
          <a href="login.php">This page for user only.</a>

        <?php } else { ?>
          <?php if ($_SESSION["id"] != "1") { ?>
            <a href="index.php">This page for admin only.</a>
            <?php } else { ?>

          <a>hello <?= $_SESSION["user"] ?> </a>
        <?php } ?>
        <?php } ?>
    </tr>
    <?php if ($_SESSION["id"] == "1") { ?>




      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?= $row["username"] ?></td>
          <td><?= $row["phone"] ?></td>
          <td><?= $row["account"] ?></td>
          <td><?= $row["password"] ?></td>


          <td>
            <a href="edit.php?id=<?= $row["studentsId"] ?>" class="btn btn-success btn-sm">Edit</a>
            <a href="admindelete.php?id=<?= $row["studentsId"] ?>" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
      <?php  } ?>
    <?php } else { ?>
      <!-- <a href="index.php">This page for admin only.</a> -->
    <?php  } ?>
    </td>



    </tr>

    <tr>
      <td align="center" bgcolor="#CCCCCC"><a href="index.php">回首頁</a></td>
    </tr>
  </table>


</body>

</html>