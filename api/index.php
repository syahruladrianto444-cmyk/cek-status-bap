<?php

// Ensure production environment on Vercel
putenv('APP_ENV=production');
putenv('APP_DEBUG=false');
putenv('LOG_CHANNEL=stderr');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_DRIVER=array');
putenv('VIEW_COMPILED_PATH=/tmp');

require __DIR__ . '/../public/index.php';
