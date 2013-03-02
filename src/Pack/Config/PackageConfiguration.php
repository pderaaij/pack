<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Config;

/**
 * Description of PackageConfiguration
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class PackageConfiguration {

    private $jsonConfig = null;

    public function __construct() {

    }

    public function setJsonConfig($configData) {
        $this->jsonConfig = $configData;
    }

}

?>
