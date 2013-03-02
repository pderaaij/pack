<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Pack\Compilation;

use \RecursiveIteratorIterator;
use \RecursiveDirectoryIterator;

/**
 * Description of Compiler
 *
 * @author Paul de Raaij <paulderaaij@eleven.nl>
 */
class Compiler {

    /**
     * Compiles composer into a single phar file
     *
     * @throws \RuntimeException
     * @param  string            $pharFile The full path to the file to create
     */
    public function compile($pharFile = 'pack.phar') {
        if (file_exists($pharFile)) {
            unlink($pharFile);
        }

        $phar = new \Phar($pharFile, 0, 'pack.phar');
        $phar->setSignatureAlgorithm(\Phar::SHA1);
        $phar->startBuffering();

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__ . '/../../../'));
        foreach ($iterator as $entry) {
            if ((strpos($entry->getRealPath(), '/src/') === false && strpos($entry->getRealPath(), '/library/') === false) && $entry->getFileName() != "bootstrap.php") {
                continue;
            }
            if (strpos($entry->getRealPath(), 'Pack/Compilation') !== false) {
                continue;
            }
            if ($entry->isFile()) {
                $this->addFile($phar, $entry);
            }
        }

        $this->addPackBin($phar);

        // Stubs
        $phar->setStub($this->getStub());

        $phar->stopBuffering();

        unset($phar);
    }

    private function addFile($phar, $file, $strip = true) {
        $path = str_replace(dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR, '', $file->getRealPath());
        $content = file_get_contents($file);
        if ($strip) {
            $content = $this->stripWhitespace($content);
        } elseif ('LICENSE' === basename($file)) {
            $content = "\n" . $content . "\n";
        }

        $phar->addFromString($path, $content);
    }

    /**
     * Removes whitespace from a PHP source string while preserving line numbers.
     *
     * @param  string $source A PHP string
     * @return string The PHP string with the whitespace removed
     */
    private function stripWhitespace($source) {
        if (!function_exists('token_get_all')) {
            return $source;
        }

        $output = '';
        foreach (@token_get_all($source) as $token) {
            if (is_string($token)) {
                $output .= $token;
            } elseif (in_array($token[0], array(T_COMMENT, T_DOC_COMMENT))) {
                $output .= str_repeat("\n", substr_count($token[1], "\n"));
            } elseif (T_WHITESPACE === $token[0]) {
                // reduce wide spaces
                $whitespace = preg_replace('{[ \t]+}', ' ', $token[1]);
                // normalize newlines to \n
                $whitespace = preg_replace('{(?:\r\n|\r|\n)}', "\n", $whitespace);
                // trim leading spaces
                $whitespace = preg_replace('{\n +}', "\n", $whitespace);
                $output .= $whitespace;
            } else {
                $output .= $token[1];
            }
        }

        return $output;
    }

    private function addPackBin($phar) {
        $content = file_get_contents(__DIR__ . '/../../../bin/pack');
        $content = preg_replace('{^#!/usr/bin/env php\s*}', '', $content);
        $phar->addFromString('bin/pack', $content);
    }

    private function getStub() {
        $stub = <<<'EOF'
#!/usr/bin/env php
<?php
Phar::mapPhar('pack.phar');
EOF;
        return $stub . <<<'EOF'
require 'phar://pack.phar/bin/pack';

__HALT_COMPILER();
EOF;
    }

}

?>
