<?php

session_start();
require_once("helpers.php");
$db = db_connect();

if (isset($_POST["login"])){
    $query = $db->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $query->execute(array(
        $_POST["login_username"],
        SHA1($_POST["login_password"])
    ));
    $select = $query->fetch();
    if ($select){
        $_SESSION["login_user"] = $select;
        header("Location: index.php");
    } else {
        header("Location: login.php");
    }
}

if (isset($_POST["register"])){
    $query = $db->prepare("INSERT INTO users SET department_id = ?, name = ?, surname = ?, username = ?, password = ?, birthday = ?, mail = ?, information = ?");
    $insert = $query->execute(array(
        $_POST["register_department"],
        $_POST["register_name"],
        $_POST["register_surname"],
        $_POST["register_username"],
        SHA1($_POST["register_password"]),
        $_POST["register_birthday"],
        $_POST["register_mail"],
        (!empty($_POST["register_information"]) ? $_POST["register_information"] : null)
    ));
    if ($insert){
        header("Location: login.php");
    }
}

if (isset($_POST["edit_user"])){
    $query = $db->prepare("UPDATE users SET name = ?, surname = ?, birthday = ?, information = ? WHERE id = '{$_SESSION["login_user"]["id"]}'");
    $update = $query->execute(array(
        $_POST["edit_name"],
        $_POST["edit_surname"],
        $_POST["edit_birthday"],
        (!empty($_POST["edit_information"]) ? $_POST["edit_information"] : null)
    ));
    if ($update){
        $user = $db->query("SELECT * FROM users WHERE id = '{$_SESSION["login_user"]["id"]}'")->fetch();
        $_SESSION["login_user"] = $user;
        header("Location: user_edit.php");
    }
}

if (isset($_POST["edit_picture"])){
    $fileTmpPath = $_FILES['user_picture']['tmp_name'];
    $fileName = $_FILES['user_picture']['name'];
    $fileExtension = strtolower(end(explode(".", $fileName)));
    $newFileName = md5($_SESSION["login_user"]["username"]) . '.' . $fileExtension;
    $allowedFileExtensions = array('jpg', 'jpeg', 'png');
    if (in_array($fileExtension, $allowedFileExtensions)) {
        $uploadPath = 'attend/user/';
        $newPath = $uploadPath . $newFileName;
        if (move_uploaded_file($fileTmpPath, $newPath)) {
            $query = $db->prepare("UPDATE users SET picture = ? WHERE id = '{$_SESSION["login_user"]["id"]}'");
            $update = $query->execute(array(
                $newFileName
            ));
            if ($update) {
                $user = $db->query("SELECT * FROM users WHERE id = '{$_SESSION["login_user"]["id"]}'")->fetch();
                $_SESSION["login_user"] = $user;
            }
        }
    } header("Location: user_edit.php");
}

if (isset($_POST["comment"])){
    $query = $db->prepare("INSERT INTO comments SET user_id = ?, activity_id = ?, comment = ?");
    $insert = $query->execute(array(
        $_SESSION["login_user"]["id"],
        $_POST["activity_id"],
        $_POST["user_comment"]
    ));
    if ($insert){
        header("Location: index.php");
    }
}

if (isset($_POST["add_activity"])){
    $query = $db->prepare("INSERT INTO activities SET user_id = ?, type_id = ?, title = ?, information = ?");
    $insert = $query->execute(array(
        $_SESSION["login_user"]["id"],
        $_POST["activity_type"],
        $_POST["activity_title"],
        $_POST["activity_information"]
    ));
    if ($insert){
        header("Location: index.php");
    }
}

if (isset($_POST["add_type"])){
    $query = $db->prepare("INSERT INTO activity_types SET name = ?");
    $insert = $query->execute(array(
        $_POST["type_name"]
    ));
    if ($insert){
        header("Location: types.php");
    }
}

if (isset($_POST["add_department"])){
    $query = $db->prepare("INSERT INTO departments SET name = ?");
    $insert = $query->execute(array(
        $_POST["department_name"]
    ));
    if ($insert){
        header("Location: departments.php");
    }
}

if (isset($_GET["process"])) {
    if ($_GET["process"] == "logout") {
        unset($_SESSION["login_user"]);
        header("Location: login.php");
    }

    if ($_GET["process"] == "proposal") {
        $query = $db->prepare("INSERT INTO proposals SET user_id = ?, activity_id = ?, type = ?");
        $insert = $query->execute(array(
            $_SESSION["login_user"]["id"],
            $_GET["activity"],
            $_GET["choose"]
        ));
        if ($insert){
            header("Location: index.php");
        }
    }

    if ($_GET["process"] == "deleteactivity"){
        $query = $db->prepare("DELETE FROM activities WHERE id = ?");
        $delete = $query->execute(array(
            $_GET["activity"]
        ));
        if ($delete){
            header("Location: index.php");
        }
    }

    if ($_GET["process"] == "deletetype"){
        $query = $db->prepare("DELETE FROM activity_types WHERE id = ?");
        $delete = $query->execute(array(
            $_GET["type"]
        ));
        if ($delete){
            header("Location: add_type.php");
        }
    }

    if ($_GET["process"] == "deletedepartment"){
        $query = $db->prepare("DELETE FROM departments WHERE id = ?");
        $delete = $query->execute(array(
            $_GET["department"]
        ));
        if ($delete){
            header("Location: add_department.php");
        }
    }

    if ($_GET["process"] == "deleteuser"){
        $query = $db->prepare("DELETE FROM users WHERE id = ?");
        $delete = $query->execute(array(
            $_GET["user"]
        ));
        if ($delete){
            header("Location: users.php");
        }
    }
}
?>