<?php

namespace SymfonyCustom\Tests\Classes;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the PropertyDeclaration sniff.
 *
 * @group SymfonyCustom
 */
class PropertyDeclarationUnitTest extends AbstractSniffUnitTest
{
    /**
     * @return array
     */
    protected function getErrorList(): array
    {
        return [
            9 => 1,
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
