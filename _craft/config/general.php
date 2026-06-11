<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 * @link https://craftcms.com/docs/5.x/reference/config/general.html
 */

use craft\config\GeneralConfig;
use craft\helpers\App;

$isDev = App::env('CRAFT_ENVIRONMENT') === 'dev';
$isProd = App::env('CRAFT_ENVIRONMENT') === 'production';

return GeneralConfig::create()
    ->allowAdminChanges($isDev)
    ->allowUpdates(false)
    ->cacheDuration('P1W')
    ->convertFilenamesToAscii()
    ->defaultImageQuality(85)
    ->defaultWeekStartDay(1)
    ->devMode($isDev)
    ->disallowRobots(!$isProd)
    ->enableTemplateCaching($isProd)
    ->enableTwigSandbox()
    ->errorTemplatePrefix('_errors/')
    ->generateTransformsBeforePageLoad($isProd)
    ->handleCasing('snake')
    ->loginPath(false)
    ->omitScriptNameInUrls()
    ->pageTrigger('?page')
    ->preloadSingles()
    ->preventUserEnumeration()
    ->previewTokenDuration(5184000) // 60 days
    ->securityKey(App::env('CRAFT_SECURITY_KEY'))
    ->sendPoweredByHeader(false)
    ->timezone('Europe/London')
    ->verificationCodeDuration(432000)
    ->defaultSearchTermOptions([
        'subLeft' => true,
        'subRight' => true,
    ])
    ->aliases([
        '@web' => App::env('PRIMARY_SITE_URL'),
        '@webroot' => dirname(__DIR__) . '/web',
    ])
;
