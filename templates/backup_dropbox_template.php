<?php

/**
 * @file
 * Templates for "backup_dropbox" plugin.
 */

// Template for displaying account details on Admin UI.
$BACKUP_DROPBOX_TEMPLATE['ACCOUNT_INFO'] = '
<dl class="dl-horizontal">
  <dt>{NAME_LABEL}</dt>
  <dd>{NAME_VALUE}</dd>

  <dt>{EMAIL_LABEL}</dt>
  <dd>{EMAIL_VALUE}</dd>

  <dt>{TEAM_LABEL}</dt>
  <dd>{TEAM_VALUE}</dd>

  <dt>{COUNTRY_LABEL}</dt>
  <dd>{COUNTRY_VALUE}</dd>
</dl>
';
