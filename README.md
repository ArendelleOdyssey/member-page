# [Arendelle Odyssey Member Page](https://member.arendelleodyssey.com)
 The member page of Arendelle Odyssey.
 
[![Website](https://img.shields.io/website?down_color=red&down_message=Offline&style=for-the-badge&up_color=green&up_message=Online&url=https%3A%2F%2Fmember.arendelleodyssey.com)](https://member.arendelleodyssey.com)
 
![PHP Version](https://img.shields.io/badge/8.0.1-black?style=flat-square&logo=php&logoColor=white)
 
---

## Contributing
### Adding a new plugin

1. Fork this repo
2. Select the folder in `modules/` where the plugin will be placed, the folder name is the role ID, on the [Arendelle Odyssey Discord server](https://discord.gg/arendelleodyssey). If the folder don't exist, create it!
3. Copy the `modules/module.example.php` to your directory, then rename it to something clear (one or two words), the file name is the plugin name in the slidebar.
4. Set the `$title` to the plugin title, it will be on the header and on the page title
5. Do your modifications in php between the two includes.
6. After you've done, create a [Pull Request](https://github.com/ArendelleOdyssey/member-page/pulls)

## Running it

1. Set a virtual host only for this (a new virtual host for this is required than adding in a existant website, else many errors will display)
2. Copy your `config.example.php` to `config.php` and do your modifications on it
3. DISCLAIMER! Do not change the Guild ID, because some checkings (mainly roles) requires an API with a Discord bot. Sorry for others servers. (But it was easy to create an API with a Discord bot, check here: https://github.com/ArendelleOdyssey/discord-bot/tree/main/src/api
4. Run your server and access to it

![AO Banner](https://api.arendelleodyssey.com/guild/banner)
