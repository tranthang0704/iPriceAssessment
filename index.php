#!/usr/bin/php
<?php
require_once 'vendor/autoload.php';

use Helper\Helper;

const CVS_OUTPUT_FILENAME = 'output.csv';

execute();

/**
 * main function
 */
function execute() : void {
    // create Helper class instance
    $helper = new Helper();

    // get and check input parameter
    $inputString = $helper->getInputString();

    // convert all upper case and output
    $upperCaseString = $helper->upperCase($inputString);
    echo $upperCaseString, PHP_EOL;

    // convert alternate upper case/lower case and output
    $alternateString = $helper->alternateUpperCase($inputString);
    echo $alternateString, PHP_EOL;

    // create CSV file and push content
    if ($helper->generateCSV($inputString, CVS_OUTPUT_FILENAME)) {
        echo 'CSV file created with name ' .CVS_OUTPUT_FILENAME. ' !';
    }
}
