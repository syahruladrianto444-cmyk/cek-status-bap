<?php
$host = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com';
$port = 4000;
$db = 'test';

$users = ['3HmEguLRggppLdM.root', '3HmEgul.RggppLdM.root'];
$passes = [
    'qB8DWmXvhYK1Ex0l', 'qB8DWmXvhYKIEx0l', 'qB8DWmXvhYKlEx0l',
    'qB8DWmXvhYK1Ex01', 'qB8DWmXvhYKIEx01', 'qB8DWmXvhYKlEx01',
    'qB8DWmXvhYK1ExOl', 'qB8DWmXvhYKIExOl', 'qB8DWmXvhYKlExOl',
    'qB8DWmXvhYK1ExO1', 'qB8DWmXvhYKIExO1', 'qB8DWmXvhYKlExO1',
    'qB8DWmXvhYK1Ex0I', 'qB8DWmXvhYKIEx0I', 'qB8DWmXvhYKlEx0I',
    'qB8DWmXvhYK1ExOI', 'qB8DWmXvhYKIExOI', 'qB8DWmXvhYKlExOI',
    'qB8DWmXvhYK1Exol', 'qB8DWmXvhYKIExol', 'qB8DWmXvhYKlExol',
    'qB8DWmXvhYK1Exo1', 'qB8DWmXvhYKIExo1', 'qB8DWmXvhYKlExo1',
    'qB8DWmxvhYK1Ex0l', 'qB8DWmxvhYKIEx0l', 'qB8DWmxvhYKlEx0l', // lowercase x
];
$options = [
    PDO::MYSQL_ATTR_SSL_CA => __DIR__ . '/cacert.pem',
];

foreach ($users as $u) {
    foreach ($passes as $p) {
        $dsn = "mysql:host=$host;port=$port;dbname=$db";
        try {
            $pdo = new PDO($dsn, $u, $p, $options);
            echo "SUCCESS: User: $u, Pass: $p\n";
            exit(0);
        } catch (PDOException $e) {
            echo "Failed: $u / $p -> " . $e->getMessage() . "\n";
        }
    }
}
echo "ALL FAILED\n";
