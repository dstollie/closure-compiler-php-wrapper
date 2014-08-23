<?php 

namespace dstollie\ClosureCompiler;

class Compiler
{
    private $compilerLocation;
    private $jsOutputFile;

    function __construct($compilerLocation, $jsOutputFile = null)
    {
        $this->compilerLocation = $compilerLocation;
        $this->jsOutputFile = $jsOutputFile;
    }

    /**
     * @param mixed $compilerLocation
     */
    public function setCompilerLocation($compilerLocation)
    {
        $this->compilerLocation = $compilerLocation;
    }

    /**
     * @return mixed
     */
    public function getCompilerLocation()
    {
        return $this->compilerLocation;
    }

    /**
     * @param mixed $jsOutputFile
     */
    public function setJsOutputFile($jsOutputFile)
    {
        $this->jsOutputFile = $jsOutputFile;
    }

    /**
     * @return mixed
     */
    public function getJsOutputFile()
    {
        return $this->jsOutputFile;
    }


    /**
     * @param $toCompile string or an array with the file locations to compile
     * @param null $jsOutputFile The file to output the generated code
     * @return mixed
     * @throws \Exception
     */
    public function compile($toCompile, $jsOutputFile = null)
    {
        $compilerFile = $this->compilerLocation . 'compiler.jar';
        if(file_exists($compilerFile)) {
            //If the $toCompile is a string, only one file has to be compiled probably
            if(is_string($toCompile)) {
                $toCompile = array($toCompile);
            }

            if(is_array($toCompile)) {
                $this->jsOutputFile = $jsOutputFile ? $jsOutputFile : $this->jsOutputFile;

                $command = "java -jar " . $this->compilerLocation . "compiler.jar";

                if($this->jsOutputFile) {
                    $command .= " --js_output_file=" . $this->jsOutputFile;
                }

                foreach($toCompile as $file) {
                    $command .= " " . $file;
                }

                exec(escapeshellcmd($command), $output);

                return $output;

            } else {
                throw new CompilerException('The given item to compile is not an array or a string.');
            }
        } else {
            throw new CompilerException($this->compilerLocation . 'compiler.jar could not be found.');
        }
    }
}