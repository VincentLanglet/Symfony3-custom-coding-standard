<?php

declare(strict_types=1);

namespace TwigCS\Ruleset\Generic;

use TwigCS\Sniff\AbstractSpacingSniff;
use TwigCS\Token\Token;

/**
 * Ensure there is one space before and after an operator except for '..'
 */
class OperatorSpacingSniff extends AbstractSpacingSniff
{
    /**
     * @param int     $tokenPosition
     * @param Token[] $tokens
     *
     * @return int|null
     */
    protected function shouldHaveSpaceBefore(int $tokenPosition, array $tokens): ?int
    {
        $token = $tokens[$tokenPosition];
        if (!$this->isTokenMatching($token, Token::OPERATOR_TYPE)) {
            return null;
        }

        if ($this->isTokenMatching($token, Token::OPERATOR_TYPE, ['-', '+'])) {
            return $this->isUnary($tokenPosition, $tokens) ? null : 1;
        }

        if ($this->isTokenMatching($token, Token::OPERATOR_TYPE, '..')) {
            return 0;
        }

        return 1;
    }

    /**
     * @param int     $tokenPosition
     * @param Token[] $tokens
     *
     * @return int|null
     */
    protected function shouldHaveSpaceAfter(int $tokenPosition, array $tokens): ?int
    {
        $token = $tokens[$tokenPosition];
        if (!$this->isTokenMatching($token, Token::OPERATOR_TYPE)) {
            return null;
        }

        if ($this->isTokenMatching($token, Token::OPERATOR_TYPE, ['-', '+'])) {
            return $this->isUnary($tokenPosition, $tokens) ? 0 : 1;
        }

        if ($this->isTokenMatching($token, Token::OPERATOR_TYPE, '..')) {
            return 0;
        }

        return 1;
    }

    /**
     * @param int   $tokenPosition
     * @param array $tokens
     *
     * @return bool
     */
    private function isUnary(int $tokenPosition, array $tokens): bool
    {
        $previous = $this->findPrevious(Token::EMPTY_TOKENS, $tokens, $tokenPosition - 1, true);
        if (false === $previous) {
            return true;
        }

        $previousToken = $tokens[$previous];
        if ($this->isTokenMatching($previousToken, Token::OPERATOR_TYPE)) {
            // {{ 1 * -2 }}
            return true;
        }

        if ($this->isTokenMatching($previousToken, Token::VAR_START_TYPE)) {
            // {{ -2 }}
            return true;
        }

        if ($this->isTokenMatching($previousToken, Token::PUNCTUATION_TYPE, ['(', '[', ':', ','])) {
            // {{ 1 + (-2) }}
            return true;
        }

        if ($this->isTokenMatching($previousToken, Token::BLOCK_TAG_TYPE)) {
            // {% if -2 ... %}
            return true;
        }

        return false;
    }
}
