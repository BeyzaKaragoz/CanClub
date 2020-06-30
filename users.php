<?php
session_start();
require_once ("helpers.php");
login_control();

$db = db_connect();
$users = $db->query("SELECT * FROM users WHERE id != '{$_SESSION["login_user"]["id"]}'")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CanClub | Users</title>

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
                <h1 class="h2">Users</h1>
            </div>

            <div class="container text-center col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group text-left">
                            <?php foreach ($users as $user) { ?>
                                <?php $user_department = $db->query("SELECT * FROM departments WHERE id = '{$user["department_id"]}'")->fetch(); ?>
                                <li class="list-group-item">
                                    <div class="clearfix">
                                        <p class="m-0 font-weight-bold float-left">
                                            <img class="mb-1 mr-1 rounded-circle" src="attend/user/<?php echo $user["picture"]; ?>" width="50" alt="User Picture">
                                            <?php echo $user["name"]." ".$user["surname"]." - ".$user["username"]; ?>
                                        </p>
                                        <a href="process.php?process=deleteuser&user=<?php echo $user["id"]; ?>" class="float-right text-decoration-none"><span class="text-danger">Delete</span></a>
                                    </div>
                                    <hr>
                                    <p class="m-0"><span class="font-weight-bold">Department:</span> <?php echo $user_department["name"]; ?></p>
                                    <p class="m-0"><span class="font-weight-bold">Birthday:</span> <?php echo $user["birthday"]; ?></p>
                                    <p class="m-0"><span class="font-weight-bold">Mail:</span> <?php echo $user["mail"]; ?></p>
                                    <p class="m-0"><span class="font-weight-bold">Information:</span> <?php echo (!empty($user["information"])) ? $user["information"] : "Information not available." ?></p>
                                    <p class="m-0"><span class="font-weight-bold">Type:</span> <?php echo ($user["type"] == "0") ? "Admin" : "User" ?></p>
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
