<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Command;

use Pack\Command\Command;
use Pack\Package\Packager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of PackageCommand
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class PackageCommand extends Command {

    public function configure() {
        $this->setName('package')
                ->setDescription('Build packages defined in pack.json');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $pack = $this->getPack();
        $io = $this->getIO();

        $packager = Packager::create($io, $pack);
        $packager->setConfigurationFile($pack->getApplicationPath() . '/pack.json');

        return $packager->run() ? 0 : 1;
    }

}

?>
