<?php
if (!isset($_SESSION['discord']['user']) || empty($_SESSION['discord']['user'])){
    // ---------- USER INFORMATION
    $user = $oauth->getUserInformation(); // Same as $oauth2->getCustomInformation('users/@me')
    if (array_key_exists("code", $user)) {
        exit("An error occured: " . $user["message"]);
    }
    $_SESSION['discord']['user'] = $user;
    $_SESSION['discord']['user']['tag'] = $user["username"] . "#" . $user["discriminator"];
    $_SESSION['discord']['user']['avatarURL'] = "https://cdn.discordapp.com/avatars/".$_SESSION['discord']['user']['id']."/".$_SESSION['discord']['user']['avatar']."?size=1024&animated=true";

    $curl = curl_init('https://api.arendelleodyssey.com/users/' . $_SESSION['discord']['user']['id']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, "false");
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Token ' . $website['api_token']
    ));
    $_SESSION['discord']['user']['api'] = json_decode(curl_exec($curl), true);

    $curl = curl_init('https://api.arendelleodyssey.com/users/' . $_SESSION['discord']['user']['id'].'/roles');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, "false");
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Token ' . $website['api_token']
    ));
    $_SESSION['discord']['user']['roles'] = json_decode(curl_exec($curl), true);
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
    $_SESSION['discord']['guild']['iconURL'] = "https://cdn.discordapp.com/icons/".$_SESSION['discord']['guild']['id']."/".$_SESSION['discord']['guild']['icon']."?size=1024&animated=true";

    $curl = curl_init('https://api.arendelleodyssey.com/guild');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, "false");
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Token ' . $website['api_token']
    ));
    $_SESSION['discord']['guild']['api'] = json_decode(curl_exec($curl), true);
}
?>