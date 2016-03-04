<?php

/**
 * @file
 * Class to implement e107 cron handler.
 */

if(!defined('e107_INIT'))
{
	exit;
}


/**
 * Class backup_dropbox_cron.
 */
class backup_dropbox_cron
{

	function config()
	{
		$cron = array();

		$cron[] = array(
			'name'        => LAN_PLUGIN_BACKUP_DROPBOX_CRON_01,
			'function'    => 'backup_dropbox_cron_callback',
			'category'    => 'user',
			'description' => LAN_PLUGIN_BACKUP_DROPBOX_CRON_02,
		);

		return $cron;
	}

	/**
	 * Try to make backup files and export them to DropBox.
	 */
	public function backup_dropbox_cron_callback()
	{
		e107_require_once(e_PLUGIN . 'backup_dropbox/includes/backup_dropbox.php');

		$bd = new backup_dropbox();
		$bd->doBackup();
	}

}
