<?php

declare(strict_types=1);

namespace SymfonyCustom\Tests\Commenting;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the ClassComment sniff.
 */
class ClassCommentUnitTest extends AbstractSniffUnitTest
{
    /**
     * @return array
     */
    protected function getErrorList(): array
    {
        return [
            3 => 1,
        ];
    }

    /**
     * @return array
     */
    protected function getWarningList(): array
    {
        return [];
    }
}
