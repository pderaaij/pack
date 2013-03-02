<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack;

/**
 * Description of Pack
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class Pack {

    const VERSION = "0.0.1";

    private $applicationPath;
    private $targetFolder;

    public function __construct() {
        $this->applicationPath = getcwd();
    }

    public static function create() {
        return new static();
    }

    public function getApplicationPath() {
        return $this->applicationPath;
    }

    public function setApplicationPath($path) {
        return $this->applicationPath = $path;
    }

    public function getTargetFolder() {
        return $this->targetFolder;
    }

    public function setTargetFolder($path) {
        $this->targetFolder = $path;
    }

}

?>
