<?php 

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use dstollie\ClosureCompiler\Compiler;
use dstollie\ClosureCompiler\CompilerException;

try {
    $compiler = new Compiler('C:/closure/');
    if($result = $compiler->compile(array("test.js", "test.js"), "output.js")) {
        var_dump($result);
    } else {
        var_dump($result);
    }
} catch (CompilerException $e) {
    echo $e->getMessage();
}