<?php

class AdditionTest extends  \PHPUnit_Framework_TestCase
{
    public function adds_up_given_operands()
    {
        $addition = new \App\Calculator\Addition;
        $addition->setOperands([5, 10]);

        $this->assertEquals(15, $addition->calculate());
    }

    public function no_operands_given_throws_exception_when_calculating()
    {
        $this->expectException(\App\Calculator\NoOperandsException::class);

        $addition = new \App\Calculator\Addition;
        $addition->calculate();
    }
}
