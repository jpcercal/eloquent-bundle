#!/usr/bin/env php
<?php
/**
 * .git/hooks/pre-commit
 *
 * This pre-commit hooks will check for PHP errors (lint), and make sure the
 * code is PSR-2 compliant.
 *
 * And run PHPUnit test tool to check if the source code is broken.
 *
 * Dependencies: PHP-CS-Fixer and PHPUnit.
 *
 * @author  Mardix  http://github.com/mardix
 * @author  Matthew Weier O'Phinney http://mwop.net/
 * @author  João Paulo Cercal <jpcercal@gmail.com>
 * @since   4 Sept 2012
 */

$exit = 0;

/*
 * collect all files which have been added, copied or
 * modified and store them in an array called output
 */
$output = array();
exec('git diff --cached --name-status --diff-filter=ACM', $output);

foreach ($output as $file) {
    if ('D' === substr($file, 0, 1)) {
        // deleted file; do nothing
        continue;
    }

    $fileName = trim(substr($file, 1));

    /*
     * Only PHP files
     */
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    if (!preg_match('/^ph(p|tml)$/', $extension)) {
        continue;
    }

    /*
     * Check for parse errors
     */
    $output = array();
    $return = 0;
    exec("php -l -d " . escapeshellarg($fileName), $output, $return);

    if ($return != 0) {
        echo "PHP file fails to parse: " . $fileName . ":" . PHP_EOL;
        echo implode(PHP_EOL, $output) . PHP_EOL;
        $exit = 1;
        continue;
    }

    /*
     * PHP-CS-Fixer
     */
    $output = array();
    $return = null;
    exec("vendor/bin/php-cs-fixer fix --dry-run --level=psr2 --diff --verbose " . escapeshellarg($fileName), $output, $return);

    if ($return != 0 || !empty($output)) {
        if ($output[0] !== '.') {
            echo "PHP file contains CS issues: " . $fileName . ":" . PHP_EOL;
            echo implode(PHP_EOL, $output) . PHP_EOL;
            $exit = 1;
            continue;
        }
    }
}

/*
 * PHPUnit
 */
$output = array();
$return = null;
exec('vendor/bin/phpunit', $output, $return);

if ($return !== 0) {
    $minimalTestSummary = array_pop($output);
    echo "Test suite failed: " . $minimalTestSummary . PHP_EOL;
    $exit = 1;
}

if ($exit === 1) {
    throw new \Exception('One or more errors has occurred ABORTING COMMIT!');
}
