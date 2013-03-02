<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Package;

use Pack\Package\Definitions\TarPackager;

/**
 * Description of PackageDefintionFactory
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class PackageDefintionFactory {

    public static function getPackager(array $definition) {
        switch ($definition['type']) {
            case 'tar': {
                    return new TarPackager();
                    break;
                }

            default: {
                    throw new \RuntimeException("Type is not supported");
                }
        }
    }

}

?>
