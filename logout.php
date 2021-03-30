<?php require_once('config.php');
session_unset();
require_once('includes/OAuth2.php');
$oauth = new OAuth2($website["discord_client"], $website["discord_secret"], $website['url'] . 'login.php');
$oauth->startRedirection($website["discord_scopes"]);
?>