<?php
if(!isset($_GET["id"])){
 die("id not found."); 
}
$id=$_GET["id"];
if(!is_numeric($id)){
    die("id is not a number");
}
$sql = <<<multi
    delete from employee where employeeId =$id
multi;

require("connDB.php");
mysqli_query($link, $sql);
// $_SESSION["toast"]="Row inserted";
header("location:index.php");
?>