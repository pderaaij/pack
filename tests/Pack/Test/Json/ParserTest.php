<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Test\Json;

use Pack\Json\Parser;

/**
 * Description of ParserTest
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class ParserTest extends \PHPUnit_Framework_TestCase {

    public function testParsingConfigurationFile() {
        $parser = new Parser(__DIR__ . '/Fixtures/complete_package_config.json');
        $jsonData = $parser->read();

        $this->assertTrue(is_array($jsonData));
        $this->assertThat($jsonData['name'], $this->equalTo('Complete package'));
        $this->assertThat(count($jsonData['artifacts']), $this->equalTo(2));
        $this->assertThat($jsonData['artifacts'][0]['type'], $this->equalTo('tar'));
        $this->assertThat($jsonData['artifacts'][1]['type'], $this->equalTo('phar'));
    }

}

?>
