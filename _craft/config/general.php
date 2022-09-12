<?php
/**
 * General Configuration.
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 */

return [
    '*' => [
        'allowUpdates' => false,
        'defaultWeekStartDay' => 0,
        'enableCsrfProtection' => true,
        'omitScriptNameInUrls' => true,
        'securityKey' => getenv('SECURITY_KEY'),
        'cpTrigger' => 'admin',
        'pageTrigger' => '?page',
        'errorTemplatePrefix' => '_errors/',
        'defaultImageQuality' => 85,
        'verificationCodeDuration' => 432000,
        'cacheDuration' => 'P1W',
        'sendPoweredByHeader' => false,
        'convertFilenamesToAscii' => true,
        'timezone' => 'Europe/London',
        'defaultSearchTermOptions' => [
            'subLeft' => true,
            'subRight' => true,
        ],
        'aliases' => [
            'modules' => 'modules',
            'assetsUrl' => getenv('ASSETS_URL'),
        ],
        'maxCachedCloudImageSize' => 0,
        'allowAdminChanges' => false,
        'handleCasing' => 'snake',
        'revAssetUrls' => true,
    ],

    'dev' => [
        'devMode' => true,
        'enableTemplateCaching' => false,
        'allowAdminChanges' => true,
    ],
];
