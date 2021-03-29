<?php require_once('./config.php');
    require_once('./includes/OAuth2.php');
    $oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');

    if (!isset($_SESSION['discord']) && empty($_SESSION['discord'])) { // Did the client already logged in ?
        $oauth->startRedirection($website["discord_scopes"]);
    } else {
        require_once('./includes/events/checkGuild.php');
        require_once('./includes/events/createSessions.php')
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website['name'] ?></title>
    <link rel="stylesheet" href="/includes/style.css">
    <link rel="stylesheet" href="/includes/bootstrap.min.css">
    <script src="/includes/jquery.min.js"></script>
    <script src="/includes/bootstrap.min.js"></script>
</head>
<body>
    <?php // require_once('page_inc/header.php') ?>
    <?php require_once('page_inc/sidebar.php') ?>

    <div class="content">
        <div class="page-header">
            <h1 class="ao-title">Welcome <?php echo $_SESSION['discord']['user']['username'] ?> to your page!</h1>      
        </div>
        <p>
            This page is intended to manage your tools, depending on your task, to start, select a module on your left menu
        </p>
    </div>
</body>
</html>


<?php } ?>