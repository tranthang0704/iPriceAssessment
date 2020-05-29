<?php
use PHPUnit\Framework\TestCase;
use Helper\Helper;

final class HelperTest extends TestCase
{
    protected $helper;

    /**
     * Create instance
     */
    protected function setUp(): void {
        $this->helper = new Helper();
    }

    /**
     * @dataProvider dataProviderForTestGetInputString
     * @param string $stubData
     * @param string $expected
     */
    public function testGetInputString(string $stubData, string $expected): void {
        // create mock
        $mockHelper = $this->getMockBuilder(Helper::class)
            ->onlyMethods(['inputMethod', 'validateInput'])
            ->getMock();

        // configure mock
        $mockHelper->method('inputMethod')->willReturn($stubData);
        $mockHelper->method('validateInput')->will($this->returnArgument(0));

        $actual = $mockHelper->getInputString();

        $this->assertEquals($expected, $actual);
    }

    public function dataProviderForTestGetInputString() {
        return [
            ['This is a sample', 'This is a sample'],
            ['Hello world', 'Hello world'],
            ['0123', '0123']
        ];
    }

    /**
     * @dataProvider dataProviderForTestValidateInput
     * @param string $input
     * @param string $expected
     */
    public function testValidateInput(string $input, string $expected): void {
        $this->assertEquals(
            $expected,
            $this->helper->validateInput($input)
        );
    }

    public function dataProviderForTestValidateInput() {
        return [
            ['This is a sample', 'This is a sample'],
            ['', ''],
            ['0', '0'],
            ['An other string in Multiple byte : á à ê!', 'An other string in Multiple byte : á à ê!'],
            ["\t\t\t", ''],
            ['          ', '']
        ];
    }

    /**
     * @dataProvider dataProviderForTestUpperCase
     * @param string $input
     * @param string $expected
     */
    public function testUpperCase(string $input, string $expected): void {
        $this->assertEquals(
            $expected,
            $this->helper->upperCase($input)
        );
    }

    public function dataProviderForTestUpperCase() {
        return [
            ['This is a sample', 'THIS IS A SAMPLE'],
            ['', ''],
            ['0', '0'],
            ['An other string in Multiple byte : á à ê!', 'AN OTHER STRING IN MULTIPLE BYTE : Á À Ê!']
        ];
    }

    /**
     * @dataProvider dataProviderForTestLowerCase
     * @param string $input
     * @param string $expected
     */
    public function testLowerCase(string $input, string $expected): void {
        $this->assertEquals(
            $expected,
            $this->helper->lowerCase($input)
        );
    }

    public function dataProviderForTestLowerCase() {
        return [
            ['THIS IS A SAMPLE', 'this is a sample'],
            ['UTF-8', 'utf-8'],
            ['This Will Not Affected NUMBER 0123456789', 'this will not affected number 0123456789'],
            ['An other string in Multiple byte : Á á À à Ê ê!', 'an other string in multiple byte : á á à à ê ê!']
        ];
    }

    /**
     * @dataProvider dataProviderForTestAlternateUpperCase
     * @param string $input
     * @param string $expected
     */
    public function testAlternateUpperCase(string $input, string $expected): void {
        $this->assertEquals(
            $expected,
            $this->helper->alternateUpperCase($input)
        );
    }

    public function dataProviderForTestAlternateUpperCase() {
        return [
            ['THIS IS A SAMPLE', 'tHiS Is a sAmPlE'],
            ['UTF-8', 'uTf-8'],
            ['This Will Not Affected NUMBER 0123456789', 'tHiS WiLl nOt aFfEcTeD NuMbEr 0123456789'],
            ['An other string in Multiple byte : ÁáÀàÊê!', 'aN OtHeR StRiNg iN MuLtIpLe bYtE : ÁáÀàÊê!']
        ];
    }

    /**
     * @dataProvider dataProviderForTestIsUpperCase
     * @param int $index
     * @param bool $expected
     */
    public function testIsUpperCase(int $index, bool $expected): void {
        $this->assertEquals(
            $expected,
            $this->helper->isUpperCase($index)
        );
    }

    public function dataProviderForTestIsUpperCase() {
        return [
            [0, false],
            [1, true],
            [2, false],
            [3, true],
            [254, false],
            [100001, true]
        ];
    }

    /**
     * @dataProvider dataProviderForTestGenerateCSVSuccess
     * @param string $inputString
     * @param string $filename
     * @param bool $expected
     */
    public function testGenerateCSVSuccess(string $inputString, string $filename, string $defaultFilename): void {
        $this->assertTrue(
            $this->helper->generateCSV($inputString, $filename)
        );

        // remove file after test
        $this->removeJunkFileAfterTest($filename, $defaultFilename);
    }

    public function dataProviderForTestGenerateCSVSuccess() {
        return [
            ['This is a sample string', 'output.csv', ''],
            ['An other string in Multiple byte : ÁáÀàÊê!', 'output.csv', ''],
            ['Put empty file name will take default', '', 'default_output.csv'],
            ['Missing extension will take default', 'output', 'default_output.csv']
        ];
    }

    private function removeJunkFileAfterTest(string $filename, string $defaultFilename) {
        if ($filename != '') {
            unlink($filename);
        }
        if ($defaultFilename != '') {
            unlink($defaultFilename);
        }
    }
}
