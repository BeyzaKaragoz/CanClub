<?php
session_start();
require_once ("helpers.php");
login_control();

$db = db_connect();
$departments = $db->query("SELECT * FROM departments")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CanClub | Departmens</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php require_once ("topbar.php"); ?>

<div class="container-fluid">
    <div class="row">

        <?php require_once ("navbar.php"); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Departments</h1>
            </div>

            <div class="container text-center col-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <ul class="list-group text-left">
                            <?php foreach ($departments as $department) { ?>
                                <li class="list-group-item">
                                    <p class="m-0 float-left"><?php echo $department["name"]; ?></p>
                                    <a href="process.php?process=deletedepartment&department=<?php echo $department["id"]; ?>" class="float-right text-decoration-none"><span class="text-danger">Delete</span></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="js/jquery-3.3.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
