#!/usr/bin/php
<?php
/**
 * Created by ThangTran.
 * User: ThangTran
 * Date: 5/28/2020
 */
const ENCODING_UTF8 = 'UTF-8';
const INPUT_LENGTH = 254;
const CVS_OUTPUT_FILENAME = 'output.csv';

setUpSomeEnv();
execute();

/**
 * main function
 */
function execute() : void {
    // get and check input parameter
    $inputString = getInputString();

    // convert all upper case and output
    $upperCaseString = upperCase($inputString);
    echo $upperCaseString, PHP_EOL;

    // convert alternate upper case/lower case and output
    $alternateString = alternateUpperCase($inputString);
    echo $alternateString, PHP_EOL;

    // create CSV file and push content
    if (generateCSV($inputString)) {
        echo 'CSV file created with name ' .CVS_OUTPUT_FILENAME. ' !';
    }
}

/**
 * Get input string as the first argument from command line and do simple validation
 *
 * @return string : input string of user
 */
function getInputString() : string {
    $inputString = '';
    echo 'Please type your input string below (max ' .INPUT_LENGTH. ' characters)', PHP_EOL;
    while (empty($inputString)) {
        $inputString = fgets(STDIN, INPUT_LENGTH);
        $inputString = validateInput($inputString);
    }

    return $inputString;
}

/**
 * Check if the input is provide correctly or not
 * Can be extended for more complex rules
 *
 * @param string $input
 * @return string : '' in case failed
 */
function validateInput($input) : string {
    // trim EOL at the
    $input = rtrim($input, "\r\n");

    // clone and trim all space or tab
    $clone = trim($input);

    // simple check if input just a blank or not
    if (!isset($input) || $input == '' || strlen($clone) == 0) {
        echo 'Please input a string instead of blank !', PHP_EOL;
        return '';
    }
    return $input;
}

/**
 * Convert a string to upper case letter with utf-8 encoding
 *
 * @param String $input
 * @return string
 */
function upperCase(String $input) : string {
    return mb_strtoupper($input);
}

/**
 * Convert a string to lower case letter with utf-8 encoding
 *
 * @param String $input
 * @return string
 */
function lowerCase(String $input) : string {
    return mb_strtolower($input);
}

/**
 * Convert a string to upper case letter alternate lower case with utf-8 encoding
 *
 * @param String $input
 * @return string
 */
function alternateUpperCase(String $input) : string {
    $alternateString = '';
    for ($i = 0; $i < mb_strlen($input); $i++) {
        $char = mb_substr($input, $i, 1);
        if (isUpperCase($i)) {
            $char = upperCase($char);
        } else {
            $char = lowerCase($char);
        }
        $alternateString.= $char;
    }

    return $alternateString;
}

/**
 * Decide odd position will be converted to upper case
 *
 * @param int $index
 * @return bool
 */
function isUpperCase(int $index) : bool {
    return $index == 0 ? false : $index % 2 == 1;
}

/**
 * Create empty CSV in write mode and put content
 *
 * @param $inputString
 * @return bool
 */
function generateCSV($inputString) : bool {
    try {
        $file = fopen(CVS_OUTPUT_FILENAME, 'w');
        if ($file) {
            $content = str_split($inputString);
            fputcsv($file, $content);
            fclose($file);
            return true;
        }
        echo "Failed to open : " .CVS_OUTPUT_FILENAME, PHP_EOL;
        echo "Please try again !", PHP_EOL;
        return false;
    } catch (Exception $exc) {
        echo "Error occurred : " .$exc->getMessage(), PHP_EOL;
        echo "Please try again !", PHP_EOL;
        return false;
    }
}

/**
 * define STDIN stream and only show report of ERROR level
 */
function setUpSomeEnv() :void {
    if(!defined("STDIN")) {
        define("STDIN", fopen('php://stdin','r'));
    }
    error_reporting(E_ERROR);
    mb_internal_encoding('UTF-8');
}
