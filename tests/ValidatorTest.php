<?php

use PHPUnit\Framework\TestCase;

use Evarmi\IdAccountValidator\Validator;

class ValidatorTest extends TestCase
{
    public function testDniValidation()
    {
        $validator = Validator::documentValidation('23826295C');

        $this->assertEquals('DNI', $validator['type']);
        $this->assertEquals('23826295C', $validator['value']);
        $this->assertTrue($validator['result']);
    }

    public function testNIEValidation()
    {
        $validator = Validator::documentValidation('X8222827M');

        $this->assertEquals('NIE', $validator['type']);
        $this->assertEquals('X8222827M', $validator['value']);
        $this->assertTrue($validator['result']);
    }

    public function testCIFValidation()
    {
        $validator = Validator::documentValidation('B86561412');

        $this->assertEquals('CIF', $validator['type']);
        $this->assertEquals('B86561412', $validator['value']);
        $this->assertTrue($validator['result']);
    }

    public function testIBANValidation()
    {
        $validator = Validator::ibanValidation('ES7921000813610123456789');

        $this->assertTrue($validator['result']);
    }

    public function testInvalidFormatDocument() {
        $validator = Validator::documentValidation('23826295');

        $this->assertEquals('unknown', $validator['type']);
        $this->assertFalse($validator['result']);
    }
}
