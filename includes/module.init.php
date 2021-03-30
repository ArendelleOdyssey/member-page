<?php require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/includes/OAuth2.php');
    $oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');

    if (!isset($_SESSION['discord']) && empty($_SESSION['discord'])) { // Did the client already logged in ?
        return $oauth->startRedirection($website["discord_scopes"]);
    }
    $access = false;
    foreach ($_SESSION['discord']['user']['roles'] as $key => $value) {
        $roleIDdir = str_replace('/'.basename($_SERVER["SCRIPT_FILENAME"]), '', str_replace("/modules/", '', $_SERVER['SCRIPT_NAME']));
        if ($roleIDdir == $value['id'] || $roleIDdir == "/errors"){$access = true;};
    }
    if (!$access) { // Did the client has access to this module (based on role) ?
        var_dump(http_response_code(403));
        header('Location: /');
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
    <title><?php echo $title.' - '.$website['name'] ?></title>
    <link rel="stylesheet" href="/includes/style.css">
    <link rel="stylesheet" href="/includes/bootstrap.min.css">
    <script src="/includes/jquery.min.js"></script>
    <script src="/includes/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/sidebar.php') ?>

    <div class="content">
        <div class="page-header">
            <h1 class="ao-title"><?php echo $title ?></h1>      
        </div>