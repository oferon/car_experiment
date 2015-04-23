<?php

require_once __DIR__ . '/../ext/Symfony/Component/ClassLoader/Psr4ClassLoader.php';

use Symfony\Component\ClassLoader\Psr4ClassLoader;

$loader = new Psr4ClassLoader();
$loader->addPrefix('Symfony\\Component\\HttpFoundation', __DIR__ . '/../ext/Symfony/Component/HttpFoundation');
$loader->addPrefix('Symfony\\Component\\Yaml', __DIR__ . '/../ext/Symfony/Component/Yaml');
$loader->addPrefix('carexperiment\\parts\\common', __DIR__);

$loader->register();