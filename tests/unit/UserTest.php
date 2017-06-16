<?php

class UserTest extends \PHPUnit_Framework_TestCase
{

    protected $user;

    public function setUp()
    {
        $this->user = new \App\Models\User;
    }

    public function testThatWeCanGetTheFirstName()
    {
        $this->user->setFirstName('Billy');

        $this->assertEquals($this->user->getFirstName(), 'Billy');
    }

    public function testThatWeCanGetTheLastName()
    {
        $this->user->setLastName('Garret');

        $this->assertEquals($this->user->getLastName(), 'Garret');
    }

    public function testFullNameIsReturned()
    {
        $user = new \App\Models\User;
        $user->setFirstName('Billy');
        $user->setLastName('Garret');

        $this->assertEquals($user->getFullName(), 'Billy Garret');
    }

    public function testFirstAndLastNameAreTrimmed()
    {
        $user = new \App\Models\User;
        $user->setFirstName(' Billy   ');
        $user->setLastName('      Garret');

        $this->assertEquals($user->getFirstName(), 'Billy');
        $this->assertEquals($user->getLastName(), 'Garret');
    }

    public function testEmailAddressCanBeSet()
    {
        // $email = 'stefan@gmail.com';

        $user = new \App\Models\User;
        $user->setEmail('stefan@gmail.com');

        $this->assertEquals($user->getEmail(), 'stefan@gmail.com');
    }

    public function testEmailVAriablesContainCorrectValues()
    {
        $user = new \App\Models\User;
        $user->setFirstName('Billy');
        $user->setLastName('Garret');
        $user->setEmail('stefan@gmail.com');

        $emailVariables = $user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Billy Garret');
        $this->assertEquals($emailVariables['email'], 'stefan@gmail.com');
    }
}
