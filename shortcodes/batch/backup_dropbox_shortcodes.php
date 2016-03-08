<?php

/**
 * @file
 * Shortcodes for "backup_dropbox" plugin.
 */

if(!defined('e107_INIT'))
{
	exit;
}

// [PLUGINS]/backup_dropbox/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('backup_dropbox', true, true);


/**
 * Class backup_dropbox_shortcodes.
 */
class backup_dropbox_shortcodes extends e_shortcode
{

	/**
	 * Store forum plugin preferences.
	 *
	 * @var array
	 */
	private $plugPrefs = array();

	/**
	 * Constructor.
	 */
	function __construct()
	{
		parent::__construct();
		// Get plugin preferences.
		$this->plugPrefs = e107::getPlugConfig('backup_dropbox')->getPref();
	}

	/**
	 * Label for "Display Name" item.
	 *
	 * @return mixed
	 */
	function sc_name_label()
	{
		return $this->var['name_label'];
	}

	/**
	 * Label for "E-mail" item.
	 *
	 * @return mixed
	 */
	function sc_email_label()
	{
		return $this->var['email_label'];
	}

	/**
	 * Label for "Team" item.
	 *
	 * @return mixed
	 */
	function sc_team_label()
	{
		return $this->var['team_label'];
	}

	/**
	 * Label for "Country" item.
	 *
	 * @return mixed
	 */
	function sc_country_label()
	{
		return $this->var['country_label'];
	}

	/**
	 * Value for "Display Name" item.
	 *
	 * @return mixed
	 */
	function sc_name_value()
	{
		return $this->var['name_value'];
	}

	/**
	 * Value for "E-mail" item.
	 *
	 * @return mixed
	 */
	function sc_email_value()
	{
		return $this->var['email_value'];
	}

	/**
	 * Value for "Team" item.
	 *
	 * @return mixed
	 */
	function sc_team_value()
	{
		return $this->var['team_value'];
	}

	/**
	 * Value for "Country" item.
	 *
	 * @return mixed
	 */
	function sc_country_value()
	{
		return $this->var['country_value'];
	}

}
