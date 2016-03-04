<?php

/**
 * @file
 * Custom install/uninstall/update routines.
 */

if(!defined('e107_INIT'))
{
	exit;
}


/**
 * Class backup_dropbox_setup.
 */
class backup_dropbox_setup
{

	/**
	 * This function is called before plugin table has been created by the
	 * backup_dropbox_sql.php file.
	 *
	 * @param array $var
	 */
	function install_pre($var)
	{
	}


	/**
	 * This function is called after plugin table has been created by the
	 * backup_dropbox_sql.php file.
	 *
	 * @param array $var
	 */
	function install_post($var)
	{
	}


	function uninstall_options()
	{
	}


	function uninstall_post($var)
	{
	}


	/**
	 * Trigger an upgrade alert or not.
	 *
	 * @param array $var
	 *
	 * @return bool
	 *  True to trigger an upgrade alert, and false to not.
	 */
	function upgrade_required($var)
	{
		$this->chack_requirements();

		return false;
	}


	function upgrade_pre($var)
	{
	}


	function upgrade_post($var)
	{
	}

	/**
	 * Check installation requirements and do status reporting.
	 *
	 * @param boolean $status
	 *  Do status reporting or not.
	 *
	 * @return boolean
	 */
	function chack_requirements($status = true)
	{
		if (($library = e107::library('detect', 'dropbox')) && !empty($library['installed'])) {
			// The library is installed. Awesome!
			return true;
		}
		else
		{
			if($status)
			{
				$msg = e107::getMessage();

				// This contains a short status code of what went wrong, such as 'not found'.
				$error = $library['error'];
				// This contains a detailed error message.
				$error_message = $library['error message'];

				// Show error message from Library Manager.
				$msg->addWarning($error_message);

				// If 'not found'.
				if($error == LAN_LIBRARY_MANAGER_09)
				{
					$x = 'https://github.com/BenTheDesigner/Dropbox';
					$y = '{e_WEB}/lib/dropbox';

					// BenTheDesigner's Dropbox REST API library is missing, please download it from [x]
					// and place it at [y].
					$help = e107::getParser()->lanVars(LAN_PLUGIN_BACKUP_DROPBOX_LIBRARY_01, array($x, $y), true);
					$msg->addWarning($help);
				}

				// @FIXME how to display this?
			}

			return false;
		}
	}

}
