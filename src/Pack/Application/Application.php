<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Application;

use Pack\Pack;
use Pack\Command\ValidateCommand;
use Pack\Command\PackageCommand;
use Pack\IO\ConsoleIO;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of Pack
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class Application extends BaseApplication {

    private $io;
    private $pack;

    public function __construct() {
        parent::__construct("Pack", Pack::VERSION);
    }

    public function run(InputInterface $input = null, OutputInterface $output = null) {
        parent::run($input, $output);
    }

    public function doRun(InputInterface $input, OutputInterface $output) {
        $this->io = new ConsoleIO($input, $output);
        parent::doRun($input, $output);
    }

    public function getPack() {
        if (null === $this->pack) {
            $this->pack = Pack::create();
        }

        return $this->pack;
    }

    public function getIO() {
        return $this->io;
    }

    /**
     * Initializes all the composer commands
     */
    protected function getDefaultCommands() {
        $commands = parent::getDefaultCommands();
        $commands[] = new ValidateCommand();
        $commands[] = new PackageCommand();
        return $commands;
    }

}

?>
