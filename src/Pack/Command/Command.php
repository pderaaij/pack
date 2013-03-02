<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Description of Command
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
abstract class Command extends BaseCommand {

    private $pack;
    private $io;

    public function getPack() {
        if (null === $this->pack) {
            $application = $this->getApplication();
            $this->pack = $application->getPack();
        }

        return $this->pack;
    }

    public function getIO() {
        if (null === $this->io) {
            $application = $this->getApplication();
            $this->io = $application->getIO();
        }

        return $this->io;
    }

}

?>
