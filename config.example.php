<?php
// global website variables.
$website['api_token'] = 'API Token';
$website['discord_client'] = 'Discord client ID';
$website['discord_secret'] = 'Discord client secret';
$website['discord_scopes'] = [
    'identify',
    'connections',
    'email',
    'guilds'
];
$website['name']           = 'Arendelle Odyssey Member page';
$website['url']            = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' && $_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . str_replace('\\', '', preg_replace('/\/$/', '', dirname($_SERVER['PHP_SELF']))) . '/');
$website['url_with_params']= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' && $_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$website['discord_guild_id']= "729083124226719816"; // AO Server ID
$website['api_url'] = "https://api.arendelleodyssey.com/";

// start a session.
session_start();
?>