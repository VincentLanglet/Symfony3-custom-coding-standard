<?php

declare(strict_types=1);

namespace TwigCS\Ruleset;

use Exception;
use SplFileInfo;
use TwigCS\Sniff\SniffInterface;

/**
 * Set of rules to be used by TwigCS and contains all sniffs.
 */
class Ruleset
{
    /**
     * @var SniffInterface[]
     */
    protected $sniffs = [];

    /**
     * @return SniffInterface[]
     */
    public function getSniffs(): array
    {
        return $this->sniffs;
    }

    /**
     * @param SniffInterface $sniff
     *
     * @return $this
     */
    public function addSniff(SniffInterface $sniff): Ruleset
    {
        $this->sniffs[get_class($sniff)] = $sniff;

        return $this;
    }

    /**
     * @param string $standardName
     *
     * @return Ruleset
     *
     * @throws Exception
     */
    public function addStandard(string $standardName = 'Generic'): Ruleset
    {
        if (!is_dir(__DIR__.'/'.$standardName)) {
            throw new Exception(sprintf('The standard "%s" is not found.', $standardName));
        }

        $flags = \RecursiveDirectoryIterator::SKIP_DOTS | \FilesystemIterator::FOLLOW_SYMLINKS;
        $directoryIterator = new \RecursiveDirectoryIterator(__DIR__.'/'.$standardName, $flags);
        $iterator = new \RecursiveIteratorIterator($directoryIterator);

        /** @var SplFileInfo $file */
        foreach ($iterator as $file) {
            $class = __NAMESPACE__.'\\'.$standardName.'\\'.$file->getBasename('.php');

            if (class_exists($class)) {
                $this->addSniff(new $class());
            }
        }

        return $this;
    }
}
