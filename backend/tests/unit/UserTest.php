<?php
namespace backend\tests;


use backend\models\User;
use backend\tests\fixtures\UserFixture;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _fixtures()
    {
        return['users'=>UserFixture::className()];
    }
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->example();
    }
    public function testGetEmail()
    {
        sleep(5);
    }
    public function example()
    {
    }
}