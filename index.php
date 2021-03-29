<?php require_once('config.php');
    require_once('includes/OAuth2.php');
    $oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');

    if (!isset($_SESSION['discord']) && empty($_SESSION['discord'])) { // Did the client already logged in ?
        $oauth->startRedirection($website["discord_scopes"]);
    } else {
        require_once('./includes/events/checkGuild.php');

        if (!isset($_SESSION['discord']['user']) || empty($_SESSION['discord']['user'])){
            // ---------- USER INFORMATION
            $user = $oauth->getUserInformation(); // Same as $oauth2->getCustomInformation('users/@me')
            if (array_key_exists("code", $user)) {
                exit("An error occured: " . $user["message"]);
            }
            $_SESSION['discord']['user'] = $user;
            $_SESSION['discord']['user']['tag'] = $user["username"] . "#" . $user["discriminator"];
        }
        if (!isset($_SESSION['discord']['connections']) || empty($_SESSION['discord']['connections'])){
            // ---------- CONNECTIONS INFORMATION
            $connections = $oauth->getConnectionsInformation();
            if (array_key_exists("code", $connections)) {
                exit("An error occured: " . $connections["message"]);
            }
            $_SESSION['discord']['connections'] = $connections;
        }
        if (!isset($_SESSION['discord']['guild']) || empty($_SESSION['discord']['guild'])){
            // ---------- GUILD INFORMATION
            $guilds = $oauth->getGuildsInformation();
            foreach ($guilds as $key => $value) {
                if ($guilds[$key]['id'] == $website['discord_guild_id']){
                    $_SESSION['discord']['guild'] = $guilds[$key];
                    break;
                }
            }
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
    <?php // require_once('page_inc/header.php') ?>
    <?php require_once('page_inc/sidebar.php') ?>

    <div class="content">
    <?php 
        // foreach ($_SESSION['discord']['connections'] as $a) {
        //     echo $a["type"] . ': ' . $a["name"] . '<br/>';
        // }
        echo json_encode($_SESSION['discord']['guild'])
    ?>
    </div>
</body>
</html>


<?php } ?>