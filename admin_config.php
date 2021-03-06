<?php

/**
 * @file
 * Class installations to handle configuration forms on Admin UI.
 */

require_once('../../class2.php');

if(!e107::isInstalled('backup_dropbox') || !getperms("P"))
{
	e107::redirect(e_BASE . 'index.php');
}

// [PLUGINS]/backup_dropbox/languages/[LANGUAGE]/[LANGUAGE]_admin.php
e107::lan('backup_dropbox', true, true);


/**
 * Class backup_dropbox_admin.
 */
class backup_dropbox_admin extends e_admin_dispatcher
{

	/**
	 * Required (set by child class).
	 *
	 * Controller map array in format.
	 * @code
	 *  'MODE' => array(
	 *      'controller' =>'CONTROLLER_CLASS_NAME',
	 *      'path' => 'CONTROLLER SCRIPT PATH',
	 *      'ui' => 'UI_CLASS', // extend of 'comments_admin_form_ui'
	 *      'uipath' => 'path/to/ui/',
	 *  );
	 * @endcode
	 *
	 * @var array
	 */
	protected $modes = array(
		'ajax'    => array(
			'controller' => 'backup_dropbox_admin_ajax_ui',
		),
		'account' => array(
			'controller' => 'backup_dropbox_admin_account_ui',
			'path'       => null,
		),
		'main'    => array(
			'controller' => 'backup_dropbox_admin_ui',
			'path'       => null,
		),
	);

	/**
	 * Optional (set by child class).
	 *
	 * Required for admin menu render. Format:
	 * @code
	 *  'mode/action' => array(
	 *      'caption' => 'Link title',
	 *      'perm' => '0',
	 *      'url' => '{e_PLUGIN}plugname/admin_config.php',
	 *      ...
	 *  );
	 * @endcode
	 *
	 * Note that 'perm' and 'userclass' restrictions are inherited from the $modes, $access and $perm, so you don't
	 * have to set that vars if you don't need any additional 'visual' control.
	 *
	 * All valid key-value pair (see e107::getNav()->admin function) are accepted.
	 *
	 * @var array
	 */
	protected $adminMenu = array(
		'main/prefs'   => array(
			'caption' => LAN_BACKUP_DROPBOX_ADMIN_01,
			'perm'    => 'P',
		),
		'account/info' => array(
			'caption' => LAN_BACKUP_DROPBOX_ADMIN_13,
			'perm'    => 'P',
		),
	);

	/**
	 * Optional (set by child class).
	 *
	 * @var string
	 */
	protected $menuTitle = LAN_PLUGIN_BACKUP_DROPBOX_NAME;

}


/**
 * Class backup_dropbox_admin_ajax_ui.
 */
class backup_dropbox_admin_ajax_ui extends e_admin_ui
{

	/**
	 * Initial function.
	 */
	public function init()
	{
		// Construct action string.
		$action = varset($_GET['mode']) . '/' . varset($_GET['action']);

		switch($action)
		{
			case 'ajax/encrypt':
				$this->ajaxEncrypt();
				break;
		}
	}

	/**
	 * Ajax callback to generate encryption key.
	 */
	public function ajaxEncrypt()
	{
		// 32-byte encryption key.
		$key = md5(time());

		$ajax = e107::getAjax();

		$commands = array();
		$commands[] = $ajax->commandInvoke('#encryption', 'val', array($key));

		$ajax->response($commands);
		exit;
	}

}


/**
 * Class backup_dropbox_admin_account_ui.
 */
class backup_dropbox_admin_account_ui extends e_admin_ui
{

	/**
	 * Could be LAN constant (multi-language support).
	 *
	 * @var string plugin name
	 */
	protected $pluginTitle = LAN_PLUGIN_BACKUP_DROPBOX_NAME;

	/**
	 * Display a page with account details.
	 */
	public function infoPage()
	{
		$mes = e107::getMessage();

		e107_require_once(e_PLUGIN . 'backup_dropbox/includes/backup_dropbox.php');

		$bd = new backup_dropbox();
		$dropbox = $bd->dropboxObject();

		if(is_string($dropbox))
		{
			$mes->addWarning($dropbox);
			return $mes->render();
		}

		try
		{
			// Attempt to retrieve the account information
			$accountInfo = $dropbox->accountInfo();
		} catch(\Dropbox\Exception $e)
		{
			$mes->addWarning($e->getMessage());
			return $mes->render();
		}

		if(isset($accountInfo['code']) && $accountInfo['code'] == 200)
		{
			$tpl = e107::getTemplate('backup_dropbox');
			$sc = e107::getScBatch('backup_dropbox', true);
			$tp = e107::getParser();

			$details = $accountInfo['body'];

			$scVars = array(
				'name_label'    => LAN_BACKUP_DROPBOX_ADMIN_15,
				'name_value'    => varset($details->display_name, '-'),
				'email_label'   => LAN_BACKUP_DROPBOX_ADMIN_16,
				'email_value'   => varset($details->email, '-'),
				'team_label'    => LAN_BACKUP_DROPBOX_ADMIN_17,
				'team_value'    => varset($details->team, '-'),
				'country_label' => LAN_BACKUP_DROPBOX_ADMIN_18,
				'country_value' => varset($details->country, '-'),
			);

			$sc->setVars($scVars);
			return $tp->parseTemplate($tpl['ACCOUNT_INFO'], true, $sc);
		}

		$mes->addError(LAN_BACKUP_DROPBOX_ADMIN_14);
		return $mes->render();
	}

}


/**
 * Class backup_dropbox_admin_ui.
 */
class backup_dropbox_admin_ui extends e_admin_ui
{

	/**
	 * Could be LAN constant (multi-language support).
	 *
	 * @var string plugin name
	 */
	protected $pluginTitle = LAN_PLUGIN_BACKUP_DROPBOX_NAME;

	/**
	 * Plugin name.
	 *
	 * @var string
	 */
	protected $pluginName = "backup_dropbox";

	/**
	 * Example: array('0' => 'Tab label', '1' => 'Another label');
	 * Referenced from $prefs property per field - 'tab => xxx' where xxx is the tab key (identifier).
	 *
	 * @var array edit/create form tabs
	 */
	protected $preftabs = array(
		LAN_BACKUP_DROPBOX_ADMIN_01,
	);

	/**
	 * Plugin Preference description array.
	 *
	 * @var array
	 */
	protected $prefs = array(
		// Dropbox App Key.
		'app_key'    => array(
			'title' => LAN_BACKUP_DROPBOX_ADMIN_06,
			'help'  => LAN_BACKUP_DROPBOX_ADMIN_07,
			'type'  => 'text',
			'tab'   => 0,
		),
		// Dropbox App Secret.
		'app_secret' => array(
			'title' => LAN_BACKUP_DROPBOX_ADMIN_08,
			'help'  => LAN_BACKUP_DROPBOX_ADMIN_09,
			'type'  => 'text',
			'tab'   => 0,
		),
		// Path.
		'path'       => array(
			'title' => LAN_BACKUP_DROPBOX_ADMIN_04,
			'help'  => LAN_BACKUP_DROPBOX_ADMIN_05,
			'type'  => 'text',
			'tab'   => 0,
		),
		// 32-byte encryption key.
		'encryption' => array(
			'title' => LAN_BACKUP_DROPBOX_ADMIN_10,
			'help'  => LAN_BACKUP_DROPBOX_ADMIN_11,
			'type'  => 'text',
			'tab'   => 0,
		),
	);

	/**
	 * User defined init.
	 */
	public function init()
	{
		$form = e107::getForm();

		// Ajax button to generate random encryption key.
		$this->prefs['encryption']['writeParms']['class'] = 'pull-left';
		$this->prefs['encryption']['writeParms']['post'] = $form->button('generate', LAN_BACKUP_DROPBOX_ADMIN_12, 'action', '', array(
			'class'    => 'e-ajax',
			'data-src' => e_SELF . '?mode=ajax&action=encrypt',
		));
	}
}


new backup_dropbox_admin();

require_once(e_ADMIN . "auth.php");
e107::getAdminUI()->runPage();
require_once(e_ADMIN . "footer.php");
exit;
