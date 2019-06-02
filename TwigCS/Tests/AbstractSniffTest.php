<?php

namespace TwigCS\Tests;

use \Exception;
use \ReflectionClass;
use PHPUnit\Framework\TestCase;
use TwigCS\Environment\StubbedEnvironment;
use TwigCS\Linter;
use TwigCS\Report\SniffViolation;
use TwigCS\Ruleset\Ruleset;
use TwigCS\Sniff\SniffInterface;
use TwigCS\Token\Tokenizer;

/**
 * Class AbstractSniffTest
 */
abstract class AbstractSniffTest extends TestCase
{
    /**
     * @var StubbedEnvironment
     */
    private $env;

    /**
     * @var Linter
     */
    private $lint;

    public function setUp()
    {
        $this->env = new StubbedEnvironment();
        $this->lint = new Linter($this->env, new Tokenizer($this->env));
    }

    /**
     * Should call $this->checkGenericSniff(new Sniff(), [...]);
     */
    abstract public function testSniff();

    /**
     * @param SniffInterface $sniff
     * @param array          $expects
     */
    protected function checkGenericSniff(SniffInterface $sniff, array $expects)
    {
        $ruleset = new Ruleset();
        try {
            $class = new ReflectionClass(get_called_class());
            $file = __DIR__.'/Fixtures/'.$class->getShortName().'.twig';

            $ruleset->addSniff($sniff);
            $report = $this->lint->run($file, $ruleset);
        } catch (Exception $e) {
            $this->fail($e->getMessage());

            return;
        }

        $this->assertEquals(count($expects), $report->getTotalWarnings() + $report->getTotalErrors());
        if ($expects) {
            $messagePositions = array_map(function (SniffViolation $message) {
                return [
                    $message->getLine(),
                    $message->getLinePosition(),
                ];
            }, $report->getMessages());

            $this->assertEquals($expects, $messagePositions);
        }
    }
}
