<?php

declare(strict_types=1);

namespace TwigCS\Tests\Ruleset;

use Exception;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use TwigCS\Environment\StubbedEnvironment;
use TwigCS\Report\Report;
use TwigCS\Ruleset\Ruleset;
use TwigCS\Runner\Fixer;
use TwigCS\Runner\Linter;
use TwigCS\Sniff\SniffInterface;
use TwigCS\Tests\TestHelper;
use TwigCS\Token\Tokenizer;

/**
 * Class AbstractSniffTest
 */
abstract class AbstractSniffTest extends TestCase
{
    /**
     * Should call $this->checkSniff(new Sniff(), [...]);
     *
     * @return void
     */
    abstract public function testSniff(): void;

    /**
     * @param SniffInterface $sniff
     * @param array          $expects
     *
     * @return void
     */
    protected function checkSniff(SniffInterface $sniff, array $expects): void
    {
        $env = new StubbedEnvironment();
        $tokenizer = new Tokenizer($env);
        $linter = new Linter($env, $tokenizer);
        $ruleset = new Ruleset();

        try {
            $class = new ReflectionClass(get_called_class());
            $className = $class->getShortName();
            $directory = dirname($class->getFileName());
            $file = "$directory/$className.twig";

            $ruleset->addSniff($sniff);
            $report = $linter->run([$file], $ruleset);
        } catch (Exception $exception) {
            self::fail($exception->getMessage());

            return;
        }

        $fixedFile = "$directory/$className.fixed.twig";
        if (file_exists($fixedFile)) {
            $fixer = new Fixer($ruleset, $tokenizer);
            $sniff->enableFixer($fixer);
            $fixer->fixFile($file);

            $diff = TestHelper::generateDiff($fixer->getContents(), $fixedFile);
            if ('' !== $diff) {
                self::fail($diff);
            }
        }

        $messages = $report->getMessages();
        $messagePositions = [];

        foreach ($messages as $message) {
            if (Report::MESSAGE_TYPE_FATAL === $message->getLevel()) {
                $errorMessage = $message->getMessage();
                $line = $message->getLine();

                if (null !== $line) {
                    $errorMessage = sprintf('Line %s: %s', $line, $errorMessage);
                }
                self::fail($errorMessage);
            }

            $messagePositions[] = [$message->getLine() => $message->getLinePosition()];
        }
        self::assertSame($expects, $messagePositions);
    }
}
