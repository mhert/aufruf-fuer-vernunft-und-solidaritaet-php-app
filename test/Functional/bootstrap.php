<?php

declare(strict_types=1);

use Symfony\Component\Dotenv;

require \dirname(__DIR__, 2) . '/vendor/autoload.php';

if (\file_exists(\dirname(__DIR__, 2) . '/config/bootstrap.php')) {
    require \dirname(__DIR__, 2) . '/config/bootstrap.php';
} else {
    (new Dotenv\Dotenv())->bootEnv(\dirname(__DIR__, 2) . '/.env');
}
