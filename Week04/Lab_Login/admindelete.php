<?php
    if(!isset($_GET["id"])){
        die("id not found."); 
       }
       $id=$_GET["id"];
       if(!is_numeric($id)){
           die("id is not a number");
       }
       if ($id!=1){
       $sql = <<<multi
       delete from students where studentsId =$id
       multi;
       
       require("connDB.php");
       mysqli_query($link, $sql);
       }
       header("location:admin.php");
?>