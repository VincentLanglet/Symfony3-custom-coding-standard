<?php

namespace TwigCS\Tests\Sniff;

use TwigCS\Sniff\Standard\DelimiterSpacingSniff;
use TwigCS\Tests\AbstractSniffTest;

/**
 * Class DelimiterSpacingTest
 */
class DelimiterSpacingTest extends AbstractSniffTest
{
    public function testSniff1()
    {
        $this->checkGenericSniff('delimiterSpacing.twig', new DelimiterSpacingSniff(), [
            [12, 1],
            [12, 12],
            [12, 15],
            [12, 25],
        ]);
    }
}
