<?php

/**
 * @file
 * Drupal site-specific configuration file.
 */

require_once DRUPAL_ROOT . '/sites/default/default.settings.php';

$settings['hash_salt'] = 'Lksd5sw+klewd4992asdkjh3H';

// Fast 404 pages
$config['system.performance']['fast_404']['exclude_paths'] = '/\/(?:styles)|(?:system\/files)\//';
$config['system.performance']['fast_404']['paths'] = '/\.(?:txt|png|gif|jpe?g|css|js|ico|swf|flv|cgi|bat|pl|dll|exe|asp)$/i';
$config['system.performance']['fast_404']['html'] = '<!DOCTYPE html><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL "@path" was not found on this server.</p></body></html>';

// Set temporary folder.
$config['system.file']['path.temporary'] = "../tmp";

// On Acquia Cloud, this include file configures Drupal to use the correct
// database in each site environment (Dev, Stage, or Prod).
if (file_exists('/var/www/site-php')) {
  require('/var/www/site-php/dkrweb/dkrweb-settings.inc');
}

$settings['install_profile'] = 'thunder';
$config_directories['sync'] = '../config/sync';


/**
 * Load local development override configuration, if available.
 *
 * Use settings.local.php to override variables on secondary (staging,
 * development, etc) installations of this site. Typically used to disable
 * caching, JavaScript/CSS compression, re-routing of outgoing emails, and
 * other things that should not happen on development and testing sites.
 *
 * Keep this code block at the end of this file to take full effect.
 */
$siteEnvironment = isset($_ENV['AH_SITE_ENVIRONMENT']) ? $_ENV['AH_SITE_ENVIRONMENT'] : 'local';

$stageSettingsFilePath = __DIR__ . '/settings.' . $siteEnvironment . '.php';
if (file_exists($stageSettingsFilePath)) {
  include $stageSettingsFilePath;
}
