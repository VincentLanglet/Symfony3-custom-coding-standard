<?php

declare(strict_types=1);

namespace TwigCS\Tests;

/**
 * Class TestHelper
 */
class TestHelper
{
    /**
     * @return void
     */
    private function __construct()
    {
    }

    /**
     * @param string $contents Content to compare
     * @param string $filePath File path to diff the file against.
     *
     * @return string
     */
    public static function generateDiff(string $contents, string $filePath): string
    {
        $cwd = getcwd().DIRECTORY_SEPARATOR;
        if (mb_strpos($filePath, $cwd) === 0) {
            $filename = mb_substr($filePath, mb_strlen($cwd));
        } else {
            $filename = $filePath;
        }

        $tempName = tempnam(sys_get_temp_dir(), 'TwigCS');
        $fixedFile = fopen($tempName, 'w');
        fwrite($fixedFile, $contents);

        // We must use something like shell_exec() because whitespace at the end
        // of lines is critical to diff files.
        $filename = escapeshellarg($filename);
        $cmd = "diff -u -L$filename -LTwigCS $filename \"$tempName\"";

        $diff = shell_exec($cmd);

        fclose($fixedFile);
        if (is_file($tempName) === true) {
            unlink($tempName);
        }

        $diffLines = null !== $diff ? explode(PHP_EOL, $diff) : [];
        if (count($diffLines) === 1) {
            // Seems to be required for cygwin.
            $diffLines = explode("\n", $diff);
        }

        $diff = [];
        foreach ($diffLines as $line) {
            if (isset($line[0]) === true) {
                switch ($line[0]) {
                    case '-':
                        $diff[] = "\033[31m$line\033[0m";
                        break;
                    case '+':
                        $diff[] = "\033[32m$line\033[0m";
                        break;
                    default:
                        $diff[] = $line;
                }
            }
        }

        $diff = implode(PHP_EOL, $diff);

        return $diff;
    }
}
