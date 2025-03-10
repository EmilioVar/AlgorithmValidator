<?php

use PHPUnit\Framework\TestCase;
use Evarmi\AlgorithmValidator\Validator;

class ValidatorTest extends TestCase
{
    public function testDniValidation()
    {
        $validator = Validator::documentValidation('23826295C');

        $this->assertEquals('DNI', $validator['type']);
        $this->assertEquals('23826295C', $validator['value']);
        $this->assertTrue($validator['result']);

        $validatorFalse = Validator::documentValidation('23826295N');
        
        $this->assertEquals('DNI', $validatorFalse['type']);
        $this->assertEquals('23826295N', $validatorFalse['value']);
        $this->assertFalse($validatorFalse['result']);
    }

    public function testNIEValidation()
    {
        $validator = Validator::documentValidation('X8222827M');
        
        $this->assertEquals('NIE', $validator['type']);
        $this->assertEquals('X8222827M', $validator['value']);
        $this->assertTrue($validator['result']);

        $validatorFalse = Validator::documentValidation('X8222827N');

        $this->assertEquals('NIE', $validatorFalse['type']);
        $this->assertEquals('X8222827N', $validatorFalse['value']);
        $this->assertFalse($validatorFalse['result']);
    }

    public function testCIFValidation()
    {
        $validator = Validator::documentValidation('B86561412');

        $this->assertEquals('CIF', $validator['type']);
        $this->assertEquals('B86561412', $validator['value']);
        $this->assertTrue($validator['result']);

        $validatorFalse = Validator::documentValidation('A12345678');

        $this->assertEquals('CIF', $validatorFalse['type']);
        $this->assertEquals('A12345678', $validatorFalse['value']);
        $this->assertFalse($validatorFalse['result']);
    }

    public function testIBANValidation()
    {
        $validator = Validator::ibanValidation('ES7921000813610123456789');

        $this->assertEquals('IBAN', $validator['type']);
        $this->assertEquals('ES7921000813610123456789', $validator['value']);
        $this->assertTrue($validator['result']);

        $validatorFalse = Validator::ibanValidation('GB94BARC20201530093459');
        
        $this->assertEquals('IBAN', $validatorFalse['type']);
        $this->assertEquals('GB94BARC20201530093459', $validatorFalse['value']);
        $this->assertFalse($validatorFalse['result']);

        $validatorFalseTwo = Validator::ibanValidation('GB94BARC20201530093459ASDFASDF');
        
        $this->assertEquals('IBAN', $validatorFalseTwo['type']);
        $this->assertEquals('GB94BARC20201530093459ASDFASDF', $validatorFalseTwo['value']);
        $this->assertFalse($validatorFalseTwo['result']);
    }

    public function testInvalidFormatDocument() {
        $validator = Validator::documentValidation('23826295');

        $this->assertEquals('unknown', $validator['type']);
        $this->assertEquals('23826295', $validator['value']);
        $this->assertFalse($validator['result']);
    }
}
