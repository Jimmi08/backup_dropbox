Backup to Dropbox (e107 v2 plugin)
==================================
This plugin creates a database dump and a zipped backup of all non-core plugins, your site theme, your media files and system logs, and finally, export backups to Dropbox.

> This plugin is under development! Use it at your own risk!

### Requirements
- e107 CMS v2
- BenExile's Dropbox REST API library
- Dropbox account

### How to install?
- Download **BenExile's Dropbox REST API library** from [here](https://github.com/BenExile/Dropbox/archive/master.zip)
- Unzip the downloaded file, and copy "Dropbox" folder into **"e107_web/lib/dropbox/"** folder
- Install **Backup to Dropbox (backup_dropbox)** plugin
- Follow the **Further instructions** or the instructions on **e107_plugins/backup_dropbox/admin_config.php** page

### Further instructions

In order to use your Dropbox account as a Backup destination, you must create a Dropbox App and obtain your app credentials.

- Create a Dropbox App by logging into your Dropbox account and going to [here](https://www.dropbox.com/developers/apps) and clicking the button to **Create an app**. Be sure to give your app a descriptive name, as the name you give it will be part of the path within your Dropbox folder. For example, if you create an app called **kittens**, then Dropbox will create a **Dropbox/Apps/kittens** directory in your Dropbox folder.
- Once the app is created, take note of your app's App key and App secret and enter both of them below.
- You may also enter a path that will be used inside your app's folder. For example, if you enter **fluffy/white** as your path, then backups will be placed in the **Dropbox/Apps/kittens/fluffy/white/** directory.
- Enter a 32-charater encryption key. Just click on the **Generate** button.
- Go to **Account Info** to connect your Dropbox account.
- Enable **Backup to Dropbox** task on the **Schedule Tasks** page.

### Questions about this project?

Please feel free to report any bug found. Pull requests, issues, and plugin recommendations are more than welcome!

### Donate with [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQYDBAMQ3D2UG)

If you think this plugin is useful and saves you a lot of work, a lot of costs (PHP developers are expensive) and let you sleep much better, then donating a small amount would be very cool.

[![Paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PQYDBAMQ3D2UG)
