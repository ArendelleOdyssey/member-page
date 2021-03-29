<?php 
$guilds = $oauth->getGuildsInformation();
$inGuild = false;
foreach ($guilds as $key => $value) {
    if ($guilds[$key]['id'] == $website['discord_guild_id']){
        $inGuild = true;
        break;
    }
}

if (!$inGuild){
    echo "Sorry, <strong>you're not in Arendelle Odyssey Discord server</strong>. <a href='https://discord.gg/arendelleodyssey'>Please join us here</a>.<br /><br /><a href='/logout.php'>Logout</a>";
    exit;
}
?>