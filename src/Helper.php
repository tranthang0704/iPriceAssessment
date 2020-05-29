<?php
namespace Helper;

use Exception;

class Helper {
    const ENCODING_UTF8 = 'UTF-8';
    const INPUT_LENGTH = 254;
    const DEFAULT_CVS_OUTPUT_FILENAME = 'default_output.csv';

    public function __construct()
    {
        $this->setUpSomeEnv();
    }

    /**
     * Get input string as the first argument from command line and do simple validation
     *
     * @return string : input string of user
     */
    function getInputString() : string {
        $inputString = '';
        echo 'Please type your input string below (max ' .self::INPUT_LENGTH. ' characters)', PHP_EOL;
        while (empty($inputString)) {
            $inputString = $this->inputMethod();
            $inputString = $this->validateInput($inputString);
        }

        return $inputString;
    }

    /**
     * Get input from STDIN, can be replaced for other input method
     *
     * @return bool|string
     */
    function inputMethod() {
        return fgets(STDIN, self::INPUT_LENGTH);
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
            if ($this->isUpperCase($i)) {
                $char = $this->upperCase($char);
            } else {
                $char = $this->lowerCase($char);
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
     * @param $filename
     * @return bool
     */
    function generateCSV($inputString, $filename) : bool {
        if (!isset($filename) || $filename == '' || !strpos($filename, '.csv')){
            $filename = self::DEFAULT_CVS_OUTPUT_FILENAME;
        }
        try {
            $file = fopen($filename, 'w');
            if ($file) {
                $content = str_split($inputString);
                fputcsv($file, $content);
                fclose($file);
                return true;
            }
            echo 'Failed to open : ' .$filename, PHP_EOL;
            echo 'Please try again !', PHP_EOL;
            return false;
        } catch (Exception $exc) {
            echo 'Error occurred : ' .$exc->getMessage(), PHP_EOL;
            echo 'Please try again !', PHP_EOL;
            return false;
        }
    }

    /**
     * Define STDIN stream and only show report of ERROR level
     */
    function setUpSomeEnv() :void {
        if(!defined('STDIN')) {
            define('STDIN', fopen('php://stdin','r'));
        }
        error_reporting(E_ERROR);
        mb_internal_encoding('UTF-8');
    }
}
