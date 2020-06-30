<?php
session_start();
require_once("helpers.php");
login_control();

$db = db_connect();
$activity_types = $db->query("SELECT * FROM activity_types")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CanClub | Add Activity</title>

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
                <h1 class="h2">Add Activity</h1>
            </div>

            <div class="container text-center col-12">
                <div class="card">
                    <form action="process.php" method="POST">
                        <div class="card-body">
                            <label class="w-100">
                                <select class="form-control" name="activity_type">
                                    <?php foreach ($activity_types as $activity_type) { ?>
                                        <option value="<?php echo $activity_type["id"]; ?>"><?php echo $activity_type["name"]; ?></option>
                                    <?php } ?>
                                </select>
                            </label>
                            <label class="w-100"><input type="text" class="form-control" placeholder="Title" required name="activity_title" autofocus></label>
                            <label class="w-100"><textarea class="form-control" placeholder="Information" required name="activity_information"></textarea></label>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="add_activity">Add Activity</button>
                        </div>
                    </form>
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
