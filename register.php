<?php
session_start();
require_once("helpers.php");

$db = db_connect();
$departments = $db->query("SELECT * FROM departments");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CanClub | Register</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .form-signin {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin label {
            width: 100%;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body class="text-center">
<form class="form-signin" action="process.php" method="POST">
    <h1 class="h3 mb-3 font-weight-normal">Register</h1>
    <hr>
    <label>
        <select class="form-control" name="register_department">
            <?php foreach ($departments as $department) { ?>
                <option value="<?php echo $department["id"]; ?>"><?php echo $department["name"]; ?></option>
            <?php } ?>
        </select>
    </label>
    <label><input type="text" class="form-control" placeholder="Name" required name="register_name" autofocus></label>
    <label><input type="text" class="form-control" placeholder="Surname" required name="register_surname"></label>
    <label><input type="date" class="form-control" placeholder="Birthday" required name="register_birthday" ></label>
    <label><input type="text" class="form-control" placeholder="Username" required name="register_username"></label>
    <label><input type="email" class="form-control" placeholder="Mail" required name="register_mail"></label>
    <label><input type="password" class="form-control" placeholder="Password" required name="register_password"></label>
    <label><textarea class="form-control" placeholder="Information (Nullable)" name="register_information"></textarea></label>
    <hr>
    <button class="btn btn-lg btn-primary btn-block mt-4" type="submit" name="register">Register</button>
    <a class="btn btn-lg btn-danger btn-block text-white" href="login.php">Sign In</a>
</form>
</body>
</html>
