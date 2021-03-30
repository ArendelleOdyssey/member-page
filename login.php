<?php require_once('config.php');
require_once('includes/OAuth2.php');
$oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');

$ok = $oauth->loadToken();
if ($ok !== true) {
    // A common error can be to reload the page because the code returned by Discord would still be present in the URL
    // If this happen, isRedirected will return true and we will come here with an invalid code
    // So if there is a problem, we redirect the user to Discord authentification
    $oauth->startRedirection($website["discord_scopes"]);
} else {
    if (isset($_GET['state'])){
        require_once('./includes/events/checkGuild.php');
        $_SESSION['discord']['state'] = $_GET['state'];
        header('Location: .');
    } else {
        $oauth->startRedirection($website["discord_scopes"]);
    }
}
?>