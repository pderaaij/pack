<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Package;

use Pack\Pack;
use Pack\IO\ConsoleIO;
use Pack\Config\PackageConfiguration;
use Pack\Json\Parser;

/**
 * Description of Packager
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class Packager {

    private $io;
    private $pack;
    private $configurationFile;

    public function __construct(ConsoleIO $io, Pack $pack) {
        $this->io = $io;
        $this->pack = $pack;
    }

    public static function create(ConsoleIO $input, Pack $pack) {
        return new static($input, $pack);
    }

    public function setConfigurationFile($file) {
        $this->configurationFile = $file;
    }

    public function run() {
        if (null == $this->configurationFile) {
            throw new \RuntimeException("Configuration file is mandatory");
        }

        $configuration = $this->readConfiguration($this->configurationFile);
        $this->processArtifacts($configuration);

        return true;
    }

    private function processArtifacts($configuration) {
        foreach ($configuration->artifactDefinitions() as $definition) {
            $this->packageArtifact($definition);
        }
    }

    private function readConfiguration($file) {
        $parser = new Parser($file);
        $configuration = new PackageConfiguration();
        $configuration->setJsonConfig($parser->read());
        return $configuration;
    }

    private function packageArtifact($definition) {
        $packager = PackageDefintionFactory::getPackager($definition);
        $packager->package($definition, $this->pack->getApplicationPath());
    }

}

?>
