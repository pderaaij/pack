<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Json;

/**
 * Description of Parser
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class Parser {

    private $path = null;

    public function __construct($path) {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException("The given path to the file doesn't exists");
        }

        $this->path = $path;
    }

    public function read() {
        try {
            $data = file_get_contents($this->path);
        } catch (\Exception $e) {
            throw new \RuntimeException("Could not read the contents of file " . $this->path . "\n\n" . $e->getMessage());
        }

        return $this->parse($data);
    }

    private function parse($data) {
        $json = json_decode($data, true);

        if (null === $json) {
            throw new \RuntimeException("Could not read the contents of file " . $this->path . "\n\n" . $e->getMessage());
        }

        return $json;
    }

}

?>
