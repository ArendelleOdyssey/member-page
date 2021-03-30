<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/OAuth2.php');
    $oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');

    if (!isset($_SESSION['discord']) && empty($_SESSION['discord'])) { // Did the client already logged in ?
        return $oauth->startRedirection($website["discord_scopes"]);
    }
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/events/checkGuild.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/events/createSessions.php');

    if (!isset($title) || empty($title)){$title = "No title";}
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
    <link rel="icon" href="<?php echo $_SESSION['discord']['guild']['iconURL']; ?>">
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php') ?>

    <div class="content">
        <div class="page-header">
            <h1 class="ao-title">Welcome <?php echo $_SESSION['discord']['user']['username'] ?> to your page!</h1>      
        </div>