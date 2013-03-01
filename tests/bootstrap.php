<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

error_reporting(E_ALL);

require __DIR__ . '/../src/bootstrap.php';
$loader = new Philly\AutoLoad\SplClassLoader('Pack\Test', __DIR__);
$loader->register();
