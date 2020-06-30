<?php
session_start();
require_once("helpers.php");
login_control();

$db = db_connect();
$activities = $db->query("SELECT * FROM activities ORDER BY id DESC")->fetchAll();
$top_activities = $db->query("SELECT COUNT(*) AS count, activity_id FROM proposals WHERE type = '1' GROUP BY activity_id ORDER BY count DESC LIMIT 5")->fetchAll();
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

<div class="container-fluid">
    <div class="row">

        <?php require_once ("navbar.php"); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Home Page</h1>
            </div>

            <div class="container col-12 row">
                <div class="col-6">
                    <div class="text-center">
                        <?php foreach ($activities as $activity) { ?>
                            <?php
                            $type = $db->query("SELECT * FROM activity_types WHERE id = '{$activity["type_id"]}'")->fetch();
                            $user = $db->query("SELECT * FROM users WHERE id = '{$activity["user_id"]}'")->fetch();
                            $pre_proposal = $db->query("SELECT * FROM proposals WHERE user_id = '{$_SESSION["login_user"]["id"]}' AND activity_id = '{$activity["id"]}'")->fetch();
                            $like = $db->query("SELECT COUNT(*) AS count FROM proposals WHERE activity_id = '{$activity["id"]}' AND type = '1'")->fetch();
                            $dislike = $db->query("SELECT COUNT(*) AS count FROM proposals WHERE activity_id = '{$activity["id"]}' AND type = '0'")->fetch();
                            $comments = $db->query("SELECT * FROM comments WHERE activity_id = '{$activity["id"]}' ORDER BY id DESC")->fetchAll();
                            ?>
                            <div class="w-100">
                                <div class="card text-center">
                                    <div class="card-header bg-dark text-white font-weight-bold <?php echo (date_day_diff($activity["publish_date"]) >= 15) ? "bg-danger text-white" : "" ?>">
                                        <?php echo $activity["title"]; ?> - <?php echo $type["name"]; ?>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-title"><?php echo $activity["information"]; ?></p>
                                        <?php if (empty($pre_proposal) && (date_day_diff($activity["publish_date"]) < 15)) { ?>
                                            <a type="button" class="btn btn-success text-white" style="border-radius: 50px"
                                               href="process.php?process=proposal&activity=<?php echo $activity["id"]; ?>&choose=1">
                                                <img alt="like" src="attend/like.png" style="height: 50px">
                                            </a>
                                            <a type="button" class="btn btn-danger text-white"
                                               style="border-radius: 50px" href="process.php?process=proposal&activity=<?php echo $activity["id"]; ?>&choose=0">
                                                <img alt="like" src="attend/dislike.png" style="height: 50px">
                                            </a>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-success text-white" style="border-radius: 50px" disabled>
                                                <img alt="like" src="attend/like.png" style="height: 50px"> <span class="badge badge-pill badge-light mt-3" style="font-size: 1em"><?php echo $like["count"]; ?></span>
                                            </button>
                                            <button type="button" class="btn btn-danger text-white" style="border-radius: 50px" disabled>
                                                <img alt="like" src="attend/dislike.png" style="height: 50px"> <span class="badge badge-pill badge-light mt-3" style="font-size: 1em"><?php echo $dislike["count"]; ?></span>
                                            </button>
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <div class="clearfix">
                                            <span class="float-left">Publish Date: <?php echo $activity["publish_date"]; ?> by "<?php echo $user["username"]; ?>"</span>
                                            <a href="process.php?process=deleteactivity&activity=<?php echo $activity["id"]; ?>" class="float-right text-decoration-none">
                                                <?php if ($_SESSION["login_user"]["type"] == "0") { ?>
                                                    <span class="text-danger">Delete</span>
                                                <?php } ?>
                                            </a>
                                        </div>
                                        <hr>
                                        <ul class="list-group text-left">
                                            <?php if (date_day_diff($activity["publish_date"]) < 15) { ?>
                                                <li class="list-group-item">
                                                    <form action="process.php" method="post">
                                                        <div class="form-group d-none">
                                                            <label class="w-100"><input type="text" class="form-control" name="activity_id" value="<?php echo $activity["id"]; ?>" required></label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="w-100 m-0"><textarea class="form-control" name="user_comment" placeholder="Enter your Comment..."></textarea></label>
                                                        </div>
                                                        <label class="w-100 m-0"><input type="submit" name="comment" value="Comment It" class="btn btn-primary btn-block"></label>
                                                    </form>
                                                </li>
                                            <?php } ?>
                                            <?php foreach ($comments as $comment) { ?>
                                                <?php $comment_user = $db->query("SELECT * FROM users WHERE id = '{$comment["user_id"]}'")->fetch(); ?>
                                                <li class="list-group-item">
                                                    <p class="m-0 font-weight-bold">
                                                        <img class="mb-1 mr-1 rounded-circle" src="attend/user/<?php echo $comment_user["picture"]; ?>" width="50" alt="User Picture">
                                                        <?php echo $comment_user["name"]." ".$comment_user["surname"]." - ".$comment_user["username"]; ?>
                                                        <span class="float-right text-muted font-weight-normal"><?php echo $comment["publish_date"]?></span>
                                                    </p>
                                                    <p class="m-0"><i class="fas fa-comment"></i> <?php echo $comment["comment"]; ?></p>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <br>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-6">
                    <?php foreach ($top_activities as $var) { ?>
                        <?php
                        $activity = $db->query("SELECT * FROM activities WHERE id = '{$var["activity_id"]}'")->fetch();
                        $type = $db->query("SELECT * FROM activity_types WHERE id = '{$activity["type_id"]}'")->fetch();
                        $user = $db->query("SELECT * FROM users WHERE id = '{$activity["user_id"]}'")->fetch();
                        $pre_proposal = $db->query("SELECT * FROM proposals WHERE user_id = '{$_SESSION["login_user"]["id"]}' AND activity_id = '{$activity["id"]}'")->fetch();
                        $like = $db->query("SELECT COUNT(*) AS count FROM proposals WHERE activity_id = '{$activity["id"]}' AND type = '1'")->fetch();
                        $dislike = $db->query("SELECT COUNT(*) AS count FROM proposals WHERE activity_id = '{$activity["id"]}' AND type = '0'")->fetch();
                        ?>
                        <div class="w-100">
                            <div class="card text-center">
                                <div class="card-header bg-warning font-weight-bold <?php echo (date_day_diff($activity["publish_date"]) >= 15) ? "bg-danger text-white" : "" ?>">
                                    <?php echo $activity["title"]; ?> - <?php echo $type["name"]; ?>
                                </div>
                                <div class="card-body">
                                    <p class="card-title"><?php echo $activity["information"]; ?></p>
                                    <?php if (empty($pre_proposal) && (date_day_diff($activity["publish_date"]) < 15)) { ?>
                                        <a type="button" class="btn btn-success text-white" style="border-radius: 50px"
                                           href="process.php?process=proposal&activity=<?php echo $activity["id"]; ?>&choose=1">
                                            <img alt="like" src="attend/like.png" style="height: 50px">
                                        </a>
                                        <a type="button" class="btn btn-danger text-white"
                                           style="border-radius: 50px" href="process.php?process=proposal&activity=<?php echo $activity["id"]; ?>&choose=0">
                                            <img alt="like" src="attend/dislike.png" style="height: 50px">
                                        </a>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-success text-white" style="border-radius: 50px" disabled>
                                            <img alt="like" src="attend/like.png" style="height: 50px"> <span class="badge badge-pill badge-light mt-3" style="font-size: 1em"><?php echo $like["count"]; ?></span>
                                        </button>
                                        <button type="button" class="btn btn-danger text-white" style="border-radius: 50px" disabled>
                                            <img alt="like" src="attend/dislike.png" style="height: 50px"> <span class="badge badge-pill badge-light mt-3" style="font-size: 1em"><?php echo $dislike["count"]; ?></span>
                                        </button>
                                    <?php } ?>
                                </div>
                                <div class="card-footer text-muted">
                                    <div class="clearfix">
                                        <span class="float-left">Publish Date: <?php echo $activity["publish_date"]; ?> by "<?php echo $user["username"]; ?>"</span>
                                        <a href="process.php?process=deleteactivity&activity=<?php echo $activity["id"]; ?>" class="float-right text-decoration-none">
                                            <?php if ($_SESSION["login_user"]["type"] == "0") { ?>
                                                <span class="text-danger">Delete</span>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    <?php } ?>
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
