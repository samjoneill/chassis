<?php

use craft\helpers\App;

return [
    'id' => App::env('CRAFT_APP_ID') ?: 'CraftCMS',
    'components' => [
        'deprecator' => [
            'throwExceptions' => YII_DEBUG,
        ],
        'mailer' => function () {
            $settings = \craft\helpers\App::mailSettings();
            $settings->transportType = \craft\mail\transportadapters\Smtp::class;
            $settings->transportSettings = [
                'host' => '$EMAIL_SMTP_HOSTNAME',
                'port' => '$EMAIL_SMTP_PORT',
                'useAuthentication' => true,
                'username' => '$EMAIL_SMTP_USERNAME',
                'password' => '$EMAIL_SMTP_PASSWORD',
                'encryptionMethod' => 'tls',
            ];
            $config = craft\helpers\App::mailerConfig($settings);

            return Craft::createObject($config);
        },
    ],
];
