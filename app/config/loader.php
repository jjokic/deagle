<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
 
$config = $di->getConfig();
 
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->formsDir,
        $config->application->libraryDir
    ]
)->register();

$loader->registerFiles(
    [
        'acl.php'
    ]
)->register();