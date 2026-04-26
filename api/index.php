<?php

// V3 Fresh Index
$env = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'LOG_CHANNEL' => 'stderr',
    'SESSION_DRIVER' => 'cookie',
    'CACHE_DRIVER' => 'array',
    'VIEW_COMPILED_PATH' => '/tmp',
    'DB_CONNECTION' => 'mysql',
    'DB_HOST' => 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com',
    'DB_PORT' => '4000',
    'DB_DATABASE' => 'test',
    'DB_USERNAME' => '3HmEguLRggppLdM.root',
    'DB_PASSWORD' => 'bjihRFNq2ZQgh0Yz',
    'APP_URL' => 'https://tracking-bap.vercel.app',
    'ASSET_URL' => 'https://tracking-bap.vercel.app',
    'APP_KEY' => 'base64:zrEOuEhUZ8JJQ1nwmLDHYKwq2kr94rFSiSFT5f9yTzs=',
    'MYSQL_ATTR_SSL_CA' => '/etc/pki/tls/certs/ca-bundle.crt',
];


foreach ($env as $key => $value) {
    putenv("$key=$value");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

require __DIR__ . '/../public/index.php';
