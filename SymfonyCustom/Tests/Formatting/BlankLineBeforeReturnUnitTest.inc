<?php
function validFunctionReturnOne()
{
    return;
}

function validFunctionReturnTwo()
{

    return;
}

function validFunctionReturnThree()
{
    echo "";

    return;
}

function validFunctionReturnFour()
{
    // comment
    return;
}

function validFunctionReturnFive()
{
    /**
     * multi-line
     */
    return;
}

function validFunctionReturnSix()
{
    /** comment */
    return;
}

function invalidFunctionReturnOne()
{
    echo "";
    return;
}

switch ($condition) {
    case 'foo':
        return true;

    default:
        return false;
}