<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\helpers\App;

$ts = @file_get_contents(__DIR__ . '/../.cachebust');
$cachebust = $ts ? trim($ts) : time();

$isDev = App::env('ENVIRONMENT') === 'dev';
$isProd = App::env('ENVIRONMENT') === 'production';

if ($isDev) {
  putenv("PATH={$_SERVER["PATH"]}:/Users/Shared/DBngin/mysql/8.0.27/bin");
}

return [
  'allowAdminChanges' => $isDev,
  'allowUpdates' => false,
  'cacheDuration' => 'P1W',
  'convertFilenamesToAscii' => true,
  'cpTrigger' => 'admin',
  'defaultImageQuality' => 85,
  'defaultWeekStartDay' => 1, // Monday
  'devMode' => $isDev,
  'enableCsrfProtection' => true,
  'enableTemplateCaching' => $isProd,
  'errorTemplatePrefix' => '_errors/',
  'generateTransformsBeforePageLoad' => $isProd,
  'handleCasing' => 'snake',
  'omitScriptNameInUrls' => true,
  'pageTrigger' => '?page',
  'previewTokenDuration' => 5184000, // 60 days
  'securityKey' => App::env('SECURITY_KEY'),
  'sendPoweredByHeader' => false,
  'timezone' => 'Europe/London',
  'verificationCodeDuration' => 432000,
  'aliases' => [
    '@web' => App::env('DEFAULT_SITE_URL'),
    '@webroot' => dirname(__DIR__) . '/web',
    '@cachebust' => $cachebust
  ],
  'defaultSearchTermOptions' => [
    'subLeft' => true,
    'subRight' => true,
  ],
];
