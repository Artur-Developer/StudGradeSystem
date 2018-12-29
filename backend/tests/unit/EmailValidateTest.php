<?php
namespace backend\tests;


class EmailValidateTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testEmail($email,$result)
    {
        $validator = new EmailValidateTest();
        $this->assertEquals($validator->validate($email),$result);
    }
    public function getEmailVariants(){
        return [
            ['1@mail.ru',true],
            ['2@mail..com',false],
            ['3@mail.ru',true],
            ['4@mail.ru',true],
            ['5@mail.ru',true],
        ];
    }
}