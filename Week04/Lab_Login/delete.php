<?php
session_start();
$id=$_SESSION['id'];
if ($id!=1){
$sql = <<<multi
    delete from students where studentsId =$id
multi;

require("connDB.php");
mysqli_query($link, $sql);
}
require("sign_out.php");

?>