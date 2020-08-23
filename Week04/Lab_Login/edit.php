<?php

if (isset($_POST["cancelButton"])) {
    header("location:index.php");
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
if (isset($_POST["okButton"])) {
    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $cityId = $_POST["cityId"];
    $sql = <<<multi
    update employee set 
    lastName='$lastName',
    firstName='$firstName',
    cityId=$cityId
    where employee.employeeId=$id
multi;
    $result = mysqli_query($link, $sql);

    header("location:index.php");
    exit();
} else {
    $sql = <<<multi
    select * from employee where employeeId =$id
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <form method="post">
        <div class="form-group row box">
            <label for="firstName " class="col-4 col-form-label">First Name</label>
            <div class="col-8">
                <input id="firstName" name="firstName" value="<?= $row["firstName"] ?>" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row box">
            <label for="lastName" class="col-4 col-form-label">Last Name</label>
            <div class="col-8">
                <input id="lastName" name="lastName" value="<?= $row["lastName"] ?>" type="text" class="form-control">
            </div>
        </div>

        <div class="form-group row box">
            <label class="col-4">City</label>
            <div class="col-8">
                <div class="custom-control custom-radio custom-control-inline">
                    <input name="cityId" id="city_0" type="radio" <?= ($row["cityId"] == 2) ? "checked" : "" ?> class="custom-control-input" value="2">
                    <label for="city_0" class="custom-control-label">Taipei</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input name="cityId" id="city_1" type="radio" <?= ($row["cityId"] == 4) ? "checked" : "" ?> class="custom-control-input" value="4">
                    <label for="city_1" class="custom-control-label">Taichung</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input name="cityId" id="city_2" type="radio" <?= ($row["cityId"] == 6) ? "checked" : "" ?> class="custom-control-input" value="6">
                    <label for="city_2" class="custom-control-label">Tainin</label>
                </div>
            </div>
        </div>
        <div class="form-group row box">
            <div class="offset-4 col-8">
                <button name="okButton" type="okButton" class="btn btn-primary" value="ok"> 確定</button>
                <button name="cancelButton" type="cancelButton" class="btn btn-primary" value="ok"> 取消</button>
            </div>
        </div>
    </form>
</body>

</html>