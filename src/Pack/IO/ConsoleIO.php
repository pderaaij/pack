<?php

/*
 * This file is part of the Philly package.
 *
 * (c) Paul de Raaij <paulderaaij@eleven.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pack\IO;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of ConsoleIO
 *
 * @author pderaaij
 */
class ConsoleIO {

    private $input = null;
    private $output = null;

    public function __construct(InputInterface $input, OutputInterface $output) {
        $this->input = $input;
        $this->output = $output;
    }

    public function write($msg) {
        $this->output->writeln($msg);
        return $this;
    }

}

?>
