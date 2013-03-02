<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Test\Package\Definitions;

use Pack\Package\Definitions\TarPackager;
use Pack\Json\Parser;

/**
 * Description of TarPackagerTest
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class TarPackagerTest extends \PHPUnit_Framework_TestCase {

    public function testPackagingSiteIntoTarArchive() {
        $parser = new Parser(__DIR__ . '/../Fixtures/configs/complete_site.json');
        $jsonData = $parser->read();

        $pack = new \Pack\Pack();
        $pack->setApplicationPath(__DIR__ . '/../Fixtures/testsite');
        $pack->setTargetFolder(__DIR__ . '/../Fixtures');

        $tarPackager = new TarPackager();
        $tarPackager->package($jsonData['artifacts'][0], $pack);
    }

}

?>
