<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/OAuth2.php');
    $oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');

    if (!isset($_SESSION['discord']) && empty($_SESSION['discord'])) { // Did the client already logged in ?
        return $oauth->startRedirection($website["discord_scopes"]);
    }
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/events/checkGuild.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/events/createSessions.php');
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
    <link rel="icon" href="https://i2.wp.com/arendelleodyssey.com/wp-content/uploads/2020/11/favicon.png?fit=500%2C500&ssl=1">
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php') ?>

    <div class="content">
        <div class="page-header">
            <h1 class="ao-title">Welcome <?php echo $_SESSION['discord']['user']['username'] ?> to your page!</h1>      
        </div>

        <p>
            This page is intended to manage your tools, depending on your task. To start, select a module on your left menu
        </p>

        <img src="https://api.arendelleodyssey.com/guild/banner" alt="Server banner" style ="width: 100%; max-width: 1200px; height: auto;" />
    </div>
</body>
</html>