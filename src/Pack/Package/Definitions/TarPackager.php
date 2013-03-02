<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Package\Definitions;

use Pack\Pack;

/**
 * Description of TarPackager
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class TarPackager implements PackagerDefinition {

    public function package($definition, Pack $pack) {
        $fileName = $pack->getTargetFolder() . '/' . $definition['name'] . '.tar';
        $phar = new \PharData($fileName);
        $phar->buildFromDirectory($pack->getApplicationPath());
    }

}

?>
