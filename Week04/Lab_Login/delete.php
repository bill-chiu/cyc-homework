<?php
session_start();
$id=$_SESSION['id'];

$sql = <<<multi
    delete from students where studentsId =$id
multi;

require("connDB.php");
mysqli_query($link, $sql);
require("sign_out.php");

?>

