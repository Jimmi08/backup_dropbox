<?php

/**
 * @file
 * Main functions for 'backup_dropbox' plugin.
 */


/**
 * Class backup_dropbox.
 */
class backup_dropbox
{

	/**
	 * Store plugin preferences.
	 *
	 * @var array
	 */
	private $plugPrefs = array();

	/**
	 * DropBox object.
	 *
	 * @var null|object
	 */
	var $dropbox = null;

	/**
	 * Constructor.
	 */
	function __construct()
	{
		// Get plugin preferences.
		$this->plugPrefs = e107::getPlugConfig('backup_dropbox')->getPref();
	}

	/**
	 * Try to make backup files and export them to DropBox.
	 */
	public function doBackup()
	{
		$data = array();
		$data[] = e_MEDIA;
		$data[] = e_LOG;
		$data[] = e_IMPORT;
		$data[] = e_TEMP;
		$data[] = e_SYSTEM . "filetypes.xml";
		$data[] = e_THEME . e107::getPref('sitetheme');

		$plugins = e107::getPlugin()->getOtherPlugins();
		foreach($plugins as $dir)
		{
			$data[] = e_PLUGIN . $dir;
		}

		$fileName = eHelper::title2sef(SITENAME) . "_" . date("Y-m-d-H-i-s");

		// Make file backup and save it locally.
		e107::getFile()->zip($data, e_BACKUP . $fileName . '.zip');

		// If backup file exists, try to export.
		if(file_exists(e_BACKUP . $fileName . '.zip'))
		{
			$fileZIP = $this->saveFile(e_BACKUP . $fileName . '.zip');
			if($fileZIP != false)
			{
				e107::getAdminLog()->addSuccess($fileName . '.zip', false)->save(LAN_PLUGIN_BACKUP_DROPBOX_CRON_03);
			}
		}

		// Make database backup and save it locally.
		e107::getDb()->backup('*', $fileName . '.sql', array('nologs' => 1, 'droptable' => 1));

		// If backup file exists, try to export.
		if(file_exists(e_BACKUP . $fileName . '.sql'))
		{
			$fileDB = $this->saveFile(e_BACKUP . $fileName . '.sql');
			if($fileDB != false)
			{
				e107::getAdminLog()->addSuccess($fileName . '.sql', false)->save(LAN_PLUGIN_BACKUP_DROPBOX_CRON_04);
			}
		}
	}

	/**
	 * Save to to the DropBox destination.
	 *
	 * @param string $file
	 *  Absolute path to the file to be uploaded.
	 * @param string|bool $filename
	 *  The destination filename of the uploaded file.
	 * @param string $path
	 *  Path to upload the file to, relative to root.
	 * @param boolean $overwrite
	 *  Should the file be overwritten? (Default: true).
	 *
	 * @return boolean|object
	 *  FALSE if uploading was not successful, otherwise result object from DropBox.
	 */
	public function saveFile($file, $filename = false, $path = '', $overwrite = true)
	{
		$dropbox = $this->dropboxObject();

		if(empty($path))
		{
			$path = $this->plugPrefs['path'];
		}

		try
		{
			$result = $dropbox->putFile($file, $filename, $path, $overwrite);
		} catch(Exception $e)
		{
			// $x = $e->getMessage();
			// There was a problem when we tried to save the file to Dropbox, the error message was: [x]
			return false;
		}

		return $result;
	}

	/**
	 * Create the DropBox object from BenTheDesigner's PHP API.
	 */
	function dropboxObject()
	{
		if(!$this->dropbox)
		{
			// Load 'dropbox' library.
			if(($library = e107::library('load', 'dropbox')) && !empty($library['loaded']))
			{
				$appKey = varset($this->plugPrefs['app_key'], '');
				$appSecret = varset($this->plugPrefs['app_secret'], '');
				$encryptionKey = varset($this->plugPrefs['encryption_key'], '');

				// Instantiate the Encrypter and storage objects.
				$encrypter = new \Dropbox\OAuth\Storage\Encrypter($encryptionKey);

				// Create the storage object, passing it the Encrypter object.
				$storage = new \Dropbox\OAuth\Storage\Session($encrypter);

				// Create the consumer and API objects.
				$OAuth = new \Dropbox\OAuth\Consumer\Curl($appKey, $appSecret, $storage, e_SELF);
				$this->dropbox = new \Dropbox\API($OAuth);
			}
		}

		return $this->dropbox;
	}

}
