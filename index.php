<?php require_once('config.php');
    require_once('includes/OAuth2.php');
    $oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');

    if (!isset($_SESSION['discord']) && empty($_SESSION['discord'])) { // Did the client already logged in ?
        $oauth->startRedirection($website["discord_scopes"]);
    } else {
        require_once('./includes/events/checkGuild.php');

        // ---------- USER INFORMATION
        $user = $oauth->getUserInformation(); // Same as $oauth2->getCustomInformation('users/@me')
        if (array_key_exists("code", $user)) {
            exit("An error occured: " . $user["message"]);
        }
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website['name'] ?></title>
    <link rel="stylesheet" href="/includes/bootstrap.min.css">
    <script src="/includes/jquery.min.js"></script>
    <script src="/includes/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once('page_inc/header.php') ?>
    <?php 
        // ---------- CONNECTIONS INFORMATION
        $answer = $oauth->getConnectionsInformation();
        if (array_key_exists("code", $answer)) {
            exit("An error occured: " . $answer["message"]);
        } else {
            foreach ($answer as $a) {
                echo $a["type"] . ': ' . $a["name"] . '<br/>';
            }
        }
    ?>
</body>
</html>


<?php } ?>