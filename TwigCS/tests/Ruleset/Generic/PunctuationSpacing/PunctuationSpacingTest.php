<?php

declare(strict_types=1);

namespace TwigCS\Tests\Ruleset\Generic\PunctuationSpacing;

use TwigCS\Ruleset\Generic\PunctuationSpacingSniff;
use TwigCS\Tests\Ruleset\AbstractSniffTest;

/**
 * Class PunctuationSpacingTest
 */
class PunctuationSpacingTest extends AbstractSniffTest
{
    /**
     * @return void
     */
    public function testSniff(): void
    {
        $this->checkSniff(new PunctuationSpacingSniff(), [
            [3 => 4],
            [3 => 10],
            [4 => 4],
            [4 => 10],
            [4 => 16],
            [4 => 22],
            [4 => 28],
            [5 => 12],
            [5 => 16],
            [5 => 20],
            [5 => 24],
            [6 => 6],
            [6 => 6],
        ]);
    }
}
