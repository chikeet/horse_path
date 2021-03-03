<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Tests;

use Tester\Environment;

if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo "Install Nette Tester using `composer install`\n";
	exit(1);
}

Environment::setup();
date_default_timezone_set('Europe/Prague');
