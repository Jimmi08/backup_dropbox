<?php

/**
 * @file
 * Language file for "backup_dropbox" plugin.
 */

define("LAN_BACKUP_DROPBOX_ADMIN_01", "Settings");
define("LAN_BACKUP_DROPBOX_ADMIN_02", "Scheme");
define("LAN_BACKUP_DROPBOX_ADMIN_03", "Host");
define("LAN_BACKUP_DROPBOX_ADMIN_04", "Path");
define("LAN_BACKUP_DROPBOX_ADMIN_05", "A relative folder inside your Dropbox App folder. For example, Dropbox/Apps/(your app name)/(whatever path you enter here).");
define("LAN_BACKUP_DROPBOX_ADMIN_06", "Dropbox App Key");
define("LAN_BACKUP_DROPBOX_ADMIN_07", "Enter the App key from Dropbox.com");
define("LAN_BACKUP_DROPBOX_ADMIN_08", "Dropbox App Secret");
define("LAN_BACKUP_DROPBOX_ADMIN_09", "Enter the App secret from Dropbox.com");
define("LAN_BACKUP_DROPBOX_ADMIN_10", "32-byte encryption key");
define("LAN_BACKUP_DROPBOX_ADMIN_11", "Enter a 32-byte (character) encryption key. TODO: figure out a better way to handle this.");
define("LAN_BACKUP_DROPBOX_ADMIN_12", "Generate");

define("LAN_BACKUP_DROPBOX_ADMIN_HELP_01", "Help");
define("LAN_BACKUP_DROPBOX_ADMIN_HELP_02", "In order to use your DropBox account as a Backup destination, you must create a [b]DropBox App[/b] and obtain your app credentials and enter them on this form.");
define("LAN_BACKUP_DROPBOX_ADMIN_HELP_03", "[b]Step 1:[/b] Create a DropBox App by logging into your DropBox account and going to [url=https://www.dropbox.com/developers/apps]here[/url] and clicking the button to [b]Create an app[/b]. Be sure to give your app a descriptive name, as the name you give it will be part of the path within your DropBox folder. For example, if you create an app called [b]kittens[/b], then DropBox will create a [b]DropBox/Apps/kittens[/b] directory in your DropBox folder.");
define("LAN_BACKUP_DROPBOX_ADMIN_HELP_04", "[b]Step 2:[/b] Once the app is created, take note of your app's [b]App key[/b] and [b]App secret[/b] and enter both of them below.");
define("LAN_BACKUP_DROPBOX_ADMIN_HELP_05", "[b]Step 3:[/b] You may also enter a [b]path[/b] that will be used inside your app's folder. For example, if you enter [b]fluffy/white[b] as your path, then backups will be placed in the [b]DropBox/Apps/kittens/fluffy/white/[/b] directory.");
define("LAN_BACKUP_DROPBOX_ADMIN_HELP_06", "[b]Step 4:[/b] Enter a 32-charater encryption key. We're not 100% sure if this is the best way to handle this, but for now, it works.");
define("LAN_BACKUP_DROPBOX_ADMIN_HELP_07", "[b]Step 5:[/b] Go to [b]Account Info[/b] to connect your DropBox account.");

define("LAN_BACKUP_DROPBOX_ADMIN_13", "Account Info");
define("LAN_BACKUP_DROPBOX_ADMIN_14", "Token is invalid, please generate a new encryption key, and try to re-authenticate.");
define("LAN_BACKUP_DROPBOX_ADMIN_15", "Display Name");
define("LAN_BACKUP_DROPBOX_ADMIN_16", "E-mail");
define("LAN_BACKUP_DROPBOX_ADMIN_17", "Team");
define("LAN_BACKUP_DROPBOX_ADMIN_18", "Country");
