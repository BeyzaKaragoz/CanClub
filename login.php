<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CanClub | Sign In</title>

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
    <h1 class="h3 mb-3 font-weight-normal">Sign In</h1>
    <hr>
    <label><input type="text" class="form-control mt-2" placeholder="Username" required name="login_username" autofocus></label>
    <label><input type="password" class="form-control" placeholder="Password" required name="login_password"></label>
    <hr>
    <button class="btn btn-lg btn-primary btn-block mt-4" type="submit" name="login">Sign in</button>
    <a class="btn btn-lg btn-danger btn-block text-white" href="register.php">Register</a>
</form>
</body>
</html>
