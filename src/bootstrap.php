<?php

/**
 * Bootstrap file
 *
 * This file bootstrap the autoloader and registers the default namespace for
 * autoloading classes
 *
 * @author Paul de Raaij <paul@paulderaaij.nl>
 */
require_once __DIR__ . '/Pack/AutoLoad/ClassLoader.php';

$classLoader = new Pack\AutoLoad\ClassLoader('Pack', __DIR__);
$classLoader->register();

$classLoader = new Pack\AutoLoad\ClassLoader('Symfony\Component', __DIR__ . '/../library');
$classLoader->register();