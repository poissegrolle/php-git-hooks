<?php

namespace PhpGitHooks\Infraestructure\PhpUnit;

use PhpGitHooks\Composer\Processor;
use PhpGitHooks\Infraestructure\Common\ConfigFileToolValidator;

/**
 * Class PhpUnitInitConfigFile
 * @package PhpGitHooks\Infraestructure\PhpUnit
 */
class PhpUnitInitConfigFile extends Processor
{
    /** @var  ConfigFileToolValidator */
    private $validatorFile;

    private $configFiles = ['phpunit.xml', 'phpunit.xml.dist'];

    /**
     * @param ConfigFileToolValidator $configFileToolValidator
     */
    public function __construct(ConfigFileToolValidator $configFileToolValidator)
    {
        $this->validatorFile = $configFileToolValidator;
        $this->validatorFile->setFiles($this->configFiles);
    }

    public function process()
    {
        if (!$this->validatorFile->existsConfigFile()) {
            $this->createFile();
        }
    }

    private function createFile()
    {
        $answer = $this->setQuestion('Do you want create a phpunit.xml.dist file?', 'Y/n', 'Y');

        if ('Y' === strtoupper($answer)) {
            copy(__DIR__.'/../../../../phpunit.xml.dist', 'phpunit.xml.dist');
        }
    }
}
