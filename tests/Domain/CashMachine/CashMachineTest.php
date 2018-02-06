<?php

namespace Bank\Tests\Domain\CashMachine;

use Bank\Domain\CashMachine\CashMachine as CashMachine;
use PHPUnit\Framework\TestCase;

class CashMachineTest extends TestCase
{
    public function testWithdrawMethod()
    {
        $cacheMachine = new CashMachine();
        $this->assertEquals(100, $cacheMachine->withdraw(100));
    }
}
