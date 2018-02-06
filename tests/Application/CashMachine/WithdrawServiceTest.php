<?php

namespace Bank\Tests\Domain\CashMachine;

use Bank\Application\Service\CashMachine\WithdrawService;
use Bank\Domain\CashMachine\CashMachine;
use PHPUnit\Framework\TestCase;

class WithdrawServiceTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExecuteUsingANegativeValueShoudBeThrowAnException()
    {
        $cacheMachine = new WithdrawService(new CashMachine());
        $cacheMachine->execute(-100);
    }
}
