<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Package\Definitions;

use Pack\Pack;

/**
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
interface PackagerDefinition {

    public function package($definition, Pack $pack);
}

?>
