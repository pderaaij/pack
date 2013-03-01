<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Command;

use Pack\Command\Command;
use \Symfony\Component\Console\Input\InputArgument as InputArgument;

/**
 * Description of ValidateCommand
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class ValidateCommand extends Command {

    public function configure() {
        $this->setName('validate')
                ->setDescription('Validate pack definition file')
                ->setDefinition(array(
                    new InputArgument('definition', InputArgument::OPTIONAL, 'path to pack.json', '/.pack.json')
        ));
    }

}

?>
