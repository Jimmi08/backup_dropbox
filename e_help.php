<?php

/**
 * @file
 * Helper file for Admin UI.
 */

if(!defined('e107_INIT'))
{
	exit;
}

$action = vartrue($_GET['action']);

switch($action)
{
	case 'prefs':
	default :
	{
		$text = LAN_BACKUP_DROPBOX_ADMIN_HELP_02 . '<br/><br/>';
		$text .= LAN_BACKUP_DROPBOX_ADMIN_HELP_03 . '<br/><br/>';
		$text .= LAN_BACKUP_DROPBOX_ADMIN_HELP_04 . '<br/><br/>';
		$text .= LAN_BACKUP_DROPBOX_ADMIN_HELP_05 . '<br/><br/>';
		$text .= LAN_BACKUP_DROPBOX_ADMIN_HELP_06 . '<br/><br/>';
		$text .= LAN_BACKUP_DROPBOX_ADMIN_HELP_07 . '<br/><br/>';
		$text .= LAN_BACKUP_DROPBOX_ADMIN_HELP_08;
	}
}

if($text)
{
	$parsed = e107::getParser()->toHTML($text, true);
	e107::getRender()->tablerender(LAN_BACKUP_DROPBOX_ADMIN_HELP_01, $parsed);
	unset($text, $parsed);
}
