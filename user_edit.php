<?php
session_start();
require_once ("helpers.php");
login_control();

$db = db_connect();
$departments = $db->query("SELECT * FROM departments")->fetchAll();
$user = $db->query("SELECT * FROM users WHERE id = '{$_SESSION["login_user"]["id"]}'")->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CanClub | HomePage</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<?php require_once ("topbar.php"); ?>

<div class="container-fluid mb-4">
    <div class="row">

        <?php require_once ("navbar.php"); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div class="container text-center col-12">
                <div class="card">
                    <div class="card-body">
                        <img class="mb-1 mr-1 rounded-circle" src="attend/user/<?php echo $user["picture"]; ?>" width="200" alt="User Picture">
                        <hr>
                        <form action="process.php" method="POST" enctype="multipart/form-data">
                            <label class="w-100"><input type="file" class="form-control" name="user_picture" style="height: unset"></label>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="edit_picture">Update Picture</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="process.php" method="POST">
                            <label class="w-100">
                                <select class="form-control" disabled readonly="">
                                    <?php foreach ($departments as $department) { ?>
                                        <option value="<?php echo $department["id"]; ?>" <?php echo ($user["department_id"] == $department["id"]) ? "selected" : "" ?>>
                                            <?php echo $department["name"]; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </label>
                            <label class="w-100"><input type="text" class="form-control" placeholder="Name" required name="edit_name" autofocus value="<?php echo $user["name"]; ?>"></label>
                            <label class="w-100"><input type="text" class="form-control" placeholder="Surname" required name="edit_surname" value="<?php echo $user["surname"]; ?>"></label>
                            <label class="w-100"><input type="date" class="form-control" placeholder="Birthday" required name="edit_birthday" value="<?php echo $user["birthday"]; ?>"></label>
                            <label class="w-100"><input type="text" class="form-control" placeholder="Username" readonly disabled value="<?php echo $user["username"]; ?>"></label>
                            <label class="w-100"><input type="email" class="form-control" placeholder="Mail" readonly disabled value="<?php echo $user["mail"]; ?>"></label>
                            <label class="w-100"><textarea class="form-control" placeholder="Information (Nullable)" name="edit_information"><?php echo $user["information"]; ?></textarea></label>
                            <button class="btn btn-lg btn-primary btn-block" type="submit" name="edit_user">Update Account</button>
                        </form>
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
